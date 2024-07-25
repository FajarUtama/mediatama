<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            \Log::info('User logged in: ' . $user->username);
            \Log::info('Session data after login: ', session()->all());
            \Log::info('Intended URL: ' . session()->get('url.intended', '/'));

            session(['login_web_' . Auth::getDefaultDriver() => Auth::user()->id]);
            \Log::info('Session after setting login_web: ', session()->all());

            return redirect()->intended('/');
        }

        \Log::warning('Login failed for username: ' . $credentials['username']);
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}



    