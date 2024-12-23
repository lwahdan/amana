<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Provider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $services =Service::where('status',1)->get();
        $providers = Provider::with('services')->paginate(8);
        return view('index',compact(['services','providers']));
    }
}
