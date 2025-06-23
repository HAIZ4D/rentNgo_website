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


    <main class="register-main-container">

        <section class="register-card">
            <div class="register-card-content">
                <div class="register-icon">
                    <span style="font-size:2.5rem; color:#222;">
                        &#128100;<span style="font-size:1.5rem;">&#9881;&#65039;</span>
                    </span>
                </div>
                <h2 class="register-title">Create an admin account.</h2>
                <div class="register-subtitle">
                    Already have an account?
                    <a href="{{ route('login') }}" class="register-signin-link">Sign in</a>
                </div>

                @if ($errors->any())
                    <div class="admin-login-error" style="color:#d32f2f; margin-bottom:1rem; text-align:center;">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="admin-login-success" style="color:#388e3c; margin-bottom:1rem; text-align:center;">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="register-form" method="POST" action="{{ route('register.admin') }}" autocomplete="off">
                    @csrf

                    <label for="fullname">Full Name</label>
                    <input
                        type="text"
                        id="fullname"
                        name="name"
                        class="register-input"
                        required
                        value="{{ old('name') }}" />

                    <label for="email">E-mail address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="register-input"
                        required
                        value="{{ old('email') }}" />


                    <label for="password">Password</label>
                    <div class="register-password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="register-input"
                            required />
                        <span class="register-eye" id="togglePassword" tabindex="0">
                            <svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 viewBox="0 0 24 24">
                                <ellipse cx="12" cy="12" rx="7" ry="5" />
                                <circle cx="12" cy="12" r="2.5" />
                            </svg>
                        </span>
                    </div>

                    <label for="repassword">Re-enter password</label>
                    <div class="register-password-wrapper">
                        <input
                            type="password"
                            id="repassword"
                            name="password_confirmation"
                            class="register-input"
                            required />
                        <span class="register-eye" id="toggleRePassword" tabindex="0">
                            <svg id="eyeIcon2" width="22" height="22" fill="none" stroke="#888"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 viewBox="0 0 24 24">
                                <ellipse cx="12" cy="12" rx="7" ry="5" />
                                <circle cx="12" cy="12" r="2.5" />
                            </svg>
                        </span>
                    </div>

                    <button type="submit" class="register-btn">Sign up</button>
                </form>
            </div>
        </section>

        <section class="register-marketing">
            <h1 class="register-marketing-title">
                Rent <span class="register-marketing-highlight">Quick.</span><br />
                Drive <span class="register-marketing-highlight">Happy.</span>
            </h1>
            <div class="register-marketing-features">
                <div class="register-feature">
                    <span class="register-feature-title">No Paperwork Hassles</span><br />
                    <span class="register-feature-desc">
                        Skip the long forms. Book your ride with just a few taps—fast, simple, and secure.
                    </span>
                </div>
                <div class="register-feature">
                    <span class="register-feature-title">Total Control, Your Way</span><br />
                    <span class="register-feature-desc">
                        Choose the car you want, when you want it. Flexible rentals with real-time availability.
                    </span>
                </div>
                <div class="register-feature">
                    <span class="register-feature-title">Drive with confidence</span><br />
                    <span class="register-feature-desc">
                        All cars are verified and insured. We've got your back every mile of the way.
                    </span>
                </div>
            </div>
        </section>

    </main>

@endsection

@push('scripts')
<script>
    function setupEyeToggle(inputId, toggleId, iconId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);
        const eyeSVG = `<svg id="${iconId}" width="22" height="22" fill="none" stroke="#888"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <ellipse cx="12" cy="12" rx="7" ry="5" />
              <circle cx="12" cy="12" r="2.5" />
            </svg>`;
        const eyeOffSVG = `<svg id="${iconId}" width="22" height="22" fill="none" stroke="#888"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <ellipse cx="12" cy="12" rx="7" ry="5" />
              <circle cx="12" cy="12" r="2.5" />
              <line x1="4" y1="4" x2="20" y2="20" />
            </svg>`;

        toggle.addEventListener('click', function() {
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            toggle.innerHTML = type === 'password' ? eyeSVG : eyeOffSVG;
        });

        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') toggle.click();
        });
    }

    setupEyeToggle('password', 'togglePassword', 'eyeIcon');
    setupEyeToggle('repassword', 'toggleRePassword', 'eyeIcon2');
</script>
@endpush
