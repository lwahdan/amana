<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    // display user's dashboard info
    public function showinfo()
    {
        $user = Auth::guard('web')->user(); // Get the currently logged-in user from session
        return view('auth.info', compact('user'));
    }

    // update provider's dashboard info
    public function updateInfo(Request $request)
    {
        $user = User::find(Auth::guard('web')->id());
        if (!$user instanceof \App\Models\User) {
            return redirect()->back()->withErrors(['error' => 'User not found or invalid instance']);
        }
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => $request->filled('password') ? 'required|string|current_password:web' : 'nullable',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }

        // Update the provider's record, including the JSON-encoded fields
        $user->update(array_merge($validatedData, [
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
        ]));
        return redirect()->back()->with('success', 'Information updated successfully.');
    }

     // show user's bookings
     public function showbookings()
     {
         $user = Auth::guard('web')->user();
         $bookings = Booking::with(['provider', 'service'])
             ->where('user_id', $user->id)
             ->orderBy('booking_date', 'desc')
             ->get();
 
         return view('auth.bookings', compact('bookings'));
     }

     //show user's meetings
    public function showmeetings()
    {
        $user = Auth::guard('web')->user(); 
        $meetings = Meeting::with(['provider', 'service'])
        ->where('user_id', $user->id)
        ->orderBy('meeting_date', 'desc')
        ->get();

        return view('auth.meetings', compact('meetings'));
    }

    //show user's reviews
    public function reviews()
    {
        $user = Auth::guard('web')->user(); 
        $reviews = Review::with(['provider', 'service'])
        ->where('user_id', $user->id)
        ->get();

        return view('auth.reviews', compact('reviews'));
    }
}
