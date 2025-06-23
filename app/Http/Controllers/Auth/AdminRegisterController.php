<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminRegisterController extends Controller
{
    public function show()
    {
        return view('auth.register-admin');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:6',
        ]);

        session([
            'pending_admin_registration' => [
                'name' => $request->name,
                'email' => $request->email,
                'position' => $request->position, // ✅ Add this line
                'password' => $request->password,
                
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return redirect()->route('verify.admin.code'); // Ensure this route/view exists
    }
}
