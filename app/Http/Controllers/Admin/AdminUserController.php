<?php

namespace App\Http\Controllers\Admin;

use auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Admin;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Default to 'all'
        // Base query
        $query = User::query();
        // Apply status filter
        if ($status === 'active') {
            $query->whereNull('deleted_at'); // Active users (not soft-deleted)
        } elseif ($status === 'deleted') {
            $query->onlyTrashed(); // Soft-deleted users
        } else {
            $query->withTrashed(); // Include both active and deleted users
        }
        // Execute query and paginate results
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users', 'status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the user with related data
        $user = User::with([
            'contactMessages',
            'meetings.provider', //provider relationship exists in the Meeting model
        ])->findOrFail($id);
        $bookings = Booking::with(['provider', 'service', 'city'])
        ->where('user_id', $user->id)
        ->orderBy('booking_date', 'desc')
        ->paginate(5);
        $reviews = Review::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->withTrashed()
        ->paginate(10);
        $blogs = Blog::where('writer_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        // Return the user details to the show view
        return view('admin.users.show', compact('user', 'bookings', 'reviews', 'blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]));
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // To restore a soft-deleted record
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore(); // Restore the soft-deleted user
        return redirect()->route('users.index')->with('success', 'User restored successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

}
