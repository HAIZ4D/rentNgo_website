@extends('layouts.app')

@section('content')
<!-- Add Google Fonts in your layout (once only) -->
<link href="https://fonts.googleapis.com/css2?family=Kodchasan&family=Audiowide&family=Konkhmer+Sleokchher&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f9f9f9;
        font-size: 16px;
    }

    .center-wrapper {
        display: flex;
        justify-content: center;
        padding: 40px;
    }

    .form-container {
        width: 100%;
        max-width: 1100px;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    section {
        border: 1px solid #ddd;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    h2 {
        font-size: 22px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="file"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid #bbb;
        font-size: 15px;
        font-family: 'Segoe UI', sans-serif;
    }

    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #999;
        display: block;
        margin-top: 10px;
    }

    .license {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 10px;
        border: 1px solid #999;
        margin-top: 10px;
    }

    .button-group {
        margin-top: 20px;
    }

    .savebtn,
    .backbtn {
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: 0.3s;
    }

    .savebtn {
        background-color: #4CAF50;
        color: white;
        border: none;
        margin-right: 10px;
    }

    .savebtn:hover {
        background-color: #45a049;
    }

    .backbtn {
        background-color: #ccc;
        color: #000;
    }

    .backbtn:hover {
        background-color: #bbb;
    }
</style>

<div class="center-wrapper">
    <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data" class="form-container">
        @csrf

        <!-- Account Info Section -->
        <section>
            <h2 style="font-weight: bold;">Account Information</h2>

            <label>Upload Profile Picture:</label>
            <input type="file" name="profilePhoto" accept="image/*">
            @if ($customer->profilePhoto)
                <img class="avatar" src="{{ asset('storage/' . $customer->profilePhoto) }}" alt="Profile Photo">
            @else
                <p>No profile photo uploaded.</p>
            @endif

            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" required>

            <label>Phone Number:</label>
            <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $customer->phoneNumber) }}" required>

            <label>Email:</label>
            <input type="email" name="emailAddress" value="{{ old('emailAddress', $customer->emailAddress) }}" required>
        </section>

        <!-- Driving License Section -->
        <section>
            <h2 style="font-weight: bold;">Driving License Information</h2>

            <label>Upload Driving License:</label>
            <input type="file" name="licenseImage" accept="image/*">
            @if (isset($driving_license) && $driving_license->licenseImage)
                <img class="license" src="{{ asset('storage/' . $driving_license->licenseImage) }}" alt="License Image">
            @else
                <p>No license photo uploaded.</p>
            @endif

            <label>Full Name:</label>
            <input type="text" name="fullName" value="{{ old('fullName', $driving_license->fullName ?? '') }}">

            <label>Date of Birth:</label>
            <input type="date" name="dateOfBirth" value="{{ old('dateOfBirth', $driving_license->dateOfBirth ?? '') }}">

            <label>License Number:</label>
            <input type="text" name="licenseNumber" value="{{ old('licenseNumber', $driving_license->licenseNumber ?? '') }}">

            <label>License Issue Date:</label>
            <input type="date" name="issueDate" value="{{ old('issueDate', $driving_license->issueDate ?? '') }}">

            <label>License Expiry Date:</label>
            <input type="date" name="expiryDate" value="{{ old('expiryDate', $driving_license->expiryDate ?? '') }}">

            <label>Country of Issue:</label>
            <input type="text" name="countryIssued" value="{{ old('countryIssued', $driving_license->countryIssued ?? '') }}">
        
            <label>License Class:</label>
            <input type="text" name="licenseClass" value="{{ old('licenseClass', $driving_license->licenseClass ?? '') }}">
          </section>

        <!-- Buttons -->
        <div class="button-group">
            <a href="{{ route('customer.profile') }}" class="backbtn">Back</a>
            <button type="submit" class="savebtn">Save Changes</button>
        </div>

        <!-- Feedback Messages -->
        @if(session('success'))
            <div style="color: green; margin-top: 20px;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div style="color: red; margin-top: 20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection
