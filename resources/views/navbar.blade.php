
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{ asset('images/rentngo_logo.png') }}" alt="RentnGo" height="40">
        </a>

        <!-- Toggler (burger) icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.manual') }}">User Manual</a>
                </li>

                @auth('customer')
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('booking.history') }}">My Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <button class="nav-link" type="submit">Logout</button>
                        </form>
                        {{-- btn btn-link --}}
                    </li>
                @elseif(auth()->guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="nav-link btn btn-link" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login/Signup</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="yellow-bar"></div>
