<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Role;

class AuthController extends Controller
{
    public function registerForm()
    {
        $roles = Role::all();
        return view('cms.auth.adminRegister',compact('roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role_id' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect("/dashboard");
    }

    public function loginForm()
    {
        return view('cms.auth.adminLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        // $credentials = $request->only('email', 'password');
        $key = Str::lower($request->input('email'));

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $availableIn = RateLimiter::availableIn($key);
            Session::put('throttle_time', now()->timestamp + $availableIn);
            throw ValidationException::withMessages([
                'email' => __('auth.throttle', ['seconds' => $availableIn]),
            ]);
        }

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', "Logged in successfully!");
        }
        RateLimiter::hit($key, 60);
        $request->flashOnly('email');
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function dashboard()
    {
        return view('cms.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
