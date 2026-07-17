@extends('admin.layout')
@section('title', 'Website Content - Ascent Admin')
@section('page_title', 'Website Content')
@section('content')
<main class="wrap">
  <div class="card">
    <h1>Website Content</h1>
    <p class="hint">Every public text, link, contact detail, service option and footer item below is stored in the database. Images and logo are managed separately from the sidebar.</p>
  </div>

  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-error">
      <strong>Content could not be saved.</strong>
      <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.content.update') }}">
    @csrf
    @method('PUT')
    @foreach ($content as $sectionKey => $sectionValue)
      @continue($sectionKey === 'media')
      <section class="card section-card">
        <h2>{{ \Illuminate\Support\Str::headline($sectionKey) }}</h2>
        @if (is_array($sectionValue))
          @foreach ($sectionValue as $key => $value)
            @include('admin.partials.content-field', ['key' => $key, 'value' => $value, 'path' => [$sectionKey]])
          @endforeach
        @endif
      </section>
    @endforeach
    <div class="actions"><div class="actions-inner"><button class="btn btn-primary" type="submit">Save Website Content</button></div></div>
  </form>
</main>
@endsection
