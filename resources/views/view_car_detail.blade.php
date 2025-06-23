@extends('layouts.app')

@section('content')
@include('navbar')
        <link rel="stylesheet" href="{{ asset('css/view_car_detail.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="full-car-card">
    <div class="car-details">
        <div class="car-image-container">
            <img src="{{ asset('storage/'.$car->carImage) }}" alt="{{ $car->carName }}" class="car-image">
        </div>
        <h1 class="car-title">{{ strtoupper($car->carName) }} {{ $car->carModel }}</h1>
        <ul class="car-specs">
            <li><i class="fas fa-user-friends"></i> {{ $car->carSeat }} seats</li>
            <li><i class="fas fa-road"></i> Unlimited mileage</li>
            <li><i class="fas fa-suitcase-rolling"></i> 3 Large Bags</li>
            <li><i class="fas fa-cogs"></i> {{ $car->transmissionType }}</li>
            <li><i class="fas fa-gas-pump"></i> {{ $car->fuelType }}</li>
            <li><i class="fas fa-star"></i> Customer Rating: 9.0/10</li>
        </ul>
    </div>

    <div class="car-pricing">
        <h2>Included in the price</h2>
        <ul class="included-list">
            <li>⚠️</span> Cancellation cannot be proceed after payment</li>
            <li>✅ Theft protection with RM 2,700 excess</li>
            <li>✅ Collision Damage Waiver with RM 2,700 excess</li>
        </ul>

        <div class="cost-info">
            <h3>Cost of rental</h3>
            <p class="price">RM{{ $car->pricePerDay }}</p>
        </div>

        <div class="good-choice">
            <h3 class="green-text">Good Choice!</h3>
            <ul>
                <li>Complete freedom with unlimited mileage</li>
                <li>Car model guaranteed</li>
                <li>Delivery Car Provided</li>
            </ul>
        </div>

        <div class="button-group">
            <a href="{{ route('booking.create.withCar', ['car' => $car->carID]) }}" class="btn-book">Book Now!</a>
            <a href="{{ route('index') }}" class="btn-back">Back to Listing</a>
        </div>
    </div>
</div>
@endsection
