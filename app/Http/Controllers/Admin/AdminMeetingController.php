<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Meeting;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = Meeting::query();

        // Filter by status
        if ($status === 'cancelled') {
            $query->onlyTrashed(); // Retrieve only soft-deleted (cancelled) bookings
        } elseif ($status !== 'all') {
            $query->where('status', $status); // Retrieve bookings by status
        }

        $meetings = $query->with(['user', 'provider'])
            ->withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.meetings.index', compact('meetings', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $providers = Provider::all(); // All providers (filter dynamically based on service if needed)

        return view('admin.meetings.create', compact('users','providers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'provider_id' => 'required|exists:providers,id',
            'meeting_date' => 'required|date|after:today',
            'meeting_link' => 'required|url',
        ]);

        $validated['status'] = 'confirmed';

        Meeting::create($validated);

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = Meeting::with(['user', 'provider',])->findOrFail($id);

        return view('admin.meetings.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meeting = Meeting::with(['user', 'provider'])->findOrFail($id);
        $users = User::all();
        $providers = Provider::all();

        return view('admin.meetings.edit', compact('meeting', 'users', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'provider_id' => 'required|exists:providers,id',
            'meeting_date' => 'required|date|after:today',
            'meeting_link' => 'required|url',
            'status' => 'required|in:requested,confirmed,completed,cancelled',
        ]);

        $meeting = Meeting::findOrFail($id);
        if ($validated['status'] == 'cancelled') {
            if (!$meeting->trashed()) {
                $meeting->delete();
            }
        }
        $meeting->update($validated);

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meeting = Meeting::findOrFail($id);
        // Update the status to 'cancelled' before soft-deleting
        $meeting->update(['status' => 'cancelled']);
        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Meeting canceled successfully!');
    }

    public function restore($id)
    {
        $meeting = Meeting::withTrashed()->findOrFail($id);
        $meeting->update(['status' => 'confirmed']);
        $meeting->restore(); // Restore the soft-deleted user
        return redirect()->route('meetings.index')->with('success', 'Meeting restored successfully!');
    }
}
