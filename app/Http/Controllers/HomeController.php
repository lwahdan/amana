<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //view home page
    public function index()
    {
        $services = Service::where('status', 1)->get();
        $providers = Provider::with('services')->orderBy('created_at', 'desc')->where('status', 'active')->paginate(8);
        return view('index', compact(['services', 'providers']));
    }

    //view department page
    public function service()
    {
        $services = Service::where('status', 1)->get();
        $providers = Provider::with('services')->orderBy('created_at', 'desc')->where('status', 'active')->paginate(8);
        return view('services', compact(['services', 'providers']));
    }

    //view about page
    public function about()
    {
        return view('about');
    }

    //view single blog page
    public function single_blog()
    {
        return view('single-blog');
    }

    //view team page
    public function team(Request $request)
    {
        $services = Service::all(); // Get all services for the filter
        $genderOptions = ['male', 'female']; // Define gender options

        // Start building the query
        $query = Provider::query();

        // Filter by service if provided
        if ($request->has('service_id') && $request->service_id) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('services.id', $request->service_id);
            });
        }

        // Filter by gender if provided
        if ($request->has('gender') && $request->gender) {
            $query->where('gender', $request->gender);
        }

        // Get the filtered providers
        $providers = $query->with('services')
            ->orderBy('created_at', 'desc')
            ->where('status', 'active')
            ->paginate(20);

        return view('team', compact('providers', 'services', 'genderOptions'));
    }

    //view contact page
    public function contact()
    {
        return view('contact');
    }

    //submit contact form
    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'phone' => 'numeric',
            'subject' => 'required',
        ]);

        // Create a new message in the database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
            'subject' => $request->subject,
        ]);

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }

    //view book page
    public function book()
    {
        $services = Service::where('status', true)->get(); // Active services
        $cities = City::all(); // All cities
        $providers = Provider::all(); // All providers (filter dynamically based on service if needed)

        return view('book', compact('services', 'cities', 'providers'));
    }

    //submit booking
    public function book_submit(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to make a booking.');
        }
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'city_id' => 'required|exists:cities,id',
            'provider_id' => 'required|exists:providers,id',
            'booking_date' => 'required|date|after:today',
            'shift' => 'required|in:morning,night,stayin',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'provider_id' => $request->provider_id,
            'city_id' => $request->city_id,
            'booking_date' => $request->booking_date,
            'shift' => $request->shift,
            'total_price' => $this->calculatePrice($request->provider_id, $request->shift),
        ]);

        return redirect()->route('book')->with('success', 'Your booking has been successfully submitted.');
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

    // Get dynamically filtered providers based on selected service, city, and shift
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

    //view provider info (profile)
    public function providerInfo($id)
    {
        $provider = Provider::with('services')->find($id);

        if (!$provider) {
            return abort(404, 'Provider not found');
        }

        // Fetch providers offering the same services
        $relatedProviders = Provider::whereHas('services', function ($query) use ($provider) {
            $query->whereIn('services.id', $provider->services->pluck('id'));
        })
            ->where('id', '!=', $provider->id) // Exclude the current provider
            ->distinct() // Ensure no duplicates
            ->with('services') // Eager load services
            ->limit(10) // Optional: Limit the number of related providers
            ->get();

        return view('provider', compact('provider', 'relatedProviders'));
    }

    public function thanks()
    {
        return view('thanks');
    }
}
