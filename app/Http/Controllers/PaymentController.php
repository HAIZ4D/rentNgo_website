<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\CardPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Booking $booking)
    {
        $userId = Auth::id();
        $serviceFee = 20.00;
    
        // // Get the most recent booking for the logged-in user
        // $booking = Booking::with('car')
        //     ->where('customerID', $userId)
        //     ->latest() // or ->orderBy('created_at', 'desc')
        //     ->first();
    
        if ($booking) {
            $booking->totalWithService = $booking->totalAmount + $serviceFee;
        }
    
        return view('booking.payment', ['booking' => $booking]);
    }



    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'methodPayment' => ['required', 'string'],
        ]);

        $payment = Payment::where('name', $request->name)->first();

        if ($payment) {
            $payment->method = $request->method;
            $payment->save();

            return redirect()->back()->with('success', 'Payment method updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Payment record not found.');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'methodPayment' => ['required', 'string'],
            'bookingID' => ['required', 'exists:bookings,bookingID'],
            'amount' => ['required', 'numeric'],
            'paymentDate' => ['required', 'date'],
            'paymentStatus' => ['required', 'string'],
            'bankName' => ['nullable', 'string', 'max:255'],
            'accountNumber' => ['nullable', 'string', 'max:255'],

            // Validations for card payments
            'cardNumber' => ['required_if:methodPayment,Card', 'string'],
            'expiryDate' => ['required_if:methodPayment,Card', 'string'],
            'securityCode' => ['required_if:methodPayment,Card', 'string'],
            'cardHolderName' => ['required_if:methodPayment,Card', 'string'],
        ]);

        $booking = Booking::findOrFail($validated['bookingID']);

        // Save payment
        $payment = Payment::create([
            'name' => $validated['name'],
            'methodPayment' => $validated['methodPayment'],
            'bookingID' => $validated['bookingID'],
            'amount' => $booking->totalAmount,
            'paymentDate' => $validated['paymentDate'],
            'paymentStatus' => $validated['paymentStatus'],
            'bankName' => $validated['bankName'] ?? null,
            'accountNumber' => $validated['accountNumber'] ?? null,
        ]);

        // If payment method is Card, store in card_payments table
        if ($validated['methodPayment'] === 'Card') {
            $maskedCardNumber = '**** **** **** ' . substr($validated['cardNumber'], -4);

            CardPayment::create([
                'paymentID' => $payment->id,
                'cardHolderName' => $validated['cardHolderName'],
                'cardNumber' => $maskedCardNumber,
                'securityCode' => '***',
                'expiryDate' => $validated['expiryDate'],
            ]);
        }

        // ✅ Update booking status to Confirmed
        $booking->bookingStatus = 'Confirmed';
        $booking->save();

        return redirect()->route('payment.success', ['booking' => $validated['bookingID']])
            ->with('message', 'Payment created successfully!');
    }

    
    public function paymentSuccess($bookingId)
    {
        $booking = Booking::with('car')->findOrFail($bookingId);
        return view('booking.success', compact('booking'));
    }
}
