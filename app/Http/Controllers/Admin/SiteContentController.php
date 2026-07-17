<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function edit(): View
    {
        return view('admin.content', ['content' => SiteContent::current()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'array'],
            'content.*' => ['present'],
        ]);

        $content = $validated['content'];
        $content['media'] = data_get(SiteContent::current(), 'media', []);

        SiteContent::saveContent($content);

        return back()->with('status', 'Website content updated successfully.');
    }
}
