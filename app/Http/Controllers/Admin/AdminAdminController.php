<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Default to 'all'
        // Base query
        $query = Admin::query();
        // Apply status filter
        if ($status === 'active') {
            $query->whereNull('deleted_at'); // Active admins (not soft-deleted)
        } elseif ($status === 'deleted') {
            $query->onlyTrashed(); // Soft-deleted admins
        } else {
            $query->withTrashed(); // Include both active and deleted admins
        }
        // Execute query and paginate results
        $admins = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.admins.index', compact('admins', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Store the uploaded file in the 'profile_pictures' directory inside 'storage/app/public'
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Save the file path to the validated data
            $validated['profile_picture'] = $profilePicturePath;
        } else {
            $validated['profile_picture'] = $admin->profile_picture ?? null; // Retain the old picture if none uploaded
        }


        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'profile_picture' => $validated['profile_picture'],
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the user with related data
        $admin = Admin::all()->where('id', $id)->first();
        // Return the user details to the show view
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        // Validate the form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the admin details
        $admin->update($validated);

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture
            if ($admin->profile_picture) {
                Storage::disk('public')->delete($admin->profile_picture);
            }

            // Store the new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->update(['profile_picture' => $profilePicturePath]);
        }

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete(); // Soft delete
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }

    // To restore a soft-deleted record
    public function restore($id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        $admin->restore(); // Restore the soft-deleted user
        return redirect()->route('admins.index')->with('success', 'Admin restored successfully!');
    }
}
