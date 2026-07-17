@extends('admin.layout')
@section('title', 'Contact Messages - Ascent Admin')
@section('page_title', 'Contact Messages')
@section('content')
<main class="wrap">
  <div class="card">
    <h1>Contact Messages</h1>
    <p class="hint">Messages submitted from the public website contact form.</p>
  </div>
  <div class="card">
    @forelse ($messages as $message)
      <article class="message">
        <div class="grid grid-2">
          <div><strong>{{ $message->name }}</strong><div class="muted">{{ $message->email }}{{ $message->company ? ' · '.$message->company : '' }}</div></div>
          <div><strong>{{ $message->service }}</strong><div class="muted">{{ $message->created_at->format('d M Y, h:i A') }}</div></div>
        </div>
        <p>{{ $message->message }}</p>
      </article>
    @empty
      <p>No contact messages yet.</p>
    @endforelse
    <div class="pagination">{{ $messages->links() }}</div>
  </div>
</main>
@endsection
