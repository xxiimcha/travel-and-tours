<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JVD Events and Travel Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/jvdlogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css')}}" />
    <style>
        /* Transition styles for the modal */
        #imageModal {
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .modal-visible {
            visibility: visible;
            opacity: 1;
        }
        .modal-hidden {
            visibility: hidden;
            opacity: 0;
        }

        /* Transition styles for the image in the modal */
        #modalImage {
            transition: opacity 0.5s ease;
        }
        .fade-out {
            opacity: 0;
        }
        .fade-in {
            opacity: 1;
        }
        

        /* Transition styles for the close button */
        #closeButton {
            transition: opacity 0.5s ease;
        }

        #modalImage {
    transition: opacity 0.5s ease-in-out;
    opacity: 1;
}

#imageModal.modal-visible #modalImage {
    opacity: 1;
}

#imageModal.modal-hidden #modalImage {
    opacity: 0;
}
    </style>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-6">
        <!-- Back Button -->
        <a href="{{ route('flights') }}" class="bg-blue-400 text-white hover:bg-blue-500 mb-4 inline-block text-sm p-1 rounded">
            &larr; Go Back
        </a>
        
        <div class="flex flex-wrap md:flex-nowrap">
            <!-- Left Side: Tour Card -->
            <div class="w-full md:w-1/2 bg-white rounded-lg shadow-lg p-6 mb-6 md:mb-0">
                <!-- Featured Image with Price and Tour Name -->
                <div class="relative">

                        @if ($data->first_image)
                        <img src="{{ asset('flights-images/' . $data->first_image) }}" alt="Package Image" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <p>No image available</p>
                    @endif
                    <!-- Price in the top-right corner of the image -->
                    <div class="absolute top-2 right-2 bg-blue-500 text-white font-medium px-3 py-1 text-sm rounded-md">
                        PHP {{ number_format($data->flights_price) }} 
                    </div>
    
                    <!-- Tour Name in the top-right corner of the image (below price) -->
                    <div class="absolute top-10 right-2 bg-black bg-opacity-50 text-white font-medium px-3 py-1 text-sm rounded-md">
                        Hotel Name: {{ $data->flights_title }}
                    </div>
            
                </div>
    
                <!-- Tour Details -->
                <h2 class="text-2xl font-bold text-gray-800 mb-4"> Description</h2>
                <p class="text-gray-600 mb-4">
                     {!!  $data->flights_description !!}
                </p>
    
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Included</h3>
                <p class="text-gray-600 mb-4">
                {{ $data->flights_included }}
            </p>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Policy</h3>
                <p class="text-gray-600 mb-4">
                    {!!  $data->flights_policy !!}
                </p>
                <!-- Book Now Button -->
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Book Now</button>
            </div>
    
            <!-- Right Side: Image Gallery -->
            <div class="w-full md:w-1/2 ml-0 md:ml-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">View More Images</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach ($images as $index => $image)
                        <img src="{{ asset('flights-images/' . $image) }}" class="w-full h-40 object-cover rounded-md cursor-pointer transition duration-300 transform hover:scale-105" alt="Gallery Image {{ $index + 1 }}" onclick="openModal({{ $index }})">
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
    <div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
        <div class="spin-loader flex flex-col items-center">
            <div class="circle">
                <!-- Plane icon inside the spinning circle -->
                <i class="fas fa-plane text-blue-500 text-3xl"></i>
            </div>
            <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
        </div>
    </div>
 

   <!-- Modal for Image Preview -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center modal-hidden" onclick="closeModal()">
    <div class="relative" onclick="event.stopPropagation();">

        <img id="modalImage" class="w-[600px] h-[400px] object-cover rounded-md transition-transform duration-300">

        <!-- Close Button Positioned on the Right Corner -->
        <button id="closeButton" class="absolute top-4 right-4 bg-blue-500 text-white rounded-full p-2" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Prev and Next Buttons Centered Outside Image -->
        <div class="flex justify-center mt-4">
            <button id="prevBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full mr-4" onclick="prevImage()">Prev</button>
            <button id="nextBtn" class="bg-blue-500 text-white px-4 py-2 rounded-full" onclick="nextImage()">Next</button>
        </div>
    </div>
