<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_contact_submission_is_stored(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme Inc.',
            'service' => 'Digital Strategy & Advisory',
            'message' => 'We need a scalable enterprise application for our team.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'jane@example.com',
            'service' => 'Digital Strategy & Advisory',
        ]);
    }

    public function test_invalid_contact_submission_is_rejected(): void
    {
        $this->from('/#contact')->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'service' => 'Unknown Service',
            'message' => 'short',
        ])->assertSessionHasErrors(['name', 'email', 'service', 'message']);

        $this->assertSame(0, ContactSubmission::count());
    }

    public function test_honeypot_field_blocks_bot_submission(): void
    {
        $this->post('/contact', [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'service' => 'Data, Analytics & BI',
            'message' => 'This is a valid length message from a bot submission.',
            'website' => 'https://spam.example',
        ])->assertSessionHasErrors('website');
    }
}
