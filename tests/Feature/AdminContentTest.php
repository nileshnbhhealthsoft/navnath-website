<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_renders(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Ascent Admin Login');
    }

    public function test_admin_can_update_website_content(): void
    {
        $content = config('site_content');
        $content['hero']['eyebrow'] = 'Updated Direction';

        $this->withSession(['admin_authenticated' => true])
            ->put('/admin/content', ['content' => $content])
            ->assertRedirect();

        $this->assertSame('Updated Direction', data_get(SiteContent::current(), 'hero.eyebrow'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Updated Direction');
    }

    public function test_admin_dashboard_and_media_manager_render(): void
    {
        $this->withSession(['admin_authenticated' => true])
            ->get('/admin')
            ->assertOk()
            ->assertSee('Website Dashboard');

        $this->withSession(['admin_authenticated' => true])
            ->get('/admin/media')
            ->assertOk()
            ->assertSee('Images &amp; Logo', false);
    }

    public function test_saving_text_content_preserves_media_paths(): void
    {
        $stored = config('site_content');
        data_set($stored, 'media.brand_logo', 'uploads/site-media/existing-logo.png');
        SiteContent::query()->create(['content' => $stored]);

        $submitted = config('site_content');
        unset($submitted['media']);
        data_set($submitted, 'hero.eyebrow', 'Preserved Media Test');

        $this->withSession(['admin_authenticated' => true])
            ->put('/admin/content', ['content' => $submitted])
            ->assertRedirect();

        $this->assertSame(
            'uploads/site-media/existing-logo.png',
            data_get(SiteContent::current(), 'media.brand_logo')
        );
    }

    public function test_admin_can_upload_media_file(): void
    {
        $this->withSession(['admin_authenticated' => true])
            ->put('/admin/media', [
                'media_files' => [
                    'hero_image' => UploadedFile::fake()->image('hero.jpg', 800, 600),
                ],
            ])
            ->assertRedirect();

        $path = (string) data_get(SiteContent::current(), 'media.hero_image');

        $this->assertStringStartsWith('uploads/site-media/', $path);
        $this->assertFileExists(public_path($path));

        if (basename($path) !== 'hero-business-analytics.jpg') {
            File::delete(public_path($path));
        }
    }
}
