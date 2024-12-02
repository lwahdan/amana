<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $query = Booking::query();

        if ($status !== 'all') {
        $query->where('status', $status);
        }

        $bookings = $query->with(['user', 'service'])->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $services = Service::all();
        return view('admin.bookings.create', compact('users', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:pending,confirmed,completed',
            'details' => 'nullable|string',
        ]);
    
        Booking::create($validated);
    
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'service', 'serviceProvider', 'city'])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::with(['user', 'service', 'serviceProvider', 'city'])->findOrFail($id);
        $users = User::all();
        $services = Service::all();
        $serviceProviders = Provider::all();
        $cities = DB::table('cities')->get();
    
        return view('admin.bookings.edit', compact('booking', 'users', 'services', 'serviceProviders', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,canceled',
        ]);
    
        $booking = Booking::findOrFail($id);
        $booking->update($validated);
    
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //make it softdelete 
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    
        return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully!');
    }
}
