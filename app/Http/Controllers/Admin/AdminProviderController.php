<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\City;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Meeting;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Default to 'all'
        // Base query
        $query = Provider::query();  
        // Apply status filter
        if ($status === 'active') {
            $query->whereNull('deleted_at'); // Active users (not soft-deleted)
        } elseif ($status === 'deleted') {
            $query->onlyTrashed(); // Soft-deleted users
        } else {
            $query->withTrashed(); // Include both active and deleted users
        }  
        // Execute query and paginate results
        $providers = $query->orderBy('created_at', 'desc')->paginate(10);   
        return view('admin.providers.index', compact('providers', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.providers.create' , compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

            // Redirect to the provider dashboard with a success message
            return redirect()->route('providers.index')->with('success', 'Provider created successfully!');
        } catch (\Exception $e) {
            // Handle unexpected errors (e.g., database issues)
            return redirect()->route('providers.index')->with('error', 'An error occurred. Please try again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $provider = Provider::all()->find($id);
        if (!$provider) {
            return abort(404, 'Provider not found');
        }
        $bookings = Booking::with(['user', 'service', 'city'])
        ->where('provider_id', $provider->id)
        ->orderBy('booking_date', 'desc')
        ->paginate(5);
        $meetings = Meeting::with('user')
            ->where('provider_id', $provider->id)
            ->orderBy('meeting_date', 'desc')
            ->paginate(5);
        $reviews = Review::where('provider_id', $provider->id)
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->paginate(10);
        $blogs = Blog::where('writer_id', $provider->id)->orderBy('created_at', 'desc')->paginate(5);
        // Return the provider details to the show view
        return view('admin.providers.show', compact('provider', 'bookings', 'meetings', 'reviews', 'blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provider = Provider::findOrFail($id);
        $cities = City::all();
        $allServices = Service::all();
        return view('admin.providers.edit', compact('provider','cities', 'allServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $provider = Provider::findOrFail($id);
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email,' . $provider->id,
            'bio' => 'required|string|max:500',
            'certifications' => 'nullable|string',
            'current_password' => 'nullable|string|current_password:provider',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'gender' => 'required|in:male,female',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date_of_birth' => 'required|date|before:today',
            'years_of_experience' => 'required|integer',
            'education' => 'required|string|max:255',
            'skills' => 'required|string',
            'languages_spoken' => 'required|string',
            'availability' => 'required|string',
            'hourly_rate' => 'required|numeric',
            'work_shifts' => 'required|array', // Ensure 'work_shifts' is an array
            'work_shifts.*' => 'in:morning,night,stay-in', // Validate each selected value
            'work_locations' => 'required|array',
            'work_locations.*' => 'exists:cities,id',
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:15',
            'address' => 'required|string|max:255',
            'services' => 'required|array', // Ensure 'services' is an array
            'services.*' => 'exists:services,id', // Validate each selected service ID exists in the 'services' table
        ]);

        // Convert the comma-separated string into a JSON array
        $skills = array_map('trim', explode(',', $request->skills));
        $availability = array_map('trim', explode(',', $request->availability));
        $languagesSpoken = array_map('trim', explode(',', $request->languages_spoken));
        $workShifts = json_encode($request->work_shifts ?? []);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {

            // Store the uploaded file and get its path
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Include the path in the validated data
            $validatedData['profile_picture'] = $profilePicturePath;

            // Optionally, delete the old profile picture to save storage space
            if ($provider->profile_picture) {
                Storage::disk('public')->delete($provider->profile_picture);
            }
        }
        // Update the provider's record, including the JSON-encoded fields
        $provider->update(array_merge($validatedData, [
            'skills' => json_encode($skills),
            'availability' => json_encode($availability),
            'languages_spoken' => json_encode($languagesSpoken),
            'work_shifts' => $workShifts,
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $provider->password,
        ]));

        // Sync the services in the pivot table
        $provider->services()->sync($request->services);
        $provider->cities()->sync($request->work_locations);

        return redirect()->route('providers.index')->with('success', 'Provider updated successfully.');
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete(); // Soft delete
        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully.');
    }

     // To restore a soft-deleted record
     public function restore($id)
     {
         $provider = Provider::withTrashed()->findOrFail($id);
         $provider->restore(); // Restore the soft-deleted user
         return redirect()->route('providers.index')->with('success', 'Provider restored successfully!');
     }
}
