<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Arimo:ital,wght@0,400;0,700;1,400&family=Konkhmer+Sleokchher&family=Audiowide&display=swap" rel="stylesheet" />

<x-guest-layout>
    {{-- HEADER BAR --}}
    <div class="header-bar">
        <div>
            <link rel="stylesheet" href="{{ asset('css/admin_manage_cars.css') }}">
            <img src="{{ asset('images/rentngo_logo.png') }}" width="259" height="56" class="c_vector-vector"/>
        </div>
    </div>
    <div class="header-bar2"></div>

        <main class="forgot-main-container">
            <section class="register-card">
                <div class="register-card-content">
                    <div class="forgot-icon" style="margin-bottom: 1rem;">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="11" width="12" height="8" rx="3" fill="#FFBF1C" stroke="#FFBF1C" stroke-width="2" />
                            <path d="M9 11V8a3 3 0 1 1 6 0v3" stroke="#002244" stroke-width="2" fill="none" />
                            <circle cx="12" cy="15" r="1.1" fill="#002244" />
                        </svg>
                    </div>
                    <h2 class="register-title">Reset Password</h2>
                    <div class="register-subtitle" style="margin-bottom: 1rem;">
                        Please enter your new password below.
                    </div>

                    @if ($errors->any())
                        <div class="admin-login-error" style="color:#d32f2f; margin-bottom:1rem; text-align:center;">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form class="register-form" method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <input type="hidden" name="email" value="{{ old('email', $tokenData->user_type === 'admin' ? \App\Models\Admin::find($tokenData->user_id)?->email : \App\Models\Customer::find($tokenData->user_id)?->emailAddress) }}">


                        <!-- New Password -->
                        <label for="password">New Password</label>
                        <div class="reset-password-wrapper">
                            <input type="password" id="password" name="password" class="register-input" required />
                            <span class="reset-toggle-password" id="togglePassword" tabindex="0" aria-label="Toggle password visibility">
                                <svg width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <ellipse cx="12" cy="12" rx="7" ry="5" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                            </span>
                        </div>

                        <!-- Confirm Password -->
                        <label for="password_confirmation">Re-enter New Password</label>
                        <div class="reset-password-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="register-input" required />
                            <span class="reset-toggle-password" id="toggleRepassword" tabindex="0" aria-label="Toggle password visibility">
                                <svg width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <ellipse cx="12" cy="12" rx="7" ry="5" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                            </span>
                        </div>

                        <button type="submit" class="register-btn">Reset Password</button>
                    </form>
                </div>
            </section>
        </main>

    <script>
        function setupEyeToggle(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            const eyeSVG = `
            <svg width="22" height="22" fill="none" stroke="#888"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <ellipse cx="12" cy="12" rx="7" ry="5" />
                <circle cx="12" cy="12" r="2.5" />
            </svg>`;
            const eyeOffSVG = `
            <svg width="22" height="22" fill="none" stroke="#888"
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

        setupEyeToggle('password', 'togglePassword');
        setupEyeToggle('password_confirmation', 'toggleRepassword');
    </script>
</x-guest-layout>