</div>


    <!-------------------     DAILY ITINERARY           ---------------------->
 <!-- Header -->
 <header class="relative bg-indigo-600 text-white">
    <!-- Background Image -->
    <div class="absolute inset-0">
      <img 
        src="{{asset('img/backgroundphoto.png')}}" 
        alt="Thailand Adventure" 
        class="w-full h-full object-cover opacity-80"
      >
    </div>
  
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
  
    <!-- Content -->
    <div class="relative container mx-auto px-4 py-16 text-center">
      <h1 class="text-4xl md:text-5xl font-bold">
        Philippines Vacation Packages
      </h1>
      <p class="mt-4 text-lg md:text-xl">
        Discover the best flight deals for your dream vacations. With all the details handled in advance, you can enjoy a hassle-free journey to your favorite destinations. Book now to secure the best rates!
      </p>
    
    </div>
  </header>
  
  <section class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-blue-500 mb-6">Daily Itinerary</h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
      <div class="lg:col-span-2">  
        @foreach ($itinerary->dailyItineraries as $itinerarys)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white shadow-md rounded-lg p-6 mb-6">
          <div>
            <h3 class="text-xl font-semibold text-blue-500 mb-2">{{$itinerarys->day_number}}: {{$itinerarys->destination_category}}</h3>
            <p class="text-gray-700">{!! $itinerarys->description !!}</p>
            <p class="mt-4 text-gray-600"><strong>Location:</strong> {{$itinerarys->location}}</p>
          </div>
          <div>
            <img src="{{asset('flights-itenirary-images/'. $itinerarys->itenirary_images)}}" alt="Day 1 Image" class="w-full rounded-lg">
          </div>
        </div>
      @endforeach
      </div>
            <!-- JS LOADER -->
      {{-- <div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
        <div class="spin-loader flex flex-col items-center">
            <div class="circle">
                <!-- Plane icon inside the spinning circle -->
                <i class="fas fa-plane text-blue-500 text-3xl"></i>
            </div>
            <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
        </div>
    </div>       --}}
      <!-- Customer Feedback Column -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold  text-blue-500  mb-4">Customer Feedback</h3>
        <div class="space-y-4">
          <!-- Feedback Item -->
          <div class="bg-gray-100 rounded-lg p-4 flex items-center">
            <!-- User Image -->
            <img 
              src="https://via.placeholder.com/50" 
              alt="John Doe" 
              class="w-12 h-12 rounded-full mr-4"
            >
            <!-- Feedback Content -->
            <div>
              <p class="text-gray-700">"The tour was absolutely amazing! Everything was perfectly organized, and our guide was fantastic."</p>
              <p class="text-sm  text-blue-500 mt-2">- John Doe</p>
              <p class="text-xs  text-blue-500  mt-1">Created on: November 10, 2024</p>
            </div>
          </div>
          
          <!-- Feedback Item -->
          <div class="bg-gray-100 rounded-lg p-4 flex items-center">
            <!-- User Image -->
            <img 
              src="https://via.placeholder.com/50" 
              alt="Jane Smith" 
              class="w-12 h-12 rounded-full mr-4"
            >
            <!-- Feedback Content -->
            <div>
              <p class="text-gray-700">"Loved the floating market experience! The itinerary was well-paced and enjoyable."</p>
              <p class="text-sm text-blue-500  mt-2">- Jane Smith</p>
              <p class="text-xs  text-blue-500  mt-1">Created on: November 12, 2024</p>
            </div>
          </div>
          
          <!-- Feedback Item -->
          <div class="bg-gray-100 rounded-lg p-4 flex items-center">
            <!-- User Image -->
            <img 
              src="https://via.placeholder.com/50" 
              alt="Alex Brown" 
              class="w-12 h-12 rounded-full mr-4"
            >
            <!-- Feedback Content -->
            <div>
              <p class="text-gray-700">"The hotel accommodations and local food were highlights of the trip. Highly recommended!"</p>
              <p class="text-sm text-blue-500  mt-2">- Alex Brown</p>
              <p class="text-xs  text-blue-500  mt-1">Created on: November 15, 2024</p>
            </div>
          </div>
        </div>
      </div>    
  </section>


<script src="{{ asset('assets/js/loader.js') }}"></script>
<script>
    const images = @json($images); // Pass the PHP array to JavaScript
    let currentIndex = 0; // Initial index for image display

    // Open modal and display image
    function openModal(index) {
        currentIndex = index;
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        // Make the modal visible
        modal.classList.remove('modal-hidden');
        modal.classList.add('modal-visible');
        
        // Fade out the image before changing it
        modalImage.classList.add('slide-out');
        
        // Wait for the fade-out to finish before changing the image
        setTimeout(() => {
            modalImage.src = "{{ asset('flights-images/') }}/" + images[currentIndex];
            modalImage.classList.remove('slide-out');
            modalImage.classList.add('slide-in');
        }, 500);
    }

    // Close modal when clicking outside the image container or on the close button
    function closeModal() {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        // Fade out the image before closing the modal
        modalImage.classList.add('slide-out');
        
        // Wait for the fade-out to finish before closing the modal
        setTimeout(() => {
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden');
            modalImage.classList.remove('slide-out');
            modalImage.classList.remove('slide-in');
        }, 500);
    }

    // Show the previous image
    function prevImage() {
        currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1;
        const modalImage = document.getElementById('modalImage');
        
        // Fade out the current image before changing it
        modalImage.classList.add('slide-out');
        
        // Wait for the fade-out to finish before changing the image
        setTimeout(() => {
            modalImage.src = "{{ asset('flights-images/') }}/" + images[currentIndex];
            modalImage.classList.remove('slide-out');
            modalImage.classList.add('slide-in');
        }, 500);
    }

    // Show the next image
    function nextImage() {
        currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;
        const modalImage = document.getElementById('modalImage');
        
        // Fade out the current image before changing it
        modalImage.classList.add('slide-out');
        
        // Wait for the fade-out to finish before changing the image
        setTimeout(() => {
            modalImage.src = "{{ asset('flights-images/') }}/" + images[currentIndex];
            modalImage.classList.remove('slide-out');
            modalImage.classList.add('slide-in');
        }, 500);
    }
</script>

    
</body>
</html>
