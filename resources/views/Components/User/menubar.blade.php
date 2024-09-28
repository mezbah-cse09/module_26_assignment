<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Car<span>Rent</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ url('/service') }}" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="{{ url('/car') }}" class="nav-link">Cars</a></li>
                <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                @if (Cookie::get('token') !== null)
                    <li class="nav-item"><a href="{{ url('/my-booking') }}"
                            class="nav-link > <i class="linearicons-user"></i> My Bookings</a></li>
                    <li class="nav-item"><a class="btn btn-danger btn-sm nav-link" href="{{ url('/logout') }}">
                            Logout</a></li>
                @else
                    <li class="nav-item"><a class="btn btn-secondary nav-link btn-sm"
                            href="{{ url('/login') }}">Login</a></li>
                @endif

                {{-- <li class="nav-item"><a class="btn btn-secondary nav-link btn-sm" href="{{url("/login")}}">{{Cookie::get('laravel_session')}}</a></li> --}}
                {{-- <li class="nav-item"><a class="btn btn-secondary nav-link btn-sm" href="{{url("/login")}}">{{App\Http\Controllers\Controller::isAdmin()}}</a></li> --}}

            </ul>
        </div>
    </div>
</nav>
