@extends('admin.layout')
@section('title', 'Admin Login - Ascent')
@section('content')
@php
    $loginLogoPath = (string) data_get(\App\Models\SiteContent::current(), 'media.brand_mark', '');
@endphp
<div class="login-wrap">
  <div class="card login-card">
    @if ($loginLogoPath !== '')
      <img src="{{ asset($loginLogoPath) }}" alt="Ascent" class="login-logo">
    @else
      <div class="login-mark">A</div>
    @endif
    <h1>Ascent Admin Login</h1>
    <p class="hint">Use the admin email and password saved in the database.</p>
    @if ($errors->any())
      <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.store') }}">
      @csrf
      <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
      </div>
      <div style="margin-top:18px"><button class="btn btn-primary" type="submit">Login</button></div>
    </form>
  </div>
</div>
@endsection
