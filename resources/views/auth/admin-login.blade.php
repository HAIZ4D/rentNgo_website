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
            <section class="admin-container">
                <h2 class="admin-login-form-title">Welcome back</h2>
                <p class="admin-login-form-desc">
                    Back in control. Let's get to work, <b>Admin</b>.
                </p>

                <!-- Laravel handles POST via route('login') -->
                <form method="POST" action="{{ route('admin.login.submit') }}" class="admin-login-form" autocomplete="off">
                    @csrf

                    <div>
                        <label for="admin-id">Admin ID</label><br />
                        <input type="text" id="admin-id" name="admin-id" class="admin-login-form-input" value="{{ old('admin-id') }}" />
                    </div>

                    @if ($errors->any())
                        <div class="admin-login-error" style="color:#d32f2f; margin-bottom:1rem; display:block;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div>
                        <label for="email">Email address</label><br />
                        <input type="email" id="email" name="email" class="admin-login-form-input"
                            value="{{ old('email') }}" required autofocus />
                    </div>

                    <div class="admin-login-form-password-wrapper">
                        <label for="password">Password</label><br />
                        <input type="password" id="password" name="password" class="admin-login-form-input" required />
                        <span class="admin-login-form-eye" id="togglePassword" tabindex="0">
                            <svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <ellipse cx="12" cy="12" rx="7" ry="5" />
                                <circle cx="12" cy="12" r="2.5" />
                            </svg>
                        </span>
                    </div>

                    <div class="admin-login-form-options">
                        <label class="admin-login-form-remember">
                            <input type="checkbox" name="remember" style="margin-right:0.4rem;" />
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" class="admin-login-form-forgot">Forgot password?</a>
                    </div>

                    <button type="submit" class="admin-login-form-btn">Login</button>

                    <div class="admin-login-form-register">
                        Don't have an account? <a href="{{ route('register.admin') }}">Register</a>
                    </div>
                </form>
            </section>
        </div>


    <!-- Password Toggle -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.innerHTML =
                type === 'password'
                    ? '<svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="7" ry="5"/><circle cx="12" cy="12" r="2.5"/></svg>'
                    : '<svg id="eyeIcon" width="22" height="22" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="7" ry="5"/><circle cx="12" cy="12" r="2.5"/><line x1="4" y1="4" x2="20" y2="20"/></svg>';
        });
    </script>
</x-guest-layout>
