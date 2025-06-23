<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerRegisterController extends Controller
{
    public function show()
    {
        return view('auth.register-customer');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'emailAddress' => 'required|email|unique:customers,emailAddress',
        'password' => 'required|confirmed|min:6',
        'phoneNumber' => 'nullable|string',
        'licenseNumber' => 'nullable|string',
        'ICNumber' => 'nullable|string',
        'address' => 'nullable|string',
        'licenseStatus' => 'nullable|string',
        'paymentMethods' => 'nullable|string',
    ]);

    Customer::create([
        'name' => $request->name,
        'emailAddress' => $request->emailAddress,
        'password' => Hash::make($request->password),
        'phoneNumber' => $request->phoneNumber,
        'licenseNumber' => $request->licenseNumber,
        'ICNumber' => $request->ICNumber,
        'address' => $request->address,
        'licenseStatus' => $request->licenseStatus,
        'paymentMethods' => $request->paymentMethods,
        'profilePhoto' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('customer.login')->with('success', 'Registration successful! You can now login.');
}
}
