<?php

namespace App\Http\Controllers\Providers;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;


class ProviderController extends Controller
{
    public function dashboard()
    {
        return view('provider.dashboard');
    }

    public function login()
    {
        if (Auth::guard('provider')->check()) {
            return redirect()->route('provider_dashboard');
        }
        return view('provider.login');
    }

    public function login_submit(request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if (Auth::guard('provider')->attempt($data)) {
            return redirect()->route('provider_dashboard')->with('success', 'login successfull');
        } else {
            return redirect()->route('provider_login')->with('error', 'invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('provider')->logout();
        return redirect()->route('provider_login')->with('success', 'logout successfully');
    }

    /**
     * Show the provider registration form.
     */
    public function register()
    {
        return view('provider.register');
    }

    /**
     * Handle provider registration.
     */
    public function register_submit(request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:providers'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            // Create the provider
            $provider = Provider::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Log the provider in
            Auth::guard('provider')->login($provider);
    
            // Redirect to the provider dashboard with a success message
            return redirect()->route('provider_dashboard')->with('success', 'Registration successful! Welcome to your dashboard.');
        } catch (\Exception $e) {
            // Handle unexpected errors (e.g., database issues)
            return redirect()->route('provider_register')->with('error', 'Registration failed! Please try again.');
        }
    }
}
