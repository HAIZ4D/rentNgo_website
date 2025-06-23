<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DrivingLicense;


class CustomerProfileController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $driving_license = DrivingLicense::where('customerID', $customer->customerID)->first();
        return view('profile_customer', compact('customer', 'driving_license'));
    }
    public function edit()
    {
        $customer = Auth::guard('customer')->user(); 
        $driving_license = \App\Models\DrivingLicense::where('customerID', $customer->customerID)->first();
        return view('edit_customer', compact('customer','driving_license'));
    }

    public function update(Request $request)
{
    $customer = Auth::guard('customer')->user();

    $request->validate([
        'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'name' => 'required|string|max:255',
        'phoneNumber' => 'required|string|regex:/^[0-9]{10,15}$/|unique:customers,phoneNumber,' . $customer->customerID . ',customerID',
        'emailAddress' => 'required|email|unique:customers,emailAddress,' . $customer->customerID . ',customerID',

        // Driving License Fields
        'licenseNumber' => 'required|string|max:50',
        'expiryDate' => 'required|date',
        'dateOfBirth' => 'required|date',
        'licenseClass' => 'required|string|max:10',
        'countryIssued' => 'required|string|max:100',
        'licenseImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle profile photo upload
    if ($request->hasFile('profilePhoto')) {
        $file = $request->file('profilePhoto');
        $path = $file->store('photos', 'public');
        $customer->profilePhoto = $path;
    }

    $customer->name = $request->name;
    $customer->phoneNumber = $request->phoneNumber;
    $customer->emailAddress = $request->emailAddress;
    $customer->save();

    // Handle driving license
    $driving_license = DrivingLicense::firstOrNew([
        'customerID' => $customer->customerID
    ]);

    $driving_license->licenseNumber = $request->licenseNumber;
    $driving_license->expiryDate = $request->expiryDate;
    $driving_license->dateOfBirth = $request->dateOfBirth;
    $driving_license->licenseClass = $request->licenseClass;
    $driving_license->countryIssued = $request->countryIssued;
    $driving_license->issueDate = $request->issueDate;


    if ($request->hasFile('licenseImage')) {
        $licensePath = $request->file('licenseImage')->store('licenses', 'public');
        $driving_license->licenseImage = $licensePath;
    }
    $driving_license->fullName = $customer->name;
    $driving_license->save();

    return redirect()->route('customer.edit')->with('success', 'Profile updated successfully.');
}

}
