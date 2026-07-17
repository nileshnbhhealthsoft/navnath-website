<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;

class ContactSubmissionController extends Controller
{
    public function store(StoreContactSubmissionRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except('website');

        ContactSubmission::create([
            ...$validated,
            'source_ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),
        ]);

        return redirect()->to(route('home').'#contact')
            ->with('success', data_get(SiteContent::current(), 'contact.form.success_message'));
    }
}
