<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class HomeController extends Controller
{
    //view home page
    public function index()
    {
        $services = Service::where('status', 1)->get();
        $providers = Provider::with('services')->paginate(8);
        return view('index', compact(['services', 'providers']));
    }

    //view department page
    public function department()
    {
        $services = Service::where('status', 1)->get();
        $providers = Provider::with('services')->paginate(8);
        return view('Department', compact(['services', 'providers']));
    }

    //view about page
    public function about()
    {
        return view('about');
    }

    //view blog page
    public function blog()
    {
        return view('blog');
    }

    //view single blog page
    public function single_blog()
    {
        return view('single-blog');
    }

    //view team page
    public function team()
    {
        $providers = Provider::with('services')->paginate(20);
        return view('team', compact('providers'));
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


}
