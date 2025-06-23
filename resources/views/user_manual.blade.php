@extends('layouts.app')

@section('content')
@include('navbar')
<link rel="stylesheet" href="{{ asset('css/user_manual.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="manual-container">
    <h1 class="manual-title"><i class="fas fa-book"></i> User Manual - RentnGo</h1>

    <div class="manual-section">
        <h2>How to Register</h2>
        <ul>
            <li>Click the <strong>Login/Signup</strong> button at the top right of the page.</li>
            <li>Select your role as <strong>Customer</strong> to continue.</li>
            <li>Fill in your full name, email address, and password.</li>
            <li>Click <strong>Register</strong> to create your account.</li>
        </ul>
    </div>

    <div class="manual-section">
        <h2>How to Login</h2>
        <ul>
            <li>Click the <strong>Login/Signup</strong> button at the top right.</li>
            <li>Select your role as <strong>Customer</strong>.</li>
            <li>Enter your email address and password.</li>
            <li>Click <strong>Login</strong> to access your account.</li>
        </ul>
    </div>

    <div class="manual-section">
        <h2>How to Rent a Car</h2>
        <ul>
            <li>On the <strong>Home</strong> or <strong>Cars</strong> page, browse available cars or select your booking date.</li>
            <li>Click <strong>View Details</strong> to see more info about the car.</li>
            <li>Click <strong>Book Now</strong> and fill in your rental details.</li>
            <li>Click <strong>Submit</strong> to complete your booking.</li>
        </ul>
    </div>

    <div class="manual-section">
        <h2>View & Manage Bookings</h2>
        <ul>
            <li>Go to the <strong>Dashboard</strong> and click <strong>My Booking</strong>.</li>
            <li>You can view your upcoming and past bookings.</li>
            <li>You can also give or update your <strong>feedback</strong> after completing a booking.</li>
        </ul>
    </div>

    <div class="manual-section">
        <h2>Managing Your Profile</h2>
        <ul>
            <li>Click <strong>Profile</strong> in the top navigation menu.</li>
            <li>Here you can edit your personal details.</li>
            <li>You can also see your full booking history and upcoming bookings.</li>
        </ul>
    </div>

    <div class="manual-section">
        <h2>Need Help?</h2>
        <ul>
            <li>Visit the <strong>About Us</strong> page from the top menu.</li>
            <li>Scroll to the bottom to find the <strong>Contact Us</strong> section.</li>
            <li>You can call us directly or send an email to our support team.</li>
        </ul>
    </div>
</div>
@endsection
