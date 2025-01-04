<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Get the status filter from the request, default to 'all'
        $query = Blog::query();

        if ($status !== 'all') {
            $query->where('status', $status); // Apply status filter if not 'all'
        }

        $blogs = $query->orderBy('updated_at', 'desc')->withTrashed()->paginate(10);

        return view('admin.blogs.index', compact('blogs', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
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

        $data = $request->only(['title', 'service_id', 'description', 'content']);
        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
    
            // Store new image
            $data['image'] = $request->file('image')->store('blogs', 'public');
        } else {
            // Keep old image
            $data['image'] = $blog->image;
        }
        // Set status to 'pending' for admin approval
        $data['status'] = 'pending';

        $blog->update($data);

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog = Blog::findOrFail($blog->id);
        // Update the status to 'cancelled' before soft-deleting
        $blog->update(['status' => 'rejected']);
        $blog->delete();
        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully.');
    }

    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->update(['status' => 'approved']);
        $blog->restore(); // Restore the soft-deleted user
        return redirect()->route('admin.blogs')->with('success', 'Blog restored successfully!');
    }
}
