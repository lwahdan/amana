<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Provider;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch counts for each entity
        $data = [
            'usersCount' => User::count(),
            'providersCount' => Provider::count(),
            'blogsCount' => Blog::count(),
            'commentsCount' => BlogComment::count(),
        ];

        // Pass the counts to the view
        return view('admin.index', $data);
    }

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_dashboard');
        }
        return view('admin.login');
    }

    public function login_submit(request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success', 'login successfull');
        } else {
            return redirect()->route('admin_login')->with('error', 'invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'logout successfully');
    }

    public function AdminProfile()
    {
        $id = auth::user()->id;
        $profileData = User::find($id);
        return view('admin.profile', compact('profileData'));
    }
}
