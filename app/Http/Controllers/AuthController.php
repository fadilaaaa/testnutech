<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect('/products')->with('success', 'Welcome back, ' . $user->name);
        } else {
            return redirect('/')->with('error', 'Invalid credentials')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
