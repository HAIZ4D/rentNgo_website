@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/booking-detail.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 
@include('navbar')

@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Booking Form Section -->
@if(!isset($booking))
<!-- Booking Form Section -->
<form action="{{ route('booking.store', $car->carID) }}" method="POST">
    @csrf
    <div class="header-container">
        <!-- Left Info -->
        <div class="info-left">
            <label for="pickupLocation">Pickup Location</label>
            <input list="locationOptions" type="text" id="pickupLocation" name="pickupLocation" value="{{ old('pickupLocation') }}" placeholder="Pickup location" class="location-input" required>

            <datalist id="locationOptions">
                <option value="Kuala Lumpur">
                <option value="Putrajaya">
                <option value="Petaling Jaya">
                <option value="Serdang">
                <option value="Sepang">
                <option value="Kajang">
                <option value="Shah Alam">
                <option value="Subang Jaya">
                <option value="Cyberjaya">
                <option value="Puchong">
            </datalist>
            <label for="pickupDate">Pickup Date</label>
            <input type="date" id="pickupDate" name="pickupDate" value="{{ old('pickupDate') }}" placeholder="Pickup Date" class="date-input" required>
        </div>

        <!-- Car Image -->
        <div class="car-image">
            <img src="{{ asset('images/car.jpg') }}" alt="Car Icon" class="car-icon" />
        </div>

        <!-- Right Info -->
        <div class="info-right">
            <label for="dropOffLocation">Drop-off Location</label>
            <input list="locationOptions" type="text" id="dropOffLocation" name="dropOffLocation" value="{{ old('dropOffLocation') }}" placeholder="Drop-off Location" class="location-input" required>
            <datalist id="locationOptions">
                <option value="Kuala Lumpur">
                <option value="Putrajaya">
                <option value="Petaling Jaya">
                <option value="Serdang">
                <option value="Sepang">
                <option value="Kajang">
                <option value="Shah Alam">
                <option value="Subang Jaya">
                <option value="Cyberjaya">
                <option value="Puchong">
            </datalist>
            <label for="returnDate">Return Date</label>
            <input type="date" id="returnDate" name="returnDate" value="{{ old('returnDate') }}" placeholder="Return Date" class="date-input" required>
        </div>

        <!-- Hidden Booking Fields -->
        <input type="hidden" name="date" value="{{ now() }}">
        <input type="hidden" name="status" value="Pending">
        <input type="hidden" name="bookingStatus" value="Pending">
        <input type="hidden" name="totalAmount" value="0">
        <input type="hidden" name="isLateReturn" value="0">
        <input type="hidden" name="lateFee" value="0">
        <input type="hidden" name="adminID" value="{{ $car->adminID }}">
        <input type="hidden" name="carID" value="{{ $car->carID }}">

        <!-- Submit Button -->
        <div class="submit-btn">
            <button type="submit" style="margin: 0 auto">Submit Booking</button>
        </div>
    </div>
</form>
@endif

<!-- Booking Detail Section -->
@if(isset($booking))
<div class="booking-detail-section">
    <h1 class="booking-title">Your Booking Detail</h1>
    <p class="booking-subtitle">Please Check Information</p>

    <div class="booking-progress-container">
        <div class="step step-active">
            <img src="{{ asset('images/car.jpg') }}" alt="Car icon" class="step-icon">
            <div class="step-line-active"></div>
        </div>
        <div class="step"><div class="step-line-inactive"></div></div>
        <div class="step"><div class="step-line-inactive"></div></div>
    </div>
</div>

<div class="free-cancel-notice">
    <span class="check-icon">⚠️</span> Cancellation cannot be proceed after payment
</div>

<div class="booking-main-grid">
    <!-- Car Image -->
    <div class="car-image-wrapper">
        <img src="{{ asset('storage/' . $car->carImage) }}" alt="Car Image" class="car-image" style="width:500px; margin:auto;">
    </div>

    <!-- Booking Info -->
    <div class="booking-info">
        <h2 class="section-title" style="margin-bottom: 40px">Booking time</h2>
        <p>{{ \Carbon\Carbon::parse($booking->pickupDate)->format('l, d-m-Y') }}<br>11:30 AM</p>
        <img src="{{ asset('images/line.png') }}" alt="line" class="line-icon">
        <p class="mt-2">{{ \Carbon\Carbon::parse($booking->returnDate)->format('l, d-m-Y') }}<br>11:30 AM</p>
    </div>

    <!-- Car Title + Features -->
    <div class="car-title-section">
        <img src="{{ asset('storage/' . $car->brandLogo) }}" alt="Brand Logo" class="brand-logo">
        <div>
            <h2 class="car-name">{{ $booking->car->carName }}</h2>
            <p class="car-rating">⭐ 4.8 rating (32 trips)</p>
            <div class="car-features">
                <div>🚗 {{ $booking->car->carSeat }} Seats</div>
                <div>⚙️ {{ $booking->car->transmissionType }}</div>
                <div>⛽ {{ $booking->car->fuelType }}</div>
                <div>Mileage: {{ $booking->car->carMileage }} KM</div>
            </div>
        </div>
    </div>

    <!-- Price Info -->
    <div class="price-info">
        <h2 class="section-title">Car Price Breakdown</h2>
        <div class="price-row">
            <p>RM {{ $booking->car->pricePerDay }} x ({{ \Carbon\Carbon::parse($booking->pickupDate)->format('d-m') }} to {{ \Carbon\Carbon::parse($booking->returnDate)->format('d-m') }})</p>
            <p>RM {{ number_format($booking->totalAmount - 20, 2) }}</p>
        </div>
        <div class="price-row">
            <p>Service Fee</p>
            <p>RM 20.00</p>
        </div>
        <hr class="price-divider">
        <div class="price-total">
            <p>Total payment</p>
            <p>RM {{ $booking->totalAmount }}</p>
        </div>
    </div>

    <!-- Car Description -->
    <div class="car-description">
        <h3 class="section-title">Car Description</h3>
        <p class="description-text">{{ $booking->car->carDesc }}</p>
    </div>

    <!-- Vehicle Features -->
    <div class="vehicle-feature">
        <h3 class="section-title">Vehicle Features</h3>
        <ul class="feature-list">
            <li>Safety</li>
            <li>Airbags, Dual Front</li>
            <li>ABS + Electronic Brake control</li>
            <li>Infotainment</li>
            <li>Apple CarPlay + Android Auto</li>
            <li>Reverse Camera</li>
            <li>Fuel Tank Full at First Pickup</li>
        </ul>
    </div>
    <!-- Delete Booking Button -->
<div class="action-buttons-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 500px; margin: 30px auto; grid-column:span 2">
    
    <form action="{{ route('booking.destroy', $booking->bookingID) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" style="justify-self: start;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" style="padding: 12px 20px; font-weight: 600; border: none;">
            <i class="bi bi-trash"></i> Cancel Booking
        </button>
    </form>

    <!-- Proceed to Payment Button -->
    <a href="{{ route('payment.index', ['booking' => $booking->bookingID]) }}"
       class="btn btn-success"
       style="padding: 12px 20px; font-weight: 600; text-align: center; text-decoration: none; border: none; justify-self: end;">
        <i class="bi bi-credit-card"></i> Proceed to Payment
    </a>
</div>
@endif

@endsection
