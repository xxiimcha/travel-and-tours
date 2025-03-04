@include('homepage.header-css')

@include('homepage.navigation')

@include('homepage.hero')

@include('homepage.tour-package')


<!-----------      LOADER JAVASCRIPT     ---------->

<div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
    <div class="spin-loader flex flex-col items-center">
        <div class="circle">
            <!-- Plane icon inside the spinning circle -->
            <i class="fas fa-plane text-blue-500 text-3xl"></i>
        </div>
        <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/css/loader.css')}}" />
<script src="{{ asset('assets/js/loader.js') }}"></script>
@include('homepage.about')


@include('homepage.flights')

@include('homepage.swiper')
@include('homepage.services')
@include('homepage.contact')
@include('homepage.footer')