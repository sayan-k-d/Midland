<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerForm()
    {
        try {
            $roles = Role::all();
            return view('cms.auth.adminRegister', compact('roles'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Registration Unsuccessfull', 'error' => $e->getMessage()]);
        }
    }

    public function loginForm()
    {
        try {
            return view('cms.auth.adminLogin');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Login Unsuccessfull', 'error' => $e->getMessage()]);
        }
    }

    public function dashboard()
    {
        try {
            return view('cms.dashboard');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Cannot Logout', 'error' => $e->getMessage()]);
        }
    }
}
