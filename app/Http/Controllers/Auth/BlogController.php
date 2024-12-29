<?php

namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\BlogFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::withCount('comments')->where('status', 'approved')->paginate(10);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'content' => 'required',
            'service_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->all();
        $data['writer_id'] = auth()->id();
        $data['writer_type'] = get_class(auth()->user());
        $data['status'] = 'pending';
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('blogs') : null;

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'Blog submitted for approval.');
    }

    /**
     * Display the specified resource./Route Model Binding
     */
    public function show(Blog $blog)
    {
        // Increment views
        $blog->increment('views');
        // Reload with counts
        $blog = $blog->loadCount(['comments', 'favorites']);
        // Check the user's like and favorite state
        $user = auth()->user();
        $hasLiked = $user ? $blog->likes()->where('user_id', $user->id)->exists() : false;
        $isFavorited = $user ? $blog->favorites()->where('user_id', $user->id)->exists() : false;

        return view('blogs.show', compact('blog', 'hasLiked', 'isFavorited'));
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

    public function like(Request $request, Blog $blog)
    {
        if (!auth()->check()) {
            // Log::info('Unauthorized user attempted to favorite a blog.');
            return response()->json(['error' => 'You must log in to like a blog.'], 403);
        }

        $user = auth()->user();
        $alreadyLiked = $blog->likes()->where('user_id', $user->id)->exists();

        if ($alreadyLiked) {
            // If already liked, remove the like
            $blog->likes()->where('user_id', $user->id)->delete();
            $message = 'You unliked the blog.';
        } else {
            // Otherwise, add a like
            $blog->likes()->create(['user_id' => $user->id]);
            $message = 'You liked the blog';
        }

        // Update the likes count in the blogs table
        $likesCount = $blog->likes()->count();
        $blog->update(['likes' => $likesCount]);

        return response()->json([
            'likes' => $likesCount,
            'message' => $message,
        ]);
    }

    public function toggleFavorite(Request $request, Blog $blog)
    {
        if (!auth()->check()) {
            // Log::info('Unauthorized user attempted to favorite a blog.');
            return response()->json(['error' => 'You must log in to favorite a blog.'], 403);
        }

        $user = auth()->user();
        $favorite = $blog->favorites()->where('user_id', $user->id)->first();

        if ($favorite) {
            $favorite->delete(); // Remove from favorites
            $message = 'Removed from favorites';
        } else {
            $blog->favorites()->create(['user_id' => $user->id]); // Add to favorites
            $message = 'Added to favorites';
        }

        return response()->json([
            'favorites_count' => $blog->favorites()->count(),
            'message' => $message,
        ]);
    }
}
