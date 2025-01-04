<?php

namespace App\Http\Controllers\Auth;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'provider_id' => 'required|exists:providers,id',
        'service_id' => 'required|exists:provider_service,service_id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
    ]);

    // Ensure the user used the service
    $bookingExists = Booking::where('user_id', auth()->id())
        ->where('provider_id', $request->provider_id)
        ->where('service_id', $request->service_id)
        ->exists();

    if (!$bookingExists) {
        return redirect()->back()->withErrors(['error' => 'You can only review services you have used.']);
    }

    // Create review
    Review::create([
        'user_id' => auth()->id(),
        'provider_id' => $request->provider_id,
        'service_id' => $request->service_id,
        'rating' => $request->rating,
        'review' => $request->review,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Your review has been submitted and is pending approval.');
}

}
