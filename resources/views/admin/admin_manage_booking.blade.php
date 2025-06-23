@extends('layouts.app')

@section('content')
@include('navbarAdmin')
<div class="container mt-4">
    <h1 class="text-center mb-4 display-6 fw-bold">Manage Confirmed Bookings</h1>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center">No confirmed bookings to manage.</div>
    @else
        @foreach($bookings as $booking)
        <div class="card mb-3 shadow-sm rounded-4" style="background: #eee; padding: 15px;">
            <div class="row g-0 align-items-center">
                <div class="col-md-2 text-center">
                    <img src="{{ asset('storage/' . $booking->car->carImage) }}"class="img-fluid rounded" style="max-height: 100px;" alt="Car Image">
                </div>
                <div class="col-md-7">
                    <div>
                        <strong>{{ strtoupper($booking->car->carName ?? 'CAR') }}</strong><br>
                        {{ strtoupper($booking->car->carType ?? '') }}, {{ strtoupper($booking->car->transmissionType ?? '') }}<br>
                        Pickup at: {{ $booking->pickupLocation }}<br>
                        Drop-off at: {{ $booking->dropOffLocation }}<br>
                        <hr>
                        <strong>{{ \Carbon\Carbon::parse($booking->pickupDate)->format('l, d/m/y') }} — 
                        {{ \Carbon\Carbon::parse($booking->returnDate)->format('l, d/m/y') }}</strong><br>
                        Car price a day: RM {{ number_format($booking->car->pricePerDay, 2) }}<br>
                        • {{ \Carbon\Carbon::parse($booking->pickupDate)->diffInDays(\Carbon\Carbon::parse($booking->returnDate)) + 1 }} day{{ (\Carbon\Carbon::parse($booking->pickupDate)->diffInDays(\Carbon\Carbon::parse($booking->returnDate)) + 1) > 1 ? 's' : '' }}<br>
                        <br>
                        <strong>Total Payment</strong><br>
                        RM {{ number_format($booking->totalAmount, 2) }}
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <form action="{{ route('admin.bookings.complete', $booking->bookingID) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg rounded-pill">
                            Mark Completed
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
