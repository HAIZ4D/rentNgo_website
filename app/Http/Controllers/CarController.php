<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.admin_manage_cars', compact('cars'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'carName' => 'required|string',
            'carModel' => 'required|string',
            'carType' => 'nullable|string',
            'availabilityStatus' => 'required|in:Available,Unavailable',
            'carImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'carSeat' => 'required|integer',
            'carMileage' => 'required|integer',
            'plateNumber' => 'required|string|unique:cars,plateNumber',
            'pricePerDay' => 'required|numeric',
            'transmissionType' => 'required|string',
            'location' => 'required|string',
            'availableFrom' => 'required|date|after_or_equal:today',
            'availableTo' => 'required|date|after_or_equal:availableFrom',
            'fuelType' => 'required|string',
        ]);

        if ($request->hasFile('carImage')) {
            $data['carImage'] = $request->file('carImage')->store('car_images', 'public');
        }

            // Get the ID of the currently logged-in admin
            $data['adminID'] = Auth::guard('admin')->id();

        Car::create($data);
        return redirect()->route('cars.manage')->with('success', 'Car added!');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit_cars', compact('car'));
    }

public function update(Request $request, Car $car)
{
    $data = $request->validate([
        'carName' => 'required|string',
        'carModel' => 'required|string',
            'carType' => 'nullable|string',
    'availabilityStatus' => 'required|in:Available,Unavailable',
        'carImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'carSeat' => 'required|integer',
        'carMileage' => 'required|integer',
        'plateNumber' => 'required|string|unique:cars,plateNumber,' . $car->carID . ',carID',
        'pricePerDay' => 'required|numeric',
        'transmissionType' => 'required|string',
        'location' => 'required|string',
        'availableFrom' => 'required|date|after_or_equal:today',
        'availableTo' => 'required|date|after_or_equal:availableFrom',
        'fuelType' => 'required|string',
    ]);

    if ($request->hasFile('carImage')) {
        // Optional: delete old image here kalau nak
        // Storage::delete('public/' . $car->carImage);

        $data['carImage'] = $request->file('carImage')->store('car_images', 'public');
    }

    $car->update($data);

    return redirect()->route('cars.manage')->with('success', 'Car updated successfully!');
}

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->back()->with('success', 'Car deleted!');
    }

    public function show(Car $car)
    {
        return view('view_car_detail', compact('car'));
    }
}
