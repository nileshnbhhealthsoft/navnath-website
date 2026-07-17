@php
  $displayLabel = \Illuminate\Support\Str::headline((string) $key);
  $pathParts = [...($path ?? []), $key];
  $fieldName = 'content';
  foreach ($pathParts as $part) {
      $fieldName .= '['.$part.']';
  }
  $isList = is_array($value) && array_is_list($value);
  $isLongText = is_string($value) && (strlen($value) > 80 || preg_match('/description|message|copyright|privacy_text/i', (string) $key));
@endphp

@if (is_array($value))
  <fieldset class="group">
    <legend>{{ $displayLabel }}</legend>
    @if ($isList)
      @foreach ($value as $index => $item)
        @if (is_array($item))
          <div class="list-item">
            <strong>{{ $displayLabel }} {{ $index + 1 }}</strong>
            @foreach ($item as $childKey => $childValue)
              @include('admin.partials.content-field', ['key' => $childKey, 'value' => $childValue, 'path' => [...$pathParts, $index]])
            @endforeach
          </div>
        @else
          <div class="field">
            <label>{{ $displayLabel }} {{ $index + 1 }}</label>
            <input type="text" name="{{ $fieldName }}[{{ $index }}]" value="{{ old(str_replace(['[', ']'], ['.', ''], $fieldName).'.'.$index, $item) }}">
          </div>
        @endif
      @endforeach
    @else
      @foreach ($value as $childKey => $childValue)
        @include('admin.partials.content-field', ['key' => $childKey, 'value' => $childValue, 'path' => $pathParts])
      @endforeach
    @endif
  </fieldset>
@else
  <div class="field">
    <label for="field-{{ implode('-', $pathParts) }}">{{ $displayLabel }}</label>
    @if ($isLongText)
      <textarea id="field-{{ implode('-', $pathParts) }}" name="{{ $fieldName }}">{{ old(str_replace(['[', ']'], ['.', ''], $fieldName), $value) }}</textarea>
    @else
      <input id="field-{{ implode('-', $pathParts) }}" type="{{ in_array((string) $key, ['email', 'email_value', 'email_address'], true) ? 'email' : 'text' }}" name="{{ $fieldName }}" value="{{ old(str_replace(['[', ']'], ['.', ''], $fieldName), $value) }}">
    @endif
  </div>
@endif
