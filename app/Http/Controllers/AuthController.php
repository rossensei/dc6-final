<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create($attr);

        return back()->with('success', 'Account registration successful!');
    }

    public function authenticate(Request $request)
    {
        $cred = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($cred)) {
            return redirect()->intended('/home');
        } else {
            return back()->withErrors([
                'email' => 'These credentials do not match out records.'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('success', 'You have been logged out!');
    }
}
