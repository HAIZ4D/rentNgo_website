@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/booking-detail.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 
@include('navbar')
<div class="invoice-container">
    <!-- Success Message -->
    <div class="success-message">
        <h1 class="success-title">✅ Payment Successful!</h1>
        <p class="success-subtext">Thank you for your booking. Your payment has been received.</p>
    </div>

    <!-- Invoice Section -->
    <div id="invoice" class="invoice-box">
        <h2 class="invoice-heading">Booking Invoice</h2>

        <div class="invoice-row">
            <p><strong>Invoice No:</strong> #INV{{ $booking->id }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>

        <div class="invoice-row">
            <p><strong>Customer Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->emailAddress }}</p>
        </div>

        <div class="invoice-row">
            <p><strong>Car:</strong> {{ $booking->car->carName }} - {{ $booking->car->carModel }}</p>
            <p><strong>Pickup:</strong> {{ $booking->pickupLocation }} ({{ \Carbon\Carbon::parse($booking->pickupDate)->format('d M Y') }})</p>
            <p><strong>Drop-off:</strong> {{ $booking->dropOffLocation }} ({{ \Carbon\Carbon::parse($booking->returnDate)->format('d M Y') }})</p>
        </div>

        <div class="invoice-total">
            <div class="invoice-line">
                <span>Car Price x Days</span>
                <span>RM {{ number_format($booking->totalAmount - 20, 2) }}</span>
            </div>
            <div class="invoice-line">
                <span>Service Fee</span>
                <span>RM 20.00</span>
            </div>
            <hr>
            <div class="invoice-line total">
                <span>Total Paid</span>
                <span>RM {{ number_format($booking->totalAmount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="invoice-buttons">
        <a href="{{ route('index') }}">
            <button class="btn btn-back" style="background-color:grey ">Back to Home</button>
        </a>
        <button onclick="printInvoice()" class="btn btn-print" style="background-color: #22c55e;">🖨 Print Invoice</button>
    </div>
</div>

    <script>
        function printInvoice() {
            const printContents = document.getElementById('invoice').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>