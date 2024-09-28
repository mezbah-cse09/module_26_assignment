<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Car Rent <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">

        </div>

        {{-- Side nav item --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/carPage') }}">
                <i class="fas fa-fw fa-car"></i>
                <span>Car</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/customerPage') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Customer</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/rentalPage') }}">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Rental</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/rentalPage/create') }}">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>Create New Rent</span>
            </a>
        </li>





        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->

        <!-- Divider -->

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="{{ asset('img/car.svg') }}" alt="...">
            <p class="text-center mb-2"><strong>Car Rent</strong> is packed with premium features, components, and more!
            </p>
            {{-- <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a> --}}
        </div>

    </ul>
