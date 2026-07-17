<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_authenticated', false) === true) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $validEmail = hash_equals((string) config('admin.email'), (string) $credentials['email']);
        $validPassword = hash_equals((string) config('admin.password'), (string) $credentials['password']);

        if (! $validEmail || ! $validPassword) {
            return back()->withErrors(['email' => 'Invalid admin credentials.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
