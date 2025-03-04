@include('car.header-css')

@include('car.navigation')



@include('car.car-details')
<div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
    <div class="spin-loader flex flex-col items-center">
        <div class="circle">
            <!-- Plane icon inside the spinning circle -->
            <i class="fas fa-plane text-blue-500 text-3xl"></i>
        </div>
        <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
    </div>
</div>

{{-- 
@include('car.about')
@include('car.swiper') --}}
@include('car.services')
@include('car.footer')

