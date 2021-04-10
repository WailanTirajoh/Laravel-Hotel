<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('dashboard')->with('success', 'Welcome ' . auth()->user()->name);
        }
        return redirect('login')->with('failed', 'Incorrect email / password');
    }

    public function logout()
    {
        $name = auth()->user()->name;
        Auth::logout();
        return redirect('login')->with('success', 'Logout success, goodbye ' . $name);
    }
}
