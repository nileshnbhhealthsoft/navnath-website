<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class SiteMediaController extends Controller
{
    public function edit(): View
    {
        return view('admin.media', [
            'content' => SiteContent::current(),
            'groups' => config('site_media.groups', []),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $definitions = $this->definitions();
        $rules = ['remove' => ['nullable', 'array']];

        foreach ($definitions as $definition) {
            $rules['media_files.'.$definition['field']] = [
                'nullable',
                'file',
                'max:5120',
                'mimes:jpg,jpeg,png,webp,gif,svg,ico',
            ];
            $rules['remove.'.$definition['field']] = ['nullable', 'boolean'];
        }

        $validated = $request->validate($rules, [
            'media_files.*.max' => 'Each image must be 5 MB or smaller.',
            'media_files.*.mimes' => 'Images must be JPG, PNG, WebP, GIF, SVG, or ICO files.',
        ]);

        $content = SiteContent::current();

        foreach ($definitions as $definition) {
            $field = $definition['field'];
            $path = $definition['path'];
            $oldPath = (string) data_get($content, $path, '');
            $remove = filter_var(data_get($validated, 'remove.'.$field, false), FILTER_VALIDATE_BOOLEAN);
            $file = $request->file('media_files.'.$field);

            if ($remove) {
                $this->deleteManagedFile($oldPath);
                data_set($content, $path, '');
                $oldPath = '';
            }

            if ($file instanceof UploadedFile) {
                $this->assertValidUpload($file, $field);
                $this->assertSafeSvg($file);
                $newPath = $this->storeUploadedFile($file);
                $this->deleteManagedFile($oldPath);
                data_set($content, $path, $newPath);
            }
        }

        SiteContent::saveContent($content);

        return back()->with('status', 'Website images and logo updated successfully.');
    }

    /** @return array<int, array{field:string,path:string,label:string,help?:string}> */
    private function definitions(): array
    {
        $definitions = [];

        foreach (config('site_media.groups', []) as $items) {
            foreach ($items as $item) {
                if (isset($item['field'], $item['path'])) {
                    $definitions[] = $item;
                }
            }
        }

        return $definitions;
    }

    private function storeUploadedFile(UploadedFile $file): string
    {
        $directory = public_path('uploads/site-media');

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        $filename = now()->format('YmdHis').'-'.Str::uuid().'.'.$extension;

        try {
            File::ensureDirectoryExists($directory);

            if (! File::isWritable($directory)) {
                throw ValidationException::withMessages([
                    'media_files' => 'The upload folder is not writable: public/uploads/site-media.',
                ]);
            }

            $file->move($directory, $filename);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw ValidationException::withMessages([
                'media_files' => 'The image could not be uploaded. Please check server folder permissions for public/uploads/site-media.',
            ]);
        }

        return 'uploads/site-media/'.$filename;
    }

    private function assertValidUpload(UploadedFile $file, string $field): void
    {
        if ($file->isValid()) {
            return;
        }

        $messages = [
            UPLOAD_ERR_INI_SIZE => 'The image is larger than the server upload limit.',
            UPLOAD_ERR_FORM_SIZE => 'The image is larger than the form upload limit.',
            UPLOAD_ERR_PARTIAL => 'The image was only partially uploaded. Please try again.',
            UPLOAD_ERR_NO_FILE => 'No image was selected for upload.',
            UPLOAD_ERR_NO_TMP_DIR => 'The server temporary upload folder is missing.',
            UPLOAD_ERR_CANT_WRITE => 'The server could not write the uploaded image to disk.',
            UPLOAD_ERR_EXTENSION => 'A PHP extension blocked the image upload.',
        ];

        throw ValidationException::withMessages([
            'media_files.'.$field => $messages[$file->getError()] ?? 'The image upload failed.',
        ]);
    }

    private function deleteManagedFile(string $path): void
    {
        $normalized = ltrim(str_replace('\\', '/', $path), '/');

        if (
            $normalized === ''
            || ! str_starts_with($normalized, 'uploads/site-media/')
            || $this->isPackagedDefaultMedia($normalized)
        ) {
            return;
        }

        $fullPath = public_path($normalized);
        if (File::isFile($fullPath)) {
            File::delete($fullPath);
        }
    }

    private function isPackagedDefaultMedia(string $path): bool
    {
        $defaults = config('site_content.media', []);
        $paths = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($defaults)));

        return in_array($path, array_filter($paths, 'is_string'), true);
    }

    private function assertSafeSvg(UploadedFile $file): void
    {
        if (strtolower($file->getClientOriginalExtension()) !== 'svg') {
            return;
        }

        $contents = (string) File::get($file->getRealPath());
        $unsafePatterns = [
            '/<script\b/i',
            '/<foreignObject\b/i',
            '/\bon\w+\s*=/i',
            '/javascript\s*:/i',
            '/data\s*:\s*text\/html/i',
        ];

        foreach ($unsafePatterns as $pattern) {
            if (preg_match($pattern, $contents) === 1) {
                throw ValidationException::withMessages([
                    'media_files' => 'The uploaded SVG contains unsafe markup. Please use a clean SVG, PNG, JPG, or WebP file.',
                ]);
            }
        }
    }
}
