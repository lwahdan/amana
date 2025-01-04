<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Get the status filter from the request, default to 'all'
        $query = BlogComment::query(); // Start a query builder instance
    
        // Apply the status filter if it's not 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }
    
        $comments = $query->orderBy('created_at', 'desc')->paginate(20);
    
        return view('admin.comments.index', compact('comments', 'status'));
    }

    public function edit(string $id)
    {
        $comment = BlogComment::findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request , string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        $comment = BlogComment::findOrFail($id);
    
        if ($request->input('status') === 'pending') {
            $comment->update(['status' => 'pending']);
        } elseif ($request->input('status') === 'approved') {
            $comment->update(['status' => 'approved']);
        } elseif ($request->input('status') === 'rejected') {
            $comment->update(['status' => 'rejected']);
        }

        return redirect()->route('comments.index')->with('success', 'Comment status updated successfully!');
    }

}
