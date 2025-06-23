@extends('layouts.app')
@section('content')
@include('navbar')

<style>
    .booking-history {
        font-family: Arial, sans-serif;
        padding: 30px 0;
    }

    .booking-card {
        display: flex;
        background-color: #e5e5e5;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 25px;
        align-items: center;
        justify-content: space-between;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .booking-left {
        width: 160px;
        text-align: center;
    }

    .booking-left img {
        width: 120px;
        margin-bottom: 10px;
    }

    .booking-info {
        flex: 1;
        padding: 0 20px;
        border-left: 2px solid #999;
    }

    .booking-info p {
        margin: 5px 0;
    }

    .booking-right {
        text-align: center;
    }

    .btn-feedback {
        background-color: blue;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 30px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }

    .feedback-stars {
        font-size: 20px;
        color: gold;
        font-weight: bold;
    }

    .feedback-comment {
        margin-top: 10px;
        font-size: 14px;
        max-width: 250px;
        text-align: left;
    }

    h2.title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        margin-left: 50px;
    }
</style>

<div class="booking-history">

    <h2 class="title">Pending Bookings</h2>
@forelse ($pendingBookings as $booking)
    @php
        $pickup = \Carbon\Carbon::parse($booking->pickupDate);
        $return = \Carbon\Carbon::parse($booking->returnDate);
        $days = $pickup->diffInDays($return) + 1;
        $carPrice = $days > 0 ? number_format(($booking->totalAmount) / $days, 2) : 'N/A';
    @endphp

    <div class="booking-card">
        <div class="booking-left">
            <img src="{{ asset('storage/' . $booking->car->carImage) }}" alt="Car Image">
            <strong>{{ $booking->car->carName }}</strong><br>
            <small>{{ $booking->car->carType }}, {{ $booking->car->transmissionType }}<br>
                   Pickup at: {{ $booking->pickupLocation }}<br>
                   Drop-off at: {{ $booking->dropOffLocation }}</small>
        </div>

        <div class="booking-info">
            <p><strong>{{ $pickup->format('l, d/m/y') }}</strong> — 
               <strong>{{ $return->format('l, d/m/y') }}</strong></p>
            <p>Car price a day: RM {{ $carPrice }}</p>
            <p>• {{ $days }} day{{ $days != 1 ? 's' : '' }}</p>
            <hr style="border-top: 1px solid #999;">
            <p><strong>Total Payment</strong><br>RM{{ number_format($booking->totalAmount, 2) }}</p>
        </div>

        <div class="booking-right">
            <a href="{{ route('payment.index', ['booking' => $booking->bookingID]) }}"
               class="btn btn-success"
               style="padding: 12px 20px; font-weight: 600; text-align: center; text-decoration: none; border: none; border-radius: 30px;">
                <i class="bi bi-credit-card"></i> Proceed to Payment
            </a>
        </div>
    </div>
@empty
    <p style="text-align:center;">No pending bookings.</p>
@endforelse

    <h2 class="title">Your Booking History</h2>

    @foreach ($completedBookings as $booking)
        @php
            $pickup = \Carbon\Carbon::parse($booking->pickupDate);
            $return = \Carbon\Carbon::parse($booking->returnDate);
            $days = $pickup->diffInDays($return)+1;
            $carPrice = $days > 0 ? number_format(($booking->totalAmount) / $days, 2) : 'N/A';
        @endphp

        <div class="booking-card">
            <div class="booking-left">
                <img src="{{ asset('storage/' . $booking->car->carImage) }}" alt="Car Image">
                <strong>{{ $booking->car->carName }}</strong><br>
                <small>{{$booking->car->carType}}, {{ $booking->car->transmissionType }}<br>Pickup at: {{ $booking->pickupLocation }}<br>Drop-off at: {{ $booking->dropOffLocation }}</small>
            </div>

            <div class="booking-info">
                <p><strong>{{ $pickup->format('l, d/m/y ') }}</strong> — 
                   <strong>{{ $return->format('l, d/m/y ') }}</strong></p>
                <p>Car price a day: RM {{ $carPrice }}</p>
                <p>• {{ $days }} day{{ $days != 1 ? 's' : '' }}</p>
                <hr style="border-top: 1px solid #999;">
                <p><strong>Total Payment</strong><br>RM{{ number_format($booking->totalAmount, 2) }}</p>

                @if ($days == 0)
                    <p style="color: red;"><strong>⚠️ Same-day booking – please review dates.</strong></p>
                @endif
            </div>

            <div class="booking-right">
                @if ($booking->feedback)
                    <p>⭐ {{ $booking->feedback->rating }}</p>
                    <p><strong>Feedback:</strong> {{ $booking->feedback->comment }}</p>
                    <a href="{{ route('feedback.form', $booking->bookingID) }}" class="btn-feedback">Update Feedback</a>
                @else
                    <a href="{{ route('feedback.form', $booking->bookingID) }}" class="btn btn-feedback">Provide Feedback</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
