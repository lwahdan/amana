<?php

namespace App\Http\Controllers\Auth;

use App\Models\Meeting;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingController extends Controller
{
    //save the meeting request from user to provider
    public function store(Request $request, $providerId)
    {
        $user = auth()->user();

        // Validate provider existence
        $provider = Provider::findOrFail($providerId);

        // Create the meeting
        $meeting = Meeting::create([
            'user_id' => $user->id,
            'provider_id' => $provider->id,
            'meeting_date' => null, // Initially null
            'meeting_link' => null, // Initially null
            'status' => 'requested',
        ]);

        return redirect()->back()->with('success', 'Meeting request sent successfully.');
    }
}
