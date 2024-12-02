<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function dashboard(){
        return view('provider.dashboard');
    }

    public function login(){
        if (Auth::guard('provider')->check()) {
            return redirect()->route('provider_dashboard');
        }
        return view('provider.login');
    }

    public function login_submit( request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $check = $request->all();
        $data = [
            'email'=>$check['email'],
            'password'=>$check['password'],
        ];

        if(Auth::guard('provider')->attempt($data)){
            return redirect()->route('provider_dashboard')->with('success','login successfull');
        }else{
            return redirect()->route('provider_login')->with('error','invalid credentials');
        }
    }

    public function logout(){
        Auth::guard('provider')->logout();
        return redirect()->route('provider_login')->with('success','logout successfully');
    }
}
