






@include('flights.header-css')
@include('flights.navigation')
@include('flights.flight-details')

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

{{-- @include('flights.about')
@include('flights.swiper') --}}
@include('flights.services')
@include('flights.footer')

