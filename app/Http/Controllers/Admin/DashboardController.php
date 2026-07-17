<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\SiteContent;
use Illuminate\Contracts\View\View;
use Throwable;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $content = SiteContent::current();
        $mediaDefinitions = collect(config('site_media.groups', []))->flatten(1);
        $uploadedMedia = $mediaDefinitions
            ->filter(fn (array $item): bool => filled(data_get($content, $item['path'] ?? '')))
            ->count();

        try {
            $messageCount = ContactSubmission::query()->count();
            $latestMessage = ContactSubmission::query()->latest()->first();
        } catch (Throwable) {
            $messageCount = 0;
            $latestMessage = null;
        }

        return view('admin.dashboard', [
            'messageCount' => $messageCount,
            'latestMessage' => $latestMessage,
            'contentSectionCount' => collect($content)->except('media')->count(),
            'uploadedMedia' => $uploadedMedia,
            'totalMedia' => $mediaDefinitions->count(),
        ]);
    }
}
