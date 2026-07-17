@extends('admin.layout')
@section('title', 'Images & Logo - Ascent Admin')
@section('page_title', 'Images & Logo')
@section('content')
<div class="wrap">
  <div class="card page-heading">
    <div>
      <h1>Images &amp; Logo</h1>
      <p class="hint">All uploaded media paths are stored in the database. The actual optimized files are saved in <code>public/uploads/site-media</code>.</p>
    </div>
  </div>

  @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-error"><strong>Images could not be saved.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
  @endif

  <div class="upload-note">
    <strong>Note:</strong>
    <span>Upload only the images you want to replace. Empty fields keep the current image. Use “Remove current image” to restore the original built-in design. Maximum file size is 5 MB.</span>
  </div>

  <form method="POST" action="{{ route('admin.media.update') }}" enctype="multipart/form-data" style="margin-top:20px">
    @csrf
    @method('PUT')
    @foreach ($groups as $groupName => $items)
      <section class="card section-card">
        <h2>{{ $groupName }}</h2>
        <div class="media-grid">
          @foreach ($items as $item)
            @php($currentPath = (string) data_get($content, $item['path'], ''))
            <div class="media-card">
              <div class="media-preview">
                @if ($currentPath !== '')
                  <img src="{{ asset($currentPath) }}" alt="{{ $item['label'] }}">
                @else
                  <div class="media-empty">Default design is currently being used</div>
                @endif
              </div>
              <div class="media-label">{{ $item['label'] }}</div>
              <div class="media-help">{{ $item['help'] ?? 'Upload a suitable website image.' }}</div>
              <input class="media-file" type="file" name="media_files[{{ $item['field'] }}]" accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.ico,image/*">
              @if ($currentPath !== '')
                <label class="remove-row"><input type="checkbox" name="remove[{{ $item['field'] }}]" value="1"> Remove current image</label>
              @endif
            </div>
          @endforeach
        </div>
      </section>
    @endforeach
    <div class="actions"><div class="actions-inner"><button class="btn btn-primary" type="submit">Save Images &amp; Logo</button></div></div>
  </form>
</div>
@endsection
