@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Arimo:ital,wght@0,400;0,700;1,400&family=Konkhmer+Sleokchher&family=Audiowide&display=swap"rel="stylesheet" />

@section('content')
{{-- HEADER BAR --}}
    <div class="header-bar">
        <div>
            <link rel="stylesheet" href="{{ asset('css/admin_manage_cars.css') }}">
            <img src="{{ asset('images/rentngo_logo.png') }}" width="259" height="56" class="c_vector-vector"/>
        </div>
    </div>
    <div class="header-bar2"></div>
    
<div class="verify-main-container">
    <section class="register-card">
        <div class="register-card-content">
            <div class="register-icon">
                <span style="font-size:2.5rem; color:#222;">
                    &#128100;<span style="font-size:1.5rem;">&#9881;&#65039;</span>
                </span>
            </div>
            <h2 class="register-title">Admin Registration Code</h2>
            <div class="register-subtitle">
                Please enter the admin registration code to complete your registration.
            </div>

            @if ($errors->any())
                <div class="admin-login-error" style="color:#d32f2f; margin-bottom:1rem; text-align:center;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (!empty($success))
                <div class="admin-login-success" style="color:#388e3c; margin-bottom:1rem; text-align:center;">
                    {!! $success !!}
                </div>
            @endif

            @if (empty($success))
            <form class="register-form" method="POST" action="{{ route('verify.admin.code.submit') }}">
                @csrf
                <label for="admin_code">Admin Registration Code</label>
                <input
                    type="text"
                    id="admin_code"
                    name="admin_code"
                    class="register-input"
                    required />
                <button type="submit" class="register-btn">
                    Verify & Complete Registration
                </button>
            </form>
            @endif
        </div>
    </section>
</div>
@endsection
