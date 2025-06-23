<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminVerificationController extends Controller
{
    public function showVerificationForm()
    {
        // Ensure registration data is present
        if (!session()->has('pending_admin_registration')) {
            return redirect()->route('register.admin')->withErrors(['session' => 'No registration data found.']);
        }

        return view('auth.admin-verify-code');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'admin_code' => 'required|string',
        ]);

        $expected_code = 'MYADMIN2025';

        if ($request->admin_code !== $expected_code) {
            return back()->withErrors(['admin_code' => 'Invalid admin registration code.']);
        }

        $data = session('pending_admin_registration');

        if (!$data) {
            return redirect()->route('register.admin')->withErrors(['session' => 'No registration data found.']);
        }

        if (Admin::where('email', $data['email'])->exists()) {
            return back()->withErrors(['email' => 'An account with this email already exists.']);
        }

        $admin = new Admin();
        $admin->position = $data['position'];
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        
 
        $admin->created_at = $data['created_at'];
        $admin->updated_at = $data['updated_at'];
        $admin->save();

        // Generate admin code like 0001, 0002, etc.
        $admin->adminCode = str_pad($admin->id, 4, '0', STR_PAD_LEFT);
        $admin->save();

        session()->forget('pending_admin_registration');

        return view('auth.admin-verify-code', [
            'success' => "Registration successful! Your Admin ID is <b>{$admin->adminCode}</b>. You can now <a href='" . route('login') . "'>login</a>."
        ]);
    }
}
