<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $admin = AdminUser::query()
            ->where('email', $credentials['email'])
            ->where('is_active', true)
            ->first();

        if (! $admin || ! Hash::check((string) $credentials['password'], $admin->password)) {
            return back()->withErrors(['email' => 'Invalid admin credentials.'])->onlyInput('email');
        }

        $admin->forceFill(['last_login_at' => now()])->save();

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_user_id', $admin->id);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
