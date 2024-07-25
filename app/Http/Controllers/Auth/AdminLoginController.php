<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username_admin', 'password_admin');

        $admin = Admin::where('username_admin', $credentials['username_admin'])->first();

        if ($admin && Hash::check($credentials['password_admin'], $admin->password_admin)) {
            Auth::guard('admin')->login($admin);
            \Log::info('User logged in: ' . $admin->username_admin);
            \Log::info('Session data after login: ', session()->all());
            \Log::info('Intended URL: ' . session()->get('url.intended', '/'));
            return redirect()->intended(route('admin.home'));
        }

        return back()->withErrors([
            'username_admin' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
