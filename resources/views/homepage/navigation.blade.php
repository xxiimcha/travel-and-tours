

<body class="bg-gray-100 antialiased">
    <div class="flex min-h-screen scroll-smooth w-full flex-col">
            <nav class="min-h-[10vh] bg-white px-20 flex justify-between items-center sticky top-0 shadow-sm z-20 gap-10">
           <!-- Logo and ToggleNav Icon -->
<img class="w-24" src="{{ asset('img/jvdlogo.png') }}" alt="Logo">

<!-- Toggle Navigation (Hamburger Icon) -->
<a id="toggleNav" class="md:hidden cursor-pointer">
    <i class="fas fa-bars"></i>
</a>

<!-- Overlay (Will appear when navMenu is open) -->
<div id="overlay" class="fixed inset-0 bg-gray-200 opacity-50 hidden z-40"></div>

<!-- Navigation Menu (Hidden by default) -->
<div id="navMenu" class="absolute top-12 left-0 w-full bg-white rounded-lg shadow-lg hidden overflow-y-auto z-50 p-4">
    <div class="p-4 relative text-center uppercase">
        <!-- Close Button -->
        <button id="closeNav" class="absolute top-4 right-10 text-gray-600 hover:text-gray-900">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Dropdown Menu Items -->
       
            <a href="{{route('home')}}" class="block p-4 text-gray-700 hover:bg-gray-200">Home</a>
            <a href="{{ route('tour-package') }}"class="block p-4 text-gray-700 hover:bg-gray-200">Tour Package</a>
            <a href="{{route('rentals')}}" class="block p-4 text-gray-700 hover:bg-gray-200">Bus/van Rentals</a>
            <a href="{{route('hotel-reservation')}}" class="block p-4 text-gray-700 hover:bg-gray-200">Hotel</a>
            {{-- <a href="{{route('flights')}}"  class="block p-4 text-gray-700 hover:bg-gray-200">Flights</a> --}}
            <a href="{{route('login')}}" class="block p-4 text-gray-700 hover:bg-gray-200">Login</a>
            <a href="{{route('register')}}" class="block p-4 text-gray-700 hover:bg-gray-200">Register</a>
     
   
    </div>
</div>

<!-- Normal Navigation Menu (Visible on larger screens) -->
<ul class="flex flex-row gap-10 hidden md:flex">

    <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{route('home')}}">Home</a>
    </li>
     <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{ route('tour-package') }}">Tour Service</a>
    </li>
    <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{route('rentals')}}">Car Service</a>
    </li>
    <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{route('hotel-reservation')}}">Hotel Service</a>
    </li>
    {{-- <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a  href="{{route('flights')}}"  >Flight Service</a>
    </li> --}}
    @auth   
    <li class="relative" x-data="{ open: false }">
        <a href="#" id="userDropdown" class="text-primary inline-flex " role="button"
            @click="open = !open">
            {{ $details->firstname ?? Auth::user()->firstname }} {{ $details->lastname  ??  Auth::user()->lastname }}!</span>
            @if($details && $details->user_images)
            <img class=" rounded-full h-9 w-9 "  src="{{ asset('profile-pictures/' . $details->user_images) }}" alt="Profile Image" />
        @else    
        <img  src="{{ asset('img/undraw_profile.svg') }}" alt="User" class="h-9 w-9 rounded-full mr-2 items-center">
        @endif
        </a> 
        <!-- Dropdown - User Information -->
        <ul x-show="open" @click.away="open = false" x-transition
            class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none z-10"
            style="display: none;">
            <li>
                <a href="{{route('user-profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i> Profile
                </a>
            </li>
            <li>
                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-muted"></i> Settings
                </a>
            </li>
            <li>
                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-muted"></i> Order
                </a>
            </li>
            <li>
                <hr class="border-gray-200">
            </li>
            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-muted"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
    @else
    <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{route('login')}}" >Login</a>
    </li>
    <li class="hover:underline underline-offset-8 hover:text-blue-600 hover:decoration-2 hover:decoration-blue-600 hover:scale-110 transition">
        <a href="{{route('register')}}" >Register</a>
    </li>
    
        
    @endauth
       
     


           
</ul>
 </nav>