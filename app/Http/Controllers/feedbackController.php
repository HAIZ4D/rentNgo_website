<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Feedback_booking;


class FeedbackController extends Controller
{
    
    public function showForm($bookingID)
{
    // Load booking with car and feedback relationship
    $booking = Booking::with(['car', 'feedback'])->findOrFail($bookingID);
    
    // Access the related feedback (can be null if not submitted yet)
    $feedback = $booking->feedback;

    // Pass both booking and feedback to the view
    return view('feedback', compact('booking', 'feedback'));
}


public function submit(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,bookingID',
        'comment' => 'required|string',
        'rating' => 'required|numeric|min:1|max:5',
    ]);

    $booking = Booking::findOrFail($request->booking_id);

    $feedback = $booking->feedback; // Assuming you have `hasOne` relationship

    if ($feedback) {
        // Update existing feedback
        $feedback->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'dateSubmitted' => now(),
        ]);
    } else {
        // Create new feedback
        Feedback_booking::create([
            'bookingID' => $request->booking_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'dateSubmitted' => now(),
        ]);
    }

    return redirect()->route('booking.history')->with('success', 'Feedback saved successfully!');
}


}
