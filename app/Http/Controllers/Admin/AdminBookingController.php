<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
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

        // Filter by status
        if ($status === 'cancelled') {
            $query->onlyTrashed(); // Retrieve only soft-deleted (cancelled) bookings
        } elseif ($status !== 'all') {
            $query->where('status', $status); // Retrieve bookings by status
        }

        $bookings = $query->with(['user', 'service'])
            ->withTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $services = Service::where('status', true)->get(); // Active services
        $cities = City::all(); // All cities
        $providers = Provider::all(); // All providers (filter dynamically based on service if needed)

        return view('admin.bookings.create', compact('users', 'services', 'cities', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'provider_id' => 'required|exists:providers,id',
            'city_id' => 'required|exists:cities,id',
            'booking_date' => 'required|date|after:today',
            'shift' => 'required|in:morning,night,stayin',
        ]);

        $validated['total_price'] = $this->calculatePrice($validated['provider_id'], $validated['shift']);
        $validated['status'] = 'confirmed';

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'service', 'provider', 'city'])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::with(['user', 'service', 'provider', 'city'])->findOrFail($id);
        $users = User::all();
        $services = Service::all();
        $providers = Provider::all();
        $cities = DB::table('cities')->get();

        return view('admin.bookings.edit', compact('booking', 'users', 'services', 'providers', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'provider_id' => 'required|exists:providers,id',
            'city_id' => 'required|exists:cities,id',
            'booking_date' => 'required|date',
            'shift' => 'required|in:morning,night,stayin',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_price' => 'required|numeric',
        ]);

        if ($validated['status'] == 'cancelled') {
            if (!$booking->trashed()) {
                $booking->delete();
            }
        }
        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //make it softdelete 
    {
        $booking = Booking::findOrFail($id);
        // Update the status to 'cancelled' before soft-deleting
        $booking->update(['status' => 'cancelled']);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully!');
    }

    // Calculate the total price based on the shift and provider
    private function calculatePrice($provider_id, $shift)
    {
        // Fetch the provider by ID
        $provider = Provider::findOrFail($provider_id);

        // Base hourly rate
        $hourly_rate = $provider->hourly_rate;

        // Calculate total price based on the shift
        switch ($shift) {
            case 'morning':
            case 'night':
                return $hourly_rate * 12; // 12-hour shift
            case 'stayin':
                return $hourly_rate * 24; // 24-hour shift
            default:
                throw new \InvalidArgumentException("Invalid shift value: $shift");
        }
    }

    public function getProviders(Request $request)
    {
        $service_id = $request->service_id;
        $city_id = $request->city_id;
        $shift = $request->shift;

        // Fetch providers based on the selected criteria
        $providers = Provider::whereHas('services', function ($query) use ($service_id) {
            $query->where('services.id', $service_id);
        })
            ->whereHas('cities', function ($query) use ($city_id) {
                $query->where('cities.id', $city_id);
            })
            ->whereJsonContains('work_shifts', $shift) // Ensure providers support the selected shift
            ->get(['id', 'name']); // Fetch only id and name

        return response()->json($providers);
    }

    public function restore($id)
    {
        $booking = Booking::withTrashed()->findOrFail($id);
        $booking->update(['status' => 'confirmed']);
        $booking->restore(); // Restore the soft-deleted user
        return redirect()->route('bookings.index')->with('success', 'Booking restored successfully!');
    }
}
