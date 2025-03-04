<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar shadow sidebar-light accordion" id="accordionSidebar" style="background-color: white; color: black;">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="{{asset('logo/jvdlogo.png')}}" height="100" width="100" alt="jvd logo">
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin-dashboard')}}" style="color: black;">
                <i class="fas fa-fw fa-tachometer-alt" style="color: black;"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading" style="color: black;">
            Interface
        </div>

        <!-- Account Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#account" aria-expanded="true" aria-controls="collapseTwo" style="color: black;">
                <i class="bi bi-person" style="color: black;"></i>
                <span>Account Management</span>
            </a>
            <div id="account" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('manage-user-account')}}" style="color: black;">Manage User Account</a>
                    <a class="collapse-item" href="" style="color: black;">View User Details</a>
                </div>
            </div>
        </li>

        <!-- Tour Creation and Configuration -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tourCreation" aria-expanded="true" aria-controls="collapseUtilities" style="color: black;">
                <i class="bi bi-gear" style="color: black;"></i>
                <span>Tour Services</span>
            </a>
            <div id="tourCreation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('create-itinerary')}}" style="color: black;">Create Tour Itinerary</a>
                    <a class="collapse-item" href="{{route('create-tours')}}" style="color: black;">Create Tours</a>
                    <!-- Manage Tours with Nested Dropdown -->
                    <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#manageToursDropdown" aria-expanded="false" aria-controls="manageToursDropdown" style="color: black;">
                        Manage Tours
                        <i class="bi bi-chevron-down ml-2" style="color: black; font-weight:800;" id="manageToursIcon"></i>
                    </a>
                    <div id="manageToursDropdown" class="collapse" aria-labelledby="manageToursHeading" data-parent="#tourCreation">
                        <a class="collapse-item  text-black" href="{{route('manage-tour')}}">View Tours</a>
                        <a class="collapse-item  text-black" href="">View Itinerary</a>
                    </div>
                    <a class="collapse-item" href="#" style="color: black;">View Tour Purchase History</a>
                    <a class="collapse-item" href="#" style="color: black;">Customer Feedback</a>
                </div>
            </div>
        </li>
        
        
        <!-- Transport Booking -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transportBooking" aria-expanded="true" aria-controls="collapseUtilities" style="color: black;">
                <i class="bi bi-car-front" style="color: black;"></i>
                <span>Car Services</span>
            </a>
            <div id="transportBooking" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('create_booking')}}" style="color: black;">Create Car Service</a>
                    <a class="collapse-item" href="{{route('manage-booking')}}" style="color: black;">Manage Car Service</a>
                    <a class="collapse-item" href="" style="color: black;">Manage Booking Service</a>
                </div>
            </div>
        </li>

        <!-- Hotel Reservation -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hotelReservation" aria-expanded="true" aria-controls="collapseUtilities" style="color: black;">
                <i class="bi bi-building" style="color: black;"></i>
                <span>Hotel Services</span>
            </a>
            <div id="hotelReservation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('create-hotel')}}" style="color: black;">Create Hotel Service</a>
                    <a class="collapse-item" href="{{route('manage-hotel')}}" style="color: black;">Manage Hotel Service</a>
                    <a class="collapse-item" href="" style="color: black;">Manage Hotel Booking</a>
                    <a class="collapse-item" href="" style="color: black;">Customer Feedback</a>
                </div>
            </div>
        </li>

        <!-- Flights Services -->
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hotelFlights" aria-expanded="true" aria-controls="collapseUtilities" style="color: black;">
                <i class="bi bi-geo-alt" style="color: black;"></i>
                <span>Flight Services</span>
            </a>
            <div id="hotelFlights" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('create-flights-itinerary')}}" style="color: black;">Create Flights Itinerary</a>
                    <a class="collapse-item" href="{{route('create-flights')}}" style="color: black;">Create Flights Services</a>
                    <a class="collapse-item" href="{{route('manage-flights')}}" style="color: black;">Manage Flights Services</a>
                    <a class="collapse-item" href="" style="color: black;">Manage Flights Booking</a>
                    <a class="collapse-item" href="" style="color: black;">Customer Feedback</a>
                </div>
            </div>
        </li> --}}

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0 bg-primary " id="sidebarToggle"></button>
        </div>

    </ul>

