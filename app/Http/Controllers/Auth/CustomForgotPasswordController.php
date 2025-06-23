<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CustomForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $user = null;
        $userType = null;
        $userId = null;

$admin = DB::table('admins')->where('email', $email)->first();
if ($admin) {
    $user = $admin;
    $userType = 'admin';
    $userId = $admin->id; // ✅ correct
}

        if (!$user) {
            $customer = DB::table('customers')->where('emailAddress', $email)->first();
            if ($customer) {
                $user = $customer;
                $userType = 'customer';
                $userId = $customer->customerID;
            }
        }

        if (!$user) {
            return back()->withErrors(['email' => 'E-mail is not registered in our system.']);
        }

        $token = Str::random(64);
        $now = Carbon::now('Asia/Kuala_Lumpur');
        $expiresAt = $now->copy()->addMinutes(30);

        DB::table('password_reset_tokens')->insert([
            'user_type' => $userType,
            'user_id' => $userId,
            'token' => $token,
            'created_at' => $now,
            'expires_at' => $expiresAt,
        ]);

        $resetLink = url("/reset-password/$token") . '?email=' . urlencode($email);

        return back()->with([
            'status' => 'Reset link generated!',
            'link' => $resetLink,
        ]);
    }
}
