@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> 

@include('navbar')
{{-- clock Feature --}}
<div id="clock" class="clock-widget"></div>

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Rental Car Website No.1 In Malaysia</h1>
        <p class="text-muted">Convenient rentals in Selangor</p>
    </div>

    <!-- Date Filter -->
    <form method="GET" action="{{ route('index') }}" class="d-flex justify-content-center mb-5">
        <div class="date-bar shadow-sm">
    <div class="date-section">
        <label class="fw-bold">Start Date</label>
        <input type="text" id="startDate" name="start_date" placeholder="Start book here" value="{{ request('start_date') }}" readonly>
    </div>

    {{-- Availability Filter --}}
    <form method="GET" action="{{ route('index') }}"></form>

    <!-- Divider -->
    <div class="date-divider"></div>

    <div class="date-section">
        <label class="fw-bold">End Date</label>
        <input type="text" id="endDate" name="end_date" placeholder="End book here" value="{{ request('end_date') }}" readonly>
    </div>

    <button type="submit" class="search-icon">
        <i class="bi bi-search"></i>
    </button>
</div>
    </form>

    <!-- Car yang available -->
    <div class="row g-4">
        @forelse($cars as $car)
            <div class="col-md-4">
                <div class="card car-card shadow-sm">
                    <img src="{{ asset('storage/'.$car->carImage) }}" class="card-img-top" alt="{{ $car->carName }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->carName }} - {{ $car->carModel }}</h5>
                        <p class="card-text text-muted">
                            {{ $car->transmissionType }} | {{ $car->fuelType }}<br>
                            {{ $car->carSeat }} Seats | {{ $car->carMileage }} Km
                        </p>
                        <p class="card-text"><small>Available: {{ $car->availableFrom }} to {{ $car->availableTo }}</small></p>
                        <p class="fw-bold text-success">RM{{ $car->pricePerDay }} Per Day</p>
                        <a href="{{ route('cars.show', $car->carID) }}" class="btn-view">View Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-secondary">No cars available for the selected dates, Sorry :( </p>
        @endforelse
    </div>
    <div id="chat-toggle"
        style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; cursor: pointer;">
        <a href="{{ route('chat-customer') }}" class="floating-btn" title="Chat with Customer">
    <i class="bi bi-chat-dots"></i> 
</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script>
    flatpickr("#startDate", {
        altInput: true,
        altFormat: "d M",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    flatpickr("#endDate", {
        altInput: true,
        altFormat: "d M",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    // clock javascript
    // Flatpickr (already exists in your code)
    flatpickr("#startDate", {
        altInput: true,
        altFormat: "d M",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    flatpickr("#endDate", {
        altInput: true,
        altFormat: "d M",
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    // Live Clock Script
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-MY', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('clock').textContent = timeString;
    }

    // Update every second
    setInterval(updateClock, 1000);
    updateClock(); // initial call
</script>
@endsection
