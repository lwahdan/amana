<?php

namespace App\Http\Controllers\Auth;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        // Create the comment
        BlogComment::create([
            'user_id' => auth()->id(),
            'blog_id' => $blog->id,
            'comment' => $request->comment,
            'status' => 'pending', // Default status; admin approval needed
        ]);

        return redirect()->back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

     // manage comments replies
     public function reply(Request $request, BlogComment $comment)
     {
         $validated = $request->validate([
             'comment' => 'required|string|max:500',
         ]);
 
         BlogComment::create([
             'user_id' => auth()->id(),
             'blog_id' => $comment->blog_id,
             'comment' => $validated['comment'],
             'parent_id' => $comment->id, // Set the parent comment ID
             'status' => 'pending', // Or 'approved' based on your requirements
         ]);
 
         return back()->with('success', 'Reply submitted successfully.');
     }
}
