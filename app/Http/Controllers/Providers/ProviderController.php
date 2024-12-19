<?php

namespace App\Http\Controllers\Providers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


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
        $skillsArray = array_map('trim', explode(',', $request->skills)); // Convert comma-separated string to an array
        $workLocationsArray = array_map('trim', explode(',', $request->work_locations));
        $availabilityArray = array_map('trim', explode(',', $request->availability));
        $languagesSpokenArray = array_map('trim', explode(',', $request->languages_spoken));

        // Merge the processed arrays back into the request
        $request->merge([
            'skills' => $skillsArray,
            'work_locations' => $workLocationsArray,
            'availability' => $availabilityArray,
            'languages_spoken' => $languagesSpokenArray,
        ]);

        // Validate the request
        $validator = Validator::make($request->all(), [
            // Personal Information
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:providers,email'],
            'gender' => ['required', 'in:male,female'],
            'date_of_birth' => ['date', 'before:today'],
            'phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'max:15'],
            'address' => ['string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Max 2MB
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Professional Information validation
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'education' => ['required', 'string', 'max:255'],
            'certifications' => ['nullable', 'string'],
            'skills' => ['required', 'array', 'min:1'], // Validate as an array
            'skills.*' => ['string', 'max:50'], // Validate each skill as a string with a max length
            //work details
            'hourly_rate' => ['required', 'numeric', 'min:0'],
            'work_shifts' => ['required', 'array', 'min:1'],
            'work_shifts.*' => ['in:morning,night,stay-in'], // Validate each selected shift
            'work_locations' => ['required', 'array', 'min:1'], // Validate as an array
            'work_locations.*' => ['string'], // Ensure each location is a string
            'availability' => ['required', 'array', 'min:1'], // Validate as an array
            'availability.*' => ['string'], // Ensure each availability entry is a string
            //verification details
            'bio' => ['required', 'string', 'max:500'],
            'background_checked' => ['required', 'in:1'],
            'languages_spoken' => ['required', 'array', 'min:1'],
            'languages_spoken.*' => ['string', 'max:50'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle File Upload (Profile Picture)
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        try {
            // Create a new provider
            $provider = Provider::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
                'address' => $request->address,
                'profile_picture' => $profilePicturePath,
                'password' => Hash::make($request->password),
                'years_of_experience' => $request->years_of_experience,
                'education' => $request->education,
                'certifications' => $request->certifications,
                'skills' => json_encode($request->skills),
                'hourly_rate' => $request->hourly_rate,
                'work_shifts' => json_encode($request->work_shifts), // Convert array to JSON
                'work_locations' => json_encode($request->work_locations),
                'availability' => json_encode($request->availability),
                'bio' => $request->bio,
                'background_checked' => $request->background_checked,
                'languages_spoken' => json_encode($request->languages_spoken),

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
