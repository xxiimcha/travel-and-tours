<!-- Services Section -->
<section id="services" class="col-span-2 py-20 bg-gray-100">
    <div class="container mx-auto w-full px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Services</h2>
        <h2 class="text-xl font-bold text-gray-800 mb-6">We Offer</h2>

        <div class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-96 overflow-hidden rounded-lg">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out " data-carousel-item>
                    <img src="{{asset('img/offer1.png')}}" class=" absolute block w-full h-full object-cover" alt="Service 1">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">Seminar/Meeting</h3>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{asset('img/offer2.png')}}" class="absolute block w-full h-full object-cover" alt="Service 2">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">  Birthday Celebration</h3>
                    </div>
                </div>
             
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer3.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">Wedding Anniversary</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer4.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">Team Building</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer5.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white"> Concert Pageant</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer6.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">Field Trip</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer7.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white"> Airline Ticketing</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer8.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">  Tour Package</h3>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('img/offer9.png')}}" class="absolute block w-full h-full object-cover" alt="Service 3">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <h3 class="text-4xl font-bold text-white">Bus/Van Rental</h3>
                    </div>
                </div>  
                <!-- More items as needed -->
            </div>

            <!-- Carousel controls -->
            <div class="flex justify-center items-center pt-4">
                <button type="button" class="flex justify-center items-center me-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="text-blue-600 hover:text-gray-900 group-focus:text-gray-900">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="flex justify-center items-center h-full cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="text-blue-600 hover:text-gray-900 group-focus:text-gray-900">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>

    </div>
</section>

          {{-- <section id="services" class="col-span-2 py-20 bg-gray-100">
            <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Services</h2>
        <h2 class="text-xl font-bold text-gray-800 mb-6">We Offer</h2>
        <Seminar class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Service Box 1 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer1.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Seminar/Meeting</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>  

            <!-- Service Box 2 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer2.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Birthday/Celebration</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>

            <!-- Service Box 3 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer3.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Wedding Anniversary</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>

            <!-- Service Box 4 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer4.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Team Building</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>Seminar Meeting,Birthday Celebration,Wedding Anniversary Team Building
            </div>

            <!-- Service Box 5 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer5.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Concert/Pageant</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>

            <!-- Service Box 6 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer6.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Field Trip</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>
     

            <!-- Service Box 7 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer7.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Airline Ticketing</h3>
                    <p class="text-gray-300 mb-4">.</p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>

            <!-- Service Box 8 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer8.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Tour Package</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>

            <!-- Service Box 9 -->
            <div class="service-box group relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="service-image absolute inset-0 bg-cover bg-center transition-transform duration-500" style="background-image: url('{{ asset('img/offer9.png')}}');"></div>
                <div class="relative z-10 p-6 flex flex-col justify-end h-full bg-gradient-to-t from-black via-transparent to-transparent">
                    <h3 class="text-2xl font-bold mb-2">Bus/Van Rental</h3>
                    <p class="text-gray-300 mb-4"></p>
                    <a href="#" class="text-white-400 font-bold hover:text-white-500">Learn More</a>
                </div>
            </div>
        </div>
    

</section> --}}
