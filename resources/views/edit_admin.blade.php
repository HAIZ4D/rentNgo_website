@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RentGo Profile</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Kodchasan&family=Audiowide&family=Konkhmer+Sleokchher&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      font-size: 16px;
      margin: 0;
      background-color: #f0f0f0;
    }

    .avatar {
      margin-top: 10px;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 1px solid #000;
    }

    .center-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px;
    }

    .container {
      width: 100%;
      max-width: 960px;
      background-color: #fff;
      padding: 50px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 20px;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"] {
      width: 100%;
      height: 44px;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #bbb;
      font-size: 15px;
      font-family: 'Segoe UI', sans-serif;
      box-sizing: border-box;
    }

    .savebtn {
      background-color: #4CAF50;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: background-color 0.3s ease, transform 0.4s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }

    .savebtn:hover {
      background-color: #45a049;
    }

    .savebtn:active {
      transform: scale(0.97);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .backbtn {
      display: inline-block;
      background-color: #ccc;
      color: #000;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 16px;
      margin-right: 10px;
      margin-top: 30px;
      transition: background-color 0.3s ease;
    }

    .backbtn:hover {
      background-color: #bbb;
    }

    .backbtn:active {
      transform: scale(0.97);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .feedback {
      margin-top: 20px;
    }

    .feedback ul {
      padding-left: 20px;
    }

    .feedback li {
      color: red;
    }

    .feedback .success {
      color: green;
    }
  </style>
</head>
<body>

  <div class="center-wrapper">
    <div class="container">
      <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Upload Profile Picture:</label>
        <input type="file" name="profilePhoto" id="profilePhoto" accept="image/*">
        <br>
        @if ($admin->profilePhoto)
          <img class="avatar" src="{{ asset('storage/' . $admin->profilePhoto) }}" alt="Profile Photo">
        @else
          <p>No profile photo uploaded.</p>
        @endif

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $admin->name) }}" required>

        <label>Phone Number: (01xxxxxxx)</label>
        <input type="text" name="phoneNumber" value="{{ old('phoneNumber', $admin->phoneNumber) }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>

        <label>Position Title:</label>
        <input type="text" name="position" value="{{ old('position', $admin->position) }}" required>
        <br>
        <a href="{{ route('admin.profile') }}" class="backbtn">Back</a>
        <button class="savebtn" type="submit">Save Changes</button>

        @if(session('success'))
          <div class="feedback success">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="feedback">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </form>
    </div>
  </div>

</body>
</html>
@endsection
