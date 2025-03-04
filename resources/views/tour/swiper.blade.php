<div class="max-w-7xl mx-auto mt-10">
    <div class="text-center">
        <h2 class="text-base text-gray-700 font-semibold tracking-wide uppercase">Our Partners</h2>
    </div>

    <!-- Swiper Slider -->
    <div class="mt-10 swiper-container flex justify-center bg-white py-4 w-full">
        <div class="swiper-wrapper">
            <!-- Partner 1 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner1.png')}}" alt="Partner 1 Logo">
                <p class="text-gray-600 text-sm font-semibold">2GO Travel</p>
            </div>
            <!-- Partner 2 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner2.png')}}" alt="Partner 2 Logo">
                <p class="text-gray-600 text-sm font-semibold">Air Asia</p>
            </div>
            <!-- Partner 3 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner3.png')}}" alt="Partner 3 Logo">
                <p class="text-gray-600 text-sm font-semibold">Cebu Pacific</p>
            </div>
            <!-- Partner 4 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner4.png')}}" alt="Partner 4 Logo">
                <p class="text-gray-600 text-sm font-semibold">Cathay Pacific</p>
            </div>
            <!-- Partner 5 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner5.png')}}" alt="Partner 5 Logo">
                <p class="text-gray-600 text-sm font-semibold">Etihad Airways</p>
            </div>
            <!-- Partner 6 -->
            <div class="swiper-slide">
                <img class="h-12" src="{{ asset('img/partner6.png')}}" alt="Partner 6 Logo">
                <p class="text-gray-600 text-sm font-semibold">Philippine Airline</p>
            </div>
        </div>

    </div>
</div>
             <!-- SWIPER JS -->
              <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
              
              
              <script>
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 6, // Display 4 logos at a time
                    spaceBetween: 30, // Space between logos
                    loop: true, // Loop the slides
                    autoplay: {
                        delay: 2500, // Auto-slide every 2.5 seconds
                        disableOnInteraction: false, // Continue autoplay after interaction
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2, // 2 logos on small screens
                        },
                        768: {
                            slidesPerView: 3, // 3 logos on medium screens
                        },
                        1024: {
                            slidesPerView: 4, // 4 logos on large screens
                        },
                    },
                });
            </script>