<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminBlogController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::withCount('comments')->where('status', 'approved')->orderBy('updated_at', 'desc')->paginate(10);
        $services = Service::all();
        return view('admin.blogs.index', compact(['blogs', 'services']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('status', 1)->get();
        return view('admin.blogs.create', compact('services'));
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

        // Check if the user is logged in as an admin
        if (auth('admin')->check()) {
            $data['writer_id'] = auth('admin')->id();
            $data['writer_type'] = get_class(auth('admin')->user());
        } else {
            abort(403, 'Unauthorized action.');
        }

        // Set default status and handle image upload
        $data['status'] = 'pending';
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('blogs', 'public') : null;

        // Create the blog
        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog submitted for approval.');
    }

    /**
     * Display the specified resource./Route Model Binding
     */
    public function show(Blog $blog)
    {
        // Reload with counts
        $blog = $blog->loadCount(['comments', 'favorites']);
        // Paginate approved comments
        $comments = $blog->comments()->where('status', 'approved')->whereNull('parent_id')->paginate(5);
        return view('admin.blogs.show', compact('blog', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $services = Service::where('status', 1)->get();
        return view('admin.blogs.edit', compact(['blog', 'services']));
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

        // Get the authenticated admin
        $user = Auth::guard('admin')->user();

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

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
