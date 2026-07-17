<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteContent::query()->firstOrCreate([], [
            'content' => config('site_content'),
        ]);
    }
}
