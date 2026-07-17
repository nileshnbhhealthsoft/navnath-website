@extends('admin.layout')
@section('title', 'Dashboard - Ascent Admin')
@section('page_title', 'Dashboard')
@section('content')
<div class="wrap">
  <div class="card page-heading">
    <div>
      <h1>Website Dashboard</h1>
      <p class="hint">Manage website text, images, logo and contact enquiries from one place.</p>
    </div>
    <a class="btn btn-primary" href="{{ route('home') }}" target="_blank" rel="noopener">Open Live Website</a>
  </div>

  <div class="stats-grid">
    <div class="stat-card"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16M4 12h16M4 19h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><div><div class="stat-value">{{ $contentSectionCount }}</div><div class="stat-label">Content sections</div></div></div>
    <div class="stat-card"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M4 17l5-5 4 4 3-3 4 4" stroke="currentColor" stroke-width="1.8"/></svg></div><div><div class="stat-value">{{ $uploadedMedia }}/{{ $totalMedia }}</div><div class="stat-label">Images uploaded</div></div></div>
    <div class="stat-card"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v12H8l-4 3V5z" stroke="currentColor" stroke-width="1.8"/><path d="M8 9h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><div><div class="stat-value">{{ $messageCount }}</div><div class="stat-label">Contact messages</div></div></div>
    <div class="stat-card"><div class="stat-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 8v4l3 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><div><div class="stat-value" style="font-size:16px">{{ $latestMessage?->created_at?->format('d M Y') ?? 'No messages' }}</div><div class="stat-label">Latest enquiry</div></div></div>
  </div>

  <div style="height:20px"></div>
  <div class="quick-grid">
    <a class="quick-card" href="{{ route('admin.content.edit') }}"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16M4 12h16M4 19h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><h3 style="margin-top:14px;margin-bottom:7px">Edit Website Content</h3><p class="hint">Update headings, paragraphs, buttons, links, services, contact details and footer content.</p></a>
    <a class="quick-card" href="{{ route('admin.media.edit') }}"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8"/><circle cx="8" cy="9" r="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M4 17l5-5 4 4 3-3 4 4" stroke="currentColor" stroke-width="1.8"/></svg><h3 style="margin-top:14px;margin-bottom:7px">Manage Images &amp; Logo</h3><p class="hint">Upload brand assets, hero and about images, service and industry visuals, case studies, testimonial avatars, and contact media.</p></a>
    <a class="quick-card" href="{{ route('admin.messages.index') }}"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v12H8l-4 3V5z" stroke="currentColor" stroke-width="1.8"/><path d="M8 9h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><h3 style="margin-top:14px;margin-bottom:7px">View Contact Messages</h3><p class="hint">Review all enquiries submitted from the public website contact form.</p></a>
  </div>
</div>
@endsection
