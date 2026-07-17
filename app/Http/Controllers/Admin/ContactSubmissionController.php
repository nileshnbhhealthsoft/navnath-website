<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Contracts\View\View;

class ContactSubmissionController extends Controller
{
    public function index(): View
    {
        return view('admin.messages', [
            'messages' => ContactSubmission::query()->latest()->paginate(20),
        ]);
    }
}
