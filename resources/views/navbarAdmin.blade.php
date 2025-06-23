
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/rentngo_logo.png') }}" alt="RentnGo" height="40">
        </a>

        <!-- Toggler (burger) icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation items -->
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('chat.index') }}">Admin Chat Board</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars.manage') }}">Manage Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.bookings.manage') }}">Manage Booking</a>
                </li>

                @auth('customer')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <button class="nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @elseif(auth()->guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="nav-link" type="submit">Logout</button>
                        </form>
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
