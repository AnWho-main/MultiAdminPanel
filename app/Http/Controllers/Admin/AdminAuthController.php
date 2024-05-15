<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }


        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        $user = Auth::guard('admin')->logout();

        // Clear all session data for the specific user
        if ($user) {
            Session::forget($user->getAuthIdentifier());
        }
        return redirect()->route('admin.login')->withCookie(\Cookie::forget('laravel_session'));
    }

}
