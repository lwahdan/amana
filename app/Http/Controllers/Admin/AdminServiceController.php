<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::withTrashed()->paginate(10); // Fetch services with pagination
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        if ($request->hasFile('image')) {
            $serviceImagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $serviceImagePath;
        } else {
            $validated['image'] = $service->image ?? null; 
        }

        Service::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'image' => $validated['image'],
        ]);
        
        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        // Paginate providers related to this service
        $providers = $service->providers()->paginate(20);
    
        return view('admin.services.show', compact('service', 'providers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $serviceImagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $serviceImagePath;
        }
    
        if (isset($validated['image'])) {
            $service = Service::findOrFail($id);
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        }
    
        $service = Service::findOrFail($id);
        $service->update($validated);
    
        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }

    // To restore a soft-deleted record
    public function restore($id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore(); // Restore the soft-deleted user
        return redirect()->route('services.index')->with('success', 'Service restored successfully!');
    }
}
