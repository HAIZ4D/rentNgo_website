@extends('layouts.app') {{-- or use layout you have --}}

@section('content')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Arimo:ital,wght@0,400;0,700;1,400&family=Konkhmer+Sleokchher&family=Audiowide&display=swap"rel="stylesheet" />
@include('navbarLogin')

    <div class="header-bar2"></div>

        <main class="container">
            <section class="hero-section">
                <div class="hero-text">
                    <div class="hero-title-container">
                        <h1 class="hero-title">
                            Premium Car Rental<br />
                            in <span class="highlight">Selangor.</span>
                        </h1>
                        <div class="hero-subtitle-wrapper">
                            <p class="hero-subtitle">─── Premium rentals, Selangor-style.</p>
                        </div>
                    </div>
                    <img class="hero-image" src="{{ asset('images/choose_role_background.png') }}" alt="Car with Giraffe" />
                </div>
            </section>

            <section class="role-selection">
                <h2>Select your role</h2>
                <p>Please identify yourself to continue.</p>

                <div class="role-options">
                    <div class="role-card" onclick="selectRole('admin')">
                        <i class="bx bx-user-circle" style="font-size: 54px; color: #FFBF1C;"></i>
                        <span>Admin</span>
                    </div>
                    <div class="role-card" onclick="selectRole('customer')">
                        <i class="bx bx-user" style="font-size: 54px; color: #FFBF1C;"></i>
                        <span>Customer</span>
                    </div>
                </div>

                <button class="continue-btn" onclick="continueToLogin()">Continue</button>
            </section>
        </main>

    <script>
        let selectedRole = null;

        function selectRole(role) {
            selectedRole = role;
            document.querySelectorAll('.role-card').forEach(card => {
                card.style.background = 'rgba(255, 191, 28, 0.06)';
            });
            event.currentTarget.style.background = 'rgba(255, 191, 28, 0.2)';
        }

        function continueToLogin() {
            if (!selectedRole) {
                alert('Please select a role to continue');
                return;
            }

            // Redirect using Laravel route:
            if (selectedRole === 'admin') {
                window.location.href = "{{ route('admin.login') }}";
            } else if (selectedRole === 'customer') {
                window.location.href = "{{ route('customer.login') }}";
            }
        }
    </script>
