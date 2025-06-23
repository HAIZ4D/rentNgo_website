<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\booking; 
use Illuminate\Http\Request;
use App\Models\Feedback_booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function manageBookings()
{
    $adminID = Auth::guard('admin')->id();

    // Fetch confirmed bookings for this admin
    $bookings = Booking::with('car')
        ->where('adminID', $adminID)
        ->where('bookingStatus', 'Confirmed')
        ->get();

    return view('admin.admin_manage_booking', compact('bookings'));
}

public function markCompleted(Booking $booking)
{
    if ($booking->adminID !== Auth::guard('admin')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $booking->bookingStatus = 'Completed';
    $booking->save();

    return redirect()->route('admin.bookings.manage')
        ->with('message', 'Booking marked as completed.');
}


    public function showBookingHistory()
    {
        $customerID = Auth::guard('customer')->id(); 
        // booking history or completed bookings
        $completedBookings = Booking::with(['car', 'feedback'])
            ->whereHas('car') // only get bookings that have a car
            ->where('customerID', $customerID)
            ->where('bookingStatus', 'Completed') // ✅ Filter only completed bookings
            ->get();

        // pending bookings
        $pendingBookings = Booking::with(['car', 'feedback'])
        ->whereHas('car')
        ->where('customerID', $customerID)
        ->where('bookingStatus', 'Pending')
        ->get();
        return view('history', compact('completedBookings','pendingBookings'));
    }
    public function index1() {
        $userId = Auth::id();
        $bookings = Booking::with('car')
            ->where('customerID', $userId)
            ->get();
        return view('booking.index', [
            'bookings'=> $bookings
        ]);
    }
    public function index2() {
        $userId = Auth::id();
        $bookings = Booking::with('car')
            ->where('customerID', $userId)
            ->get();
        return view('booking.car-list', [
            'bookings'=> $bookings
        ]);
    }

    public function showByCar($carID)
    {
        $car = Car::findOrFail($carID);
        return view('booking.detail', compact('car'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pickupLocation' => ['required', 'string'],
            'dropOffLocation' => ['required', 'string'],
            'pickupDate' => ['required', 'date', 'after_or_equal:today'],
            'returnDate' => ['required', 'date', 'after_or_equal:pickupDate'],
            'adminID' => ['required', 'integer'],
            'carID' => ['required', 'integer'],
        ]);

        // Get dates and calculate rental days
        $pickup = Carbon::parse($data['pickupDate']);
        $return = Carbon::parse($data['returnDate']);
        $days = $pickup->diffInDays($return) + 1;

        // Get car price
        $car = Car::findOrFail($data['carID']);
        $dailyRate = $car->pricePerDay;

        $data['totalAmount'] = $days * $dailyRate;
        $data['bookingStatus'] = 'Pending';
        $data['isLateReturn'] = 0;
        $data['lateFee'] = 0;
        $data['date'] = now();

        // Get logged-in customer
        $data['customerID'] = auth()->user()->customerID ?? 1; // fallback for testing

        // Create booking
        $booking = \App\Models\Booking::create($data);

        return redirect()->route('booking.detail', $booking->bookingID)
            ->with('message', 'Booking created successfully!');
    }
    public function update(Request $request, Booking $booking)
    {
        // if ($booking->customerID !== auth()->id()) {
        //     abort(403);
        // }
        $data = $request-> validate([
            'pickupLocation' => ['required', 'string'],
            'dropOffLocation' => ['required', 'string'],
            'pickupDate' => ['required', 'date', 'after_or_equal:today'],
            'returnDate' => ['required', 'date', 'after_or_equal:pickupDate'],
        ]);
        // Get car's daily price from relation
        // Parse dates
        $pickup = Carbon::parse($data['pickupDate']);
        $return = Carbon::parse($data['returnDate']);

        // Calculate number of days
        $days = $pickup->diffInDays($return) + 1;

        // Get the car's daily price
        $dailyRate = $booking->car->pricePerDay;

        // Recalculate total
        $data['totalAmount'] = $days * $dailyRate;

        // Update booking
        $booking->update($data);

        return to_route('booking.detail', $booking)
            ->with('message', 'Booking updated. Total: RM' . number_format($data['totalAmount'], 2));
    }

    public function edit(Booking $booking)
    {
        if ($booking->customerID !== auth()->id()) {
            abort(403);
        }
        return view('booking.edit', ['booking' =>$booking], );
    }

    public function destroy(Booking $booking)
    {
        //  if($booking->customerID != request()->user()->id){
        //      abort(403);
        // }
        $booking ->delete();
        return to_route('index')->with('message', 'booking was deleted');
    }

    public function showDetail($id = null)
    {
         $car = Car::findOrFail($carID);
        return view('booking.detail', compact('car'));
    }
        public function show(Booking $booking)
    {
        return view('booking.detail', [
            'booking' => $booking,
            'car' => $booking->car // if you have the relation setup
        ]);
    }
    public function createWithCar($carID)
    {
        $car = Car::findOrFail($carID);
        return view('booking.detail', compact('car'));
    }

}