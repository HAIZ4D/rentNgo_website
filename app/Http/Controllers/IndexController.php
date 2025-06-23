<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;

class IndexController extends Controller
{
public function index(Request $request)
{
    $query = Car::query();

    // Always only show available cars
    $query->where('availabilityStatus', 'Available');

    // Filter by date range if provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query->whereDate('availableFrom', '<=', $start)
              ->whereDate('availableTo', '>=', $end);
    }

    $cars = $query->get();

    return view('index', compact('cars'));
}

public function search(Request $request)
{
    $validated = $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    $startDate = $request->start_date;
    $endDate = $request->end_date;

    if (!$startDate || !$endDate) {
        // Only get available cars if no date is selected
        $cars = Car::where('availabilityStatus', 'Available')->get();
    } else {
        $bookedCarIDs = Booking::where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('pickupDate', [$startDate, $endDate])
                  ->orWhereBetween('returnDate', [$startDate, $endDate])
                  ->orWhere(function ($query) use ($startDate, $endDate) {
                      $query->where('pickupDate', '<=', $startDate)
                            ->where('returnDate', '>=', $endDate);
                  });
        })->pluck('carID');

        // Filter out booked cars AND only show available ones
        $cars = Car::whereNotIn('carID', $bookedCarIDs)
                   ->where('availableFrom', '<=', $startDate)
                   ->where('availableTo', '>=', $endDate)
                   ->where('availabilityStatus', 'Available') 
                   ->get();
    }

    return view('index', compact('cars', 'startDate', 'endDate'));
}
}
