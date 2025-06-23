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
    
        <main class="forgot-main-container">
            <section class="forgot-card">
                <div class="forgot-icon">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                        <rect x="6" y="11" width="12" height="8" rx="3" fill="#FFBF1C" stroke="#FFBF1C" stroke-width="2" />
                        <path d="M9 11V8a3 3 0 1 1 6 0v3" stroke="#002244" stroke-width="2" fill="none" />
                        <circle cx="12" cy="15" r="1.1" fill="#002244" />
                    </svg>
                </div>
                <h2 class="forgot-title">Forgot Password</h2>
                <p class="forgot-desc">Don't worry. We'll send you reset instructions.</p>

                @if (session('status'))
                    <div class="admin-login-success" style="color:#388e3c; text-align:center; margin-bottom:1rem;">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('link'))
                    <div class="mt-4 text-green-600">
                        <strong>Email is registered!</strong><br>
                            <a href="{{ session('link') }}" class="text-blue-500 underline">
                                Click here to reset password
                            </a>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="admin-login-error" style="color:#d32f2f; text-align:center; margin-bottom:1rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" class="forgot-form" action="{{ route('custom.password.email') }}">
                    @csrf
                    <label for="email">E-mail address</label>
                    <input type="email" name="email" id="email" class="forgot-input" required />
                    <button type="submit" class="forgot-btn">Send an e-mail</button>
                    <button type="button" class="forgot-back-btn" onclick="history.back()">Back</button>
                </form>
            </section>
        </main>
</x-guest-layout>
