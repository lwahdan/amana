<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Get the status filter from the request, default to 'all'
        $query = ContactMessage::query(); // Start a query builder instance
    
        // Apply the status filter if it's not 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }
    
        $contacts = $query->orderBy('created_at', 'desc')->paginate(20);
    
        return view('admin.contacts.index', compact('contacts', 'status'));
    }

    public function edit(string $id)
    {
        $contact = ContactMessage::findOrFail($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request , string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,resolved',
        ]);
    
        $contact = ContactMessage::findOrFail($id);
    
        if ($request->input('status') === 'pending') {
            $contact->update(['status' => 'pending']);
        } elseif ($request->input('status') === 'resolved') {
            $contact->update(['status' => 'resolved']);
        }

        return redirect()->route('contacts.index')->with('success', 'Contact status updated successfully!');
    }
}
