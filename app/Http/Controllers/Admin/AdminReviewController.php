<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Review;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$query = Review::with(['user', 'service', 'provider']);
        $query = Review::with([
            'user' => function ($q) {
                $q->withTrashed();
            },
            'provider' => function ($q) {
                $q->withTrashed();
            },
            'service' => function ($q) {
                $q->withTrashed();
            },
        ])->withTrashed();

        if ($request->has('status') && in_array($request->status, ['approved', 'disapproved', 'pending'])) {
            $query->where('status', $request->status);
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(30);

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $services = Service::where('status', true)->get(); // Active services
        $providers = Provider::all(); // All providers (filter dynamically based on service if needed)

        return view('admin.reviews.create', compact('users', 'services', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'provider_id' => 'required|exists:providers,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        $request->merge(['status' => 'approved']);

        Review::create($request->all());

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'service' => function ($query) {
                $query->withTrashed();
            },
            'provider' => function ($query) {
                $query->withTrashed();
            },
        ])->findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'service' => function ($query) {
                $query->withTrashed();
            },
            'provider' => function ($query) {
                $query->withTrashed();
            },
        ])->findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,disapproved',
        ]);
    
        $review = Review::withTrashed()->findOrFail($id);
    
        if ($request->input('status') === 'disapproved') {
            // Set status to disapproved and soft delete the review
            $review->update(['status' => 'disapproved']);
            $review->delete(); // Populate deleted_at
        } elseif ($request->input('status') === 'approved') {
            // Set status to approved and clear soft delete (restore)
            $review->update(['status' => 'approved']);
            if ($review->trashed()) {
                $review->restore(); // Clear deleted_at
            }
        } else {
            // Handle other statuses (like pending)
            $review->update(['status' => $request->input('status')]);
        }
    
        return redirect()->route('reviews.index')->with('success', 'Review status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'disapproved']);
        $review->delete(); 
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }

    public function restore($id)
    {
        $review = Review::withTrashed()->findOrFail($id);
        $review->update(['status' => 'approved']);
        $review->restore(); // Restore the soft-deleted user
        return redirect()->route('reviews.index')->with('success', 'Review restored successfully!');
    }
}
