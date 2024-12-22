<?php

namespace App\Http\Controllers\Providers;

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
use Illuminate\Support\Facades\Validator;

class ProviderDashboardController extends Controller
{
    // display provider's dashboard info
    public function showInfo()
    {
        $provider = Auth::guard('provider')->user(); // Get the currently logged-in provider from session
        $allServices = Service::all();
        return view('provider.info', compact('provider', 'allServices'));
    }

    // update provider's dashboard info
    public function updateInfo(Request $request)
    {
        $provider = Provider::find(Auth::guard('provider')->id());
        if (!$provider instanceof \App\Models\Provider) {
            return redirect()->back()->withErrors(['error' => 'Provider not found or invalid instance']);
        }
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email,' . $provider->id,
            'bio' => 'nullable|string|max:500',
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
            'work_locations' => 'required|string',
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:15',
            'address' => 'required|string|max:255',
            'services' => 'required|array', // Ensure 'services' is an array
            'services.*' => 'exists:services,id', // Validate each selected service ID exists in the 'services' table
        ]);

        // Convert the comma-separated string into a JSON array
        $skills = array_map('trim', explode(',', $request->skills));
        $availability = array_map('trim', explode(',', $request->availability));
        $worklocations = array_map('trim', explode(',', $request->work_locations));
        $languagesSpoken = array_map('trim', explode(',', $request->languages_spoken));
        $workShifts = json_encode($request->work_shifts ?? []);
        // Update the provider's record, including the JSON-encoded fields
        $provider->update(array_merge($validatedData, [
            'skills' => json_encode($skills),
            'availability' => json_encode($availability),
            'work_locations' => json_encode($worklocations),
            'languages_spoken' => json_encode($languagesSpoken),
            'work_shifts' => $workShifts,
            //'password' => bcrypt($validatedData['password']),
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $provider->password,
        ]));
        // Sync the services in the pivot table
        $provider->services()->sync($request->services);
        return redirect()->back()->with('success', 'Information updated successfully.');
    }

    // show provider's bookings
    public function showbookings()
    {
        $provider = Auth::guard('provider')->user();
        $bookings = Booking::with(['user', 'service', 'city'])
            ->where('provider_id', $provider->id)
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('provider.bookings', compact('bookings'));
    }

    // mark a booking as completed (status update)
    public function completebooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure the provider is authorized to mark this booking
        if ($booking->provider_id != Auth::guard('provider')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the booking status to completed
        $booking->update(['status' => 'completed']);

        return redirect()->route('provider.bookings')->with('success', 'Booking marked as completed.');
    }


    //show provider's meetings
    public function showmeetings()
    {
        $provider = Auth::guard('provider')->user(); 
        $meetings = Meeting::with(['user', 'service'])
        ->where('provider_id', $provider->id)
        ->orderBy('meeting_date', 'desc')
        ->get();

        return view('provider.meetings', compact('meetings'));
    }

    // mark a meeting as completed (status update)
    public function completemeeting($id)
    {
        $meeting = Meeting::findOrFail($id);

        // Ensure the provider is authorized to mark this meeting
        if ($meeting->provider_id != Auth::guard('provider')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the meeting status to completed
        $meeting->update(['status' => 'completed']);

        return redirect()->route('provider.meetings')->with('success', 'Meeting marked as completed.');
    }

    //show provider's reviews
    public function reviews()
    {
        $provider = Auth::guard('provider')->user(); 
        $reviews = Review::with('service')
        ->where('provider_id', $provider->id)
        ->get();

        return view('provider.reviews', compact('reviews'));
    }
}
