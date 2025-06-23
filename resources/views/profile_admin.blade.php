@extends('layouts.app')

@section('content')

@include('navbarAdmin')

<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    font-size: 18px;
  }

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
  }

  .header {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 40px;
  }

  .section-title {
    font-family: 'Konkhmer Sleokchher', cursive;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .info-section {
    flex: 1;
    min-width: 300px;
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
  }
</style>

<div class="container">
  {{-- Sidebar --}}
  <div class="sidebar">
    <div style="text-align: center;">
      @if ($admin->profilePhoto)
        <img class="avatar" src="{{ asset('storage/' . $admin->profilePhoto) }}" alt="Profile Photo">
      @else
        <p>No profile photo uploaded.</p>
      @endif
      <br><strong>{{ $admin->name }}</strong>
    </div>
    <br>
    <a href="{{ route('chat.index') }}" class="btn">Admin Chat Board</a>
    <a href="{{ route('cars.manage') }}" class="btn">Manage Car Availability</a>
    <a href="#" class="btn">Verify Bookings</a>
    <a href="{{ route('admin.edit') }}" class="btn">⚙️Edit Profile</a>
  </div>

  {{-- Main Content --}}
  <div class="main">
    <div class="header">
      <div class="info-section"> 
        <p class="section-title">👤 Account Information</p>
        <div class="info-box">📞Phone Number: {{ $admin->phoneNumber }}</div>
        <div class="info-box">✉️Email: {{ $admin->email }}</div>
        <div class="info-box">Admin ID: {{ $admin->id }}</div>
        <div class="info-box">Position Title: {{ $admin->position }}</div>
      </div>

      <div class="info-section">
        <p class="section-title">📅 Upcoming Tasks</p>
        <div class="info-box">No pending tasks</div>
      </div>
    </div>
  </div>
</div>

@endsection
