<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('ASCENT')
            ->assertSee('Digital Strategy &amp; Advisory', false)
            ->assertSee('Tell us what you are working toward.');
    }

    public function test_home_page_uses_defaults_when_a_stored_list_is_null(): void
    {
        SiteContent::query()->create([
            'content' => [
                'services' => ['items' => null],
                'industries' => ['items' => null],
            ],
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Capabilities that connect strategy to execution.')
            ->assertSee('Government &amp; Public Services', false);
    }
}
