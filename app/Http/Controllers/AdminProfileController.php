<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user(); // Fix this line

        return view('profile_admin', compact('admin')); // Now this will work
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user(); // Fix this line
        return view('edit_admin', compact('admin'));
    }

    public function update(Request $request)
    {
            $admin = Auth::guard('admin')->user(); // Fix this line
            $request->validate([
        'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'name' => 'required|string|max:255',
        'phoneNumber' => 'required|string|regex:/^[0-9]{10,15}$/|unique:admins,phoneNumber,' . $admin->id,
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        'position' => 'required|string|max:255',
        ]);


        if ($request->hasFile('profilePhoto')) {
            $file = $request ->file('profilePhoto');

            $path = $file->store('photos','public');
            $admin->profilePhoto = $path;
            $admin->save();
            return redirect()->route('admin.edit')->with('success', 'Profile updated successfully.');

        }

        $admin->name = $request->name;
        $admin->phoneNumber = $request->phoneNumber;
        $admin->email = $request->email;
        $admin->position = $request->position;


        $admin->save();
    
        return redirect()->route('admin.edit')->with('success', 'Profile updated successfully.');
    }

}
