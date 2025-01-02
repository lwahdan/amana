<?php

namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\Service;
use App\Models\BlogComment;
use App\Models\BlogFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::withCount('comments')->where('status', 'approved')->orderBy('updated_at', 'desc')->paginate(10);
        $services = Service::all();
        return view('blogs.index', compact(['blogs', 'services']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('status', 1)->get();
        return view('blogs.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Check if the user is logged in as a provider or user
        if (auth('provider')->check()) {
            $data['writer_id'] = auth('provider')->id();
            $data['writer_type'] = get_class(auth('provider')->user());
        } elseif (auth('web')->check()) {
            $data['writer_id'] = auth('web')->id();
            $data['writer_type'] = get_class(auth('web')->user());
        } else {
            abort(403, 'Unauthorized action.');
        }

        // Set default status and handle image upload
        $data['status'] = 'pending';
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('blogs', 'public') : null;

        // Create the blog
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
        // Paginate approved comments
        $comments = $blog->comments()->where('status', 'approved')->whereNull('parent_id')->paginate(5);
        // Check the user's like and favorite state
        $user = auth()->user();
        $hasLiked = $user ? $blog->likes()->where('user_id', $user->id)->exists() : false;
        $isFavorited = $user ? $blog->favorites()->where('user_id', $user->id)->exists() : false;

        // Fetch the previous post (by ID, created_at, or another criteria)
        $prevBlog = Blog::where('id', '<', $blog->id)
            ->orderBy('id', 'desc')
            ->first();

        $nxtBlog = Blog::where('id', '>', $blog->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('blogs.show', compact('blog', 'comments', 'hasLiked', 'isFavorited', 'prevBlog', 'nxtBlog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $services = Service::where('status', 1)->get();
        return view('blogs.edit', compact(['blog', 'services']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user or provider
        $user = Auth::guard('web')->user() ?? Auth::guard('provider')->user();

        // Ensure the user is logged in
        if (!$user) {
            abort(403, 'You must be logged in to perform this action.');
        }

        // Ensure the user or provider owns the blog
        if ($blog->writer_id !== $user->id || $blog->writer_type !== get_class($user)) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->only(['title', 'service_id', 'description', 'content']);
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('blogs', 'public') : null;
        // Set status to 'pending' for admin approval
        $data['status'] = 'pending';

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
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

    // filter blogs by service
    public function filterByService(Service $service)
    {
        // Fetch blogs associated with the selected service
        $blogs = Blog::withCount('comments')
            ->where('service_id', $service->id)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $services = Service::all(); // Fetch all services for the category list

        return view('blogs.index', compact('blogs', 'services', 'service'));
    }
}
