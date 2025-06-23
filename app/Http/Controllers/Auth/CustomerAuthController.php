<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Adjust to match your DB field 'emailAddress'
        $credentials = [
            'emailAddress' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('customer')->attempt($credentials, $request->remember)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }
}
