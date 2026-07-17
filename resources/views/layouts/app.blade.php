<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ data_get($content ?? [], 'seo.description', config('site_content.seo.description')) }}">
    <title>@yield('title', data_get($content ?? [], 'seo.title', config('site_content.seo.title')))</title>

    @if (filled(data_get($content ?? [], 'media.favicon')))
        <link rel="icon" href="{{ asset(data_get($content, 'media.favicon')) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: {{ data_get($content ?? [], 'theme.primary', '#5F49A8') }};
            --primary-dark: {{ data_get($content ?? [], 'theme.primary_dark', '#2C214F') }};
            --accent: {{ data_get($content ?? [], 'theme.accent', '#C376B8') }};
            --surface: {{ data_get($content ?? [], 'theme.surface', '#F7F5FB') }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    <script src="{{ asset('assets/app.js') }}" defer></script>
</head>
<body>
    @yield('content')
</body>
</html>
