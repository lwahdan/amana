<?php

namespace App\Http\Controllers\Providers;

use App\Models\City;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProviderController extends Controller
{
    // public function dashboard()
    // {
    //     return view('provider.dashboard');
    // }

    public function login()
    {
        if (Auth::guard('provider')->check()) {
            return redirect()->route('provider.info');
        }
        return view('provider.login');
    }

    public function login_submit(request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|exists:providers,email',
            'password' => 'required|min:8',
        ]);

        // Retrieve the provider based on email
        $provider = Provider::withTrashed()->where('email', $request->email)->first();

        // Check if the provider is deactivated (soft deleted)
        if ($provider && $provider->trashed()) {
            return redirect()->route('provider_login')->withErrors([
                'email' => 'Your account has been deactivated. Please contact support.',
            ]);
        }

        // Attempt login
        if (Auth::guard('provider')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->intended(route('provider.info'))->with('success', 'Login successful');
        } else {
            return redirect()->route('provider_login')->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ]);
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
        $cities = City::all();
        return view('provider.register', compact('cities'));
    }

    /**
     * Handle provider registration.
     */
    public function register_submit(request $request)
    {
        $skillsArray = array_map('trim', explode(',', $request->skills)); // Convert comma-separated string to an array
        $availabilityArray = array_map('trim', explode(',', $request->availability));
        $languagesSpokenArray = array_map('trim', explode(',', $request->languages_spoken));

        // Merge the processed arrays back into the request
        $request->merge([
            'skills' => $skillsArray,
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
            'work_locations.*' => ['exists:cities,id'], // Ensure each location is a string
            'availability' => ['required', 'array', 'min:1'], // Validate as an array
            'availability.*' => ['string'], // Ensure each availability entry is a string
            //verification details
            'bio' => ['required', 'string', 'max:500'],
            'background_checked' => ['required', 'in:1'],
            'languages_spoken' => ['required', 'array', 'min:1'],
            'languages_spoken.*' => ['string', 'max:50'],
            'services' => ['required', 'array', 'min:1'], // Validate as an array with at least one service
            'services.*' => ['exists:services,id'], // Ensure each service ID exists in the `services` table
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
                'availability' => json_encode($request->availability),
                'bio' => $request->bio,
                'background_checked' => $request->background_checked,
                'languages_spoken' => json_encode($request->languages_spoken),

            ]);

            // Attach selected services to the provider
            $provider->services()->attach($request->services);
            $provider->cities()->attach($request->work_locations);


            // Log the provider in
            Auth::guard('provider')->login($provider);

            // Redirect to the provider dashboard with a success message
            return redirect()->route('provider.info')->with('success', 'Registration successful! Welcome to your dashboard.');
        } catch (\Exception $e) {
            // Handle unexpected errors (e.g., database issues)
            return redirect()->route('provider_register')->with('error', 'Registration failed! Please try again.');
        }
    }
}
