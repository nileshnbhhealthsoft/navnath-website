<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class SiteContent extends Model
{
    protected $fillable = ['content'];

    protected function casts(): array
    {
        return ['content' => 'array'];
    }

    public static function current(): array
    {
        $defaults = config('site_content', []);

        try {
            $stored = static::query()->latest('id')->first()?->content;
        } catch (Throwable) {
            return $defaults;
        }

        if (is_string($stored)) {
            $stored = json_decode($stored, true);
        }

        return self::mergeRecursive($defaults, is_array($stored) ? $stored : []);
    }

    public static function saveContent(array $content): self
    {
        $record = static::query()->latest('id')->first() ?? new static();
        $record->content = self::mergeRecursive(config('site_content', []), $content);
        $record->save();

        return $record;
    }

    private static function mergeRecursive(array $defaults, array $stored): array
    {
        foreach ($stored as $key => $value) {
            if ($value === '' && isset($defaults[$key]) && $defaults[$key] !== '') {
                continue;
            }

            if (array_key_exists($key, $defaults) && is_array($defaults[$key])) {
                // Keep collection/object sections as arrays even when older or malformed
                // database content contains null or a scalar value for the same key.
                if (is_array($value)) {
                    $defaults[$key] = self::mergeRecursive($defaults[$key], $value);
                }

                continue;
            }

            $defaults[$key] = $value;
        }

        return $defaults;
    }
}
