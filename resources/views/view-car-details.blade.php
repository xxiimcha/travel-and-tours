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
        <a href="{{ route('rentals') }}" class="bg-blue-400 text-white hover:bg-blue-500 mb-4 inline-block text-sm p-1 rounded">
            &larr; Go Back
        </a>
        
        <div class="flex flex-wrap md:flex-nowrap">
            <!-- Left Side: Tour Card -->
            <div class="w-full md:w-1/2 bg-white rounded-lg shadow-lg p-6 mb-6 md:mb-0">
                <!-- Featured Image with Price and Tour Name -->
                <div class="relative">

                        @if ($data->first_image)
                        <img src="{{ asset('booking-images/' . $data->first_image) }}" alt="Package Image" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <p>No image available</p>
                    @endif
                    <!-- Price in the top-right corner of the image -->
                    <div class="absolute top-2 right-2 bg-blue-500 text-white font-medium px-3 py-1 text-sm rounded-md">
                        PHP {{ number_format($data->Car_price) }} 
                    </div>
    
                    <!-- Tour Name in the top-right corner of the image (below price) -->
                    {{-- <div class="absolute top-10 right-2 bg-black bg-opacity-50 text-white font-medium px-3 py-1 text-sm rounded-md">
                        Description: {{ $data->destination_name }}
                    </div> --}}
            
                </div>
    
                <!-- Tour Details -->
                <h2 class="text-2xl font-bold text-gray-800 mb-4"> Description</h2>
                <p class="text-gray-600 mb-4">
                     {!!  $data->Description !!}
                </p>
    
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Vehicle Information</h3>
                <ul id="included-list">
                    <table class="table-auto w-full text-left text-gray-700">
                        <tbody id="car-details-table">
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Manufacturer:</td>
                                <td class="py-2" id="manufacturer">{{$data->Manufacturer}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Model:</td>
                                <td class="py-2" id="manufacturer">{{$data->Model}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Type:</td>
                                <td class="py-2" id="manufacturer">{{$data->Car_type}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Capacity:</td>
                                <td class="py-2" id="manufacturer">{{$data->Capacity}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Fuel Type:</td>
                                <td class="py-2" id="manufacturer">{{$data->Fuel_type}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 font-semibold">Color:</td>
                                <td class="py-2" id="manufacturer">{{$data->Colors}}</td>
                            </tr>
                        </tbody>
                    </table>
                </ul>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Policy</h3>
                <p class="text-gray-600 mb-4">
                    {!!  $data->Policy !!}
                </p>
                <!-- Book Now Button -->
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Book Now</button>
            </div>
    
            <!-- Right Side: Image Gallery -->
            <div class="w-full md:w-1/2 ml-0 md:ml-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">View More Images</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach ($images as $index => $image)
                        <img src="{{ asset('booking-images/' . $image) }}" class="w-full h-40 object-cover rounded-md cursor-pointer transition duration-300 transform hover:scale-105" alt="Gallery Image {{ $index + 1 }}" onclick="openModal({{ $index }})">
                    @endforeach
                </div>
            </div>
            
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
<div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
    <div class="spin-loader flex flex-col items-center">
        <div class="circle">
            <!-- Plane icon inside the spinning circle -->
            <i class="fas fa-plane text-blue-500 text-3xl"></i>
        </div>
        <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
    </div>
</div>

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
            modalImage.src = "{{ asset('booking-images/') }}/" + images[currentIndex];
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
            modalImage.src = "{{ asset('booking-images/') }}/" + images[currentIndex];
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
            modalImage.src = "{{ asset('booking-images/') }}/" + images[currentIndex];
            modalImage.classList.remove('slide-out');
            modalImage.classList.add('slide-in');
        }, 500);
    }
</script>

    
</body>
</html>
