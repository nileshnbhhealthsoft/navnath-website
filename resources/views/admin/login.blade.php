@extends('admin.layout')
@section('title', 'Admin Login - Ascent')
@section('content')
<div class="login-wrap">
  <div class="card login-card">
    <img src="{{ asset('uploads/site-media/ascent-mark.png') }}" alt="Ascent" style="width:76px;height:76px;object-fit:contain;margin-bottom:14px">
    <h1>Ascent Admin Login</h1>
    <p class="hint">Use the admin email and password configured in your <code>.env</code> file.</p>
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
