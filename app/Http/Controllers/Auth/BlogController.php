<?php

namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\BlogFavorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('status', 'approved')->paginate(10);
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
        $blog->increment('views');
        return view('blogs.show', compact('blog'));
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

    public function like(Blog $blog)
    {
        $blog->increment('likes');
        return back()->with('success', 'You liked the blog.');
    }

    public function favorite(Blog $blog)
    {
        BlogFavorite::firstOrCreate(['user_id' => auth()->id(), 'blog_id' => $blog->id]);
        return back()->with('success', 'Blog added to favorites.');
    }
}
