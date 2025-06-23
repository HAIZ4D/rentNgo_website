<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use App\Models\Customer;
use Carbon\Carbon;

class NewPasswordController extends Controller
{
    /**
     * Show the reset password form.
     */
    public function create(Request $request)
    {
        $token = $request->route('token');

        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$tokenData) {
            abort(404, 'Invalid or expired reset token.');
        }

        return view('auth.reset-password', [
            'request' => $request,
            'tokenData' => $tokenData,
        ]);
    }

    /**
     * Handle the reset password submission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$tokenData) {
            throw ValidationException::withMessages([
                'email' => ['Invalid or expired token.'],
            ]);
        }

        // Find the user based on user_type
        $user = null;

        if ($tokenData->user_type === 'admin') {
            $user = Admin::find($tokenData->user_id);
        } elseif ($tokenData->user_type === 'customer') {
            $user = Customer::find($tokenData->user_id);
        }

if (
    !$user ||
    ($tokenData->user_type === 'admin' && $user->email !== $request->email) ||
    ($tokenData->user_type === 'customer' && $user->emailAddress !== $request->email)
) {
    throw ValidationException::withMessages([
        'email' => ['We can’t find a user with that email address.'],
    ]);
}

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token
        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return redirect()->route('login')->with('status', 'Password has been reset successfully.');
    }
}
