<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
