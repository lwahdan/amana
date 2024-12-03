<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
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
        
        $reviews = $query->paginate(100);
    
        return view('admin.reviews.index', compact('reviews'));
    }

    public function updateStatus(Request $request, $id)
    {
    $review = Review::findOrFail($id);
    $review->status = $request->status; // 'approved' or 'disapproved'
    $review->save();

    return redirect()->route('reviews.index')->with('success', 'Review status updated successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['user', 'service', 'provider'])->findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
