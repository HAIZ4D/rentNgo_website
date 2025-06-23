@extends('layouts.app')
@section('content')
@include('navbar')

<style>
  /* body {
    font-family: 'Kodchasan', sans-serif;
    font-size: 19px;
  } */

  .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    margin: 0;
    padding: 0;
  }

  .sidebar {
    width: 350px;
    background: #fff;
    padding: 30px;
    border-right: 1px solid #ccc;
  }

  .main {
    flex: 1;
    padding: 30px;
    background-color: #fff;
    margin: 30px;
    border-radius: 20px;
  }

  .avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #000;
    margin-bottom: 10px;
  }

  .btn {
    display: block;
    font-family: 'Segoe UI', sans-serif;
    font-size: 16px;
    width: 100%;
    padding: 12px 18px;
    margin: 10px 0;
    background: rgba(217, 217, 217, 0.3);
    border: 1px solid #aaa;
    border-radius: 25px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    color: #000;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #d9d9d9;
    transform: translateY(-3px);
  }

  .info-box {
    background: #f5f5f5;
    padding: 14px 20px;
    border-radius: 25px;
    margin-bottom: 15px;
    width: 100%;
    font-size: 18px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }

  .info-box strong {
    min-width: 160px;
    font-weight: 600;
    color: #333;
  }

  .header {
    display: flex;
    flex-direction: column;
    gap: 40px;
  }

  .section-title {
    font-family: 'Segoe UI', sans-serif;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 15px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
  }

  .info-section {
    flex: 1;
    min-width: 300px;
  }

  .license-card {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-start;
    margin-top: 10px;
  }

  .license-image {
    width: 100%;
    max-width: 250px;
    border: 1px solid #aaa;
    border-radius: 12px;
    object-fit: contain;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
    }

    .sidebar {
      width: 100%;
      border-right: none;
      border-bottom: 1px solid #ccc;
    }

    .main {
      margin: 10px;
    }

    .license-card {
      flex-direction: column;
      align-items: center;
    }

    .info-box strong {
      width: 100%;
      margin-bottom: 5px;
    }
  }
</style>

<div class="container">
  {{-- Sidebar --}}
  <div class="sidebar">
    <div style="text-align: center;">
      @if ($customer->profilePhoto)
        <img class="avatar" src="{{ asset('storage/' . $customer->profilePhoto) }}" alt="Profile Photo">
      @else
        <p>No profile photo uploaded.</p>
      @endif
      <br><strong>{{ $customer->name }}</strong>
    </div>
    <br>
    <strong>
          <a href="{{ route('booking.history') }}" class="btn">View My Booking</a>
    <a href="{{ route('customer.edit') }}" class="btn">⚙️ Edit Profile</a>
    </strong>
  </div>

  {{-- Main Content --}}
  <div class="main">
    <div class="header">
      {{-- Account Info --}}
      <div class="info-section">
        <p class="section-title">👤 Account Information</p>
        <div class="info-box">📞 Phone Number: {{ $customer->phoneNumber }}</div>
        <div class="info-box">✉️ Email: {{ $customer->emailAddress }}</div>
        <div class="info-box">Customer ID:{{ $customer->customerID }}</div>
      </div>

      {{-- License Info --}}
      <div class="info-section">
        <p class="section-title">🪪 Driving Licence</p>
        <div class="license-card">
          @if (!empty($driving_license?->licenseImage))
            <img src="{{ asset('storage/' . $driving_license->licenseImage) }}" alt="Driving Licence" class="license-image">
          @else
            <div class="license-image" style="display:flex; justify-content:center; align-items:center;">No driving licence image uploaded.</div>
          @endif

          <div style="flex: 1;">
            <div class="info-box">Licence Number: {{ $driving_license->licenseNumber ?? 'Not Provided' }}</div>
            <div class="info-box">📅 Expiry Date: {{ $driving_license->expiryDate ?? 'Not Provided' }}</div>
            <div class="info-box">Licence Class: {{ $driving_license->licenseClass ?? 'Not Provided' }}</div>
            <div class="info-box">Country Issued: {{ $driving_license->countryIssued ?? 'Not Provided' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
