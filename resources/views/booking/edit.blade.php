@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/booking-detail.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 
@include('navbar')
<div class="form-container">
    <h1 class="form-title">Edit Booking Location</h1>

    <form action="{{ route('booking.update', $booking) }}" method="POST" class="booking-form">
        @csrf
        @method('PUT')

        <!-- Pickup & Drop-Off Locations -->
        <div class="form-grid">
            <div class="form-group">
                <label for="pickupLocation">Pickup Location</label>
                <textarea name="pickupLocation" rows="3" placeholder="Enter your new pickup location">{{ old('pickupLocation', $booking->pickupLocation) }}</textarea>
            </div>

            <div class="form-group">
                <label for="dropOffLocation">Drop-Off Location</label>
                <textarea name="dropOffLocation" rows="3" placeholder="Enter your new drop-off location">{{ old('dropOffLocation', $booking->dropOffLocation) }}</textarea>
            </div>

            <div class="form-group">
                <label for="pickupDate">Pick Up Date</label>
                <input type="date" name="pickupDate" id="pickupDate"
                    value="{{ old('pickupDate', $booking->pickupDate ? \Carbon\Carbon::parse($booking->pickupDate)->format('Y-m-d') : '') }}">
            </div>

            <div class="form-group">
                <label for="returnDate">Drop-Off Date</label>
                <input type="date" name="returnDate" id="returnDate"
                    value="{{ old('returnDate', $booking->returnDate ? \Carbon\Carbon::parse($booking->returnDate)->format('Y-m-d') : '') }}">
            </div>
        </div>

        <div class="form-buttons">
            <a href="{{ route('payment.index', ['booking' => $booking->bookingID]) }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">Save Changes</button>
        </div>
    </form>
</div>
    @endsection