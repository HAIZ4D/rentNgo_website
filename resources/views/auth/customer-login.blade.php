<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Arimo:ital,wght@0,400;0,700;1,400&family=Konkhmer+Sleokchher&family=Audiowide&display=swap"rel="stylesheet" />
<x-guest-layout>

    {{-- HEADER BAR --}}
    <div class="header-bar">
        <div>
            <link rel="stylesheet" href="{{ asset('css/admin_manage_cars.css') }}">
            <img src="{{ asset('images/rentngo_logo.png') }}" width="259" height="56" class="c_vector-vector"/>
        </div>
    </div>
    <div class="header-bar2"></div>

        <div class="admin-bg-container">
            <section class="customer-container">
                <h2 class="customer-login-form-title">Welcome back</h2>
                <p class="customer-login-form-desc">
                    Welcome back, valued <b>Customer!</b> Ready for your next ride?
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="customer-login-error" style="color:#d32f2f; margin-bottom:1rem; display:block;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="customer-login-form" method="POST" action="{{ route('customer.login.submit') }}">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email">E-mail address</label><br>
                        <input type="email" id="email" name="email" class="customer-login-form-input" value="{{ old('email') }}" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="customer-login-form-password-wrapper mt-4">
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" class="customer-login-form-input" required />
                        <span class="customer-login-form-eye" id="togglePassword" tabindex="0">
                            <svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <ellipse cx="12" cy="12" rx="7" ry="5" />
                                <circle cx="12" cy="12" r="2.5" />
                            </svg>
                        </span>
                    </div>

                    <!-- Remember Me + Forgot -->
                    <div class="customer-login-form-options mt-4">
                        <label class="customer-login-form-remember">
                            <input type="checkbox" name="remember" style="margin-right:0.4rem;" />
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="customer-login-form-forgot">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="customer-login-form-btn mt-4">Login</button>

                    <!-- Register Link -->
                    <div class="customer-login-form-register mt-4">
                        Don't have an account? <a href="{{ route('register.customer') }}">Register</a>
                    </div>
                </form>
            </section>
        </div>

    <!-- Password Toggle Script -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword?.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.innerHTML = type === 'password'
                ? '<svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="7" ry="5"/><circle cx="12" cy="12" r="2.5"/></svg>'
                : '<svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="7" ry="5"/><circle cx="12" cy="12" r="2.5"/><line x1="4" y1="4" x2="20" y2="20"/></svg>';
        });

        togglePassword?.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') togglePassword.click();
        });
    </script>
</x-guest-layout>
