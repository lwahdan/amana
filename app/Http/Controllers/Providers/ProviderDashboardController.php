<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderDashboardController extends Controller
{
    public function profile()
    {
        return view('provider.info');
    }

    public function bookings()
    {
        return view('provider.bookings');
    }

    public function meetings()
    {
        return view('provider.meetings');
    }

    public function reviews()
    {
        return view('provider.reviews');
    }
}
