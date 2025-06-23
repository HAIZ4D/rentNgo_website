@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/booking-detail.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 
@include('navbar')
<!-- Header -->
    <div class="booking-grid">
    <!-- Left Info -->
    <div class="center-cell">
        <p class="pickup-text">{{ $booking->pickupLocation }}</p>
        <p class="date-text">{{ $booking->pickupDate }}</p>
    </div>

    <!-- Car Image -->
    <div class="center-cell">
        <img src="{{ asset('images/car.jpg') }}" alt="Car Icon" class="car-img" />
    </div>

    <!-- Right Info -->
    <div class="center-cell">
        <p class="pickup-text">{{ $booking->dropOffLocation }}</p>
        <p class="date-text">{{ $booking->returnDate }}</p>
    </div>

    <!-- Edit link -->
    <div class="center-cell">
        <a href="{{ route('booking.edit', $booking) }}" class="note-edit-button">Edit</a>
    </div>
</div>

   <div class="booking-detail-section">
    <h1 class="booking-title">Your Booking Detail</h1>
    <p class="booking-subtitle">Please Check Information</p>

    <div class="booking-progress-container">
        <div id="first-progress" class="step step-active">
            <div class="step-line-active"></div>
        </div>
        <div id="second-progress" class="step step-active">
            <img src="{{ asset('images/car.jpg') }}" alt="Car icon" class="step-icon">
            <div class="step-line-active"></div>
        </div>
        <div id="third-progress" class="step"><div class="step-line-inactive"></div></div>
    </div>
</div>
        <!-- Payment Options Grid -->
    <div class="payment-grid">
    <div class="payment-option" data-method="cash">
        <img src="{{ asset('images/cash-image.png') }}" alt="Cash" style="height: 120px; width:150px;" />
        <p>Pay on pickup day</p>
    </div>

    <div class="payment-option" data-method="bank">
        <img src="{{ asset('images/bank-icon.png') }}" alt="Online Banking" style="height: 100px;" />
        <p>Online Banking</p>
    </div>

    <div class="payment-option" data-method="card">
        <img src="{{ asset('images/card-icon.png') }}" alt="Card Payment" style="height: 100px;" />
        <p>Card Payment</p>
    </div>
</div>
 
    <div class="payment-container" style="margin-top: 50px ">
    <!-- Cash Payment Form -->
    <div id="form-cash" class="payment-form hidden">
        <form method="POST" action="{{ route('payment.store') }}">
            @csrf
            <input type="hidden" name="bookingID" value="{{ $booking->bookingID }}">
            <input type="hidden" name="methodPayment" value="Cash">
            <input type="hidden" name="paymentDate" value="{{ now()->toDateString() }}">
            <input type="hidden" name="paymentStatus" value="Pending">
            <input type="hidden" name="amount" value="{{ $booking->totalAmount }}">

            <h2>Cash On Pick-up Day</h2>
            <label>Full name</label>
            <input type="text" name="name" value="{{auth()->user()->name}}" required>

            <div class="radio-group">
                <label><input type="radio" name="method" checked disabled> Cash</label>
            </div>

            <div class="notice">
                <p>✔ You are advised to bring enough money.</p>
                <p>✔ Please reach the pickup place at the specified time to avoid any delay.</p>
            </div>

            <button type="submit">Confirm Cash Payment</button>
        </form>
    </div>

    <!-- Online Banking -->
    <div id="form-bank" class="payment-form hidden">
        <form method="POST" action="{{ route('payment.store') }}">
            @csrf
            <input type="hidden" name="name" value="{{auth()->user()->name}}">
            <input type="hidden" name="bookingID" value="{{ $booking->bookingID }}">
            <input type="hidden" name="methodPayment" value="Bank">
            <input type="hidden" name="paymentDate" value="{{ now()->toDateString() }}">
            <input type="hidden" name="paymentStatus" value="Completed">
            <input type="hidden" name="amount" value="{{ $booking->totalAmount }}">

            <h2>Online Banking Details</h2>
            <label>Bank Name</label>
            <input type="text" name="bankName" placeholder="Bank Name (e.g., Maybank)" required>

            <label>Account Number</label>
            <input type="text" name="accountNumber" placeholder="XXXXXX" required>

            <button type="submit">Confirm Online Banking Payment</button>
        </form>
    </div>

    <!-- Card Payment -->
    <div id="form-card" class="payment-form hidden">
        <form method="POST" action="{{ route('payment.store') }}">
            @csrf
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="bookingID" value="{{ $booking->bookingID }}">
            <input type="hidden" name="methodPayment" value="Card">
            <input type="hidden" name="paymentDate" value="{{ now()->toDateString() }}">
            <input type="hidden" name="paymentStatus" value="Completed">
            <input type="hidden" name="amount" value="{{ $booking->totalAmount }}">

            <h2>Card Payment</h2>
            <label>Card Number</label>
            <input type="text" name="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" required>

            <div class="grid-2">
                <div>
                    <label>Expiry Date</label>
                    <input type="text" name="expiryDate" placeholder="MM/YY" required>
                </div>
                <div>
                    <label>Security Code</label>
                    <input type="text" name="securityCode" placeholder="123" required>
                </div>
            </div>

            <label>Card Holder Name</label>
            <input type="text" name="cardHolderName" placeholder="Full Name">

            <button type="submit">Confirm Card Payment</button>
        </form>
    </div>

    <!-- Price Breakdown -->
    <div class="price-box">
        <h2>Car Price Breakdown</h2>
        <div class="line">
            <p>RM {{ $booking->car->pricePerDay }} x ({{ \Carbon\Carbon::parse($booking->pickupDate)->format('d-m') }} to {{ \Carbon\Carbon::parse($booking->returnDate)->format('d-m') }})</p>
            <p>RM {{ number_format($booking->totalAmount - 20, 2) }}</p>
        </div>
        <div class="line">
            <p>Service Fee</p>
            <p>RM 20.00</p>
        </div>
        <hr>
        <div class="line total">
            <p>Total payment</p>
            <p>RM {{ $booking->totalAmount }}</p>
        </div>
    </div>
</div>

<script>
    //payment method 
    document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('.payment-option');
    const forms = document.querySelectorAll('.payment-form');

    if (!options.length || !forms.length) return;

    options.forEach(option => {
        option.addEventListener('click', () => {
            const selectedMethod = option.getAttribute('data-method');

            // Remove highlights
            options.forEach(o => o.classList.remove('active'));

            // Highlight selected
            option.classList.add('active');

            // Hide all forms
            forms.forEach(form => form.classList.add('hidden'));

            // Show selected form
            const formToShow = document.getElementById(`form-${selectedMethod}`);
            if (formToShow) {
                formToShow.classList.remove('hidden');
            }

            // Set hidden input value
            const methodInput = document.getElementById('selected-payment-method');
            if (methodInput) {
                methodInput.value = selectedMethod;
            }
        });
    });
});
</script>
@endsection