@include('admin/partials.header-css')

@include('admin/partials.sidebar')
@include('admin/partials.top-content')


<style>
    /* Hide the default file input appearance */
input[type="file"] {
    display: block; /* Ensures it is visible */
    padding: 10px; /* Add padding for better appearance */
    border: 1px solid #ced4da; /* Add border */
    border-radius: 0.25rem; /* Match Bootstrap input styling */
    background-color: #f8f9fa; /* Optional: background color */
}

/* Customize the file input */
input[type="file"]::-webkit-file-upload-button {
    display: none; /* Hide the default button */

}

.carousel-controls {
        position: absolute;
        top: 50%; /* Position at the vertical center */
        width: 100%; /* Full width */
        display: flex;
        justify-content: center; /* Center the buttons horizontally */
        transform: translateY(-50%); /* Adjust for centering */
        z-index: 1; /* Ensure controls are on top of images */
    }

    .carousel-control-prev,
    .carousel-control-next {
        background-color: var(--bs-primary); /* Use Bootstrap's primary color */
        border-radius: 50%; /* Rounded buttons */
        border: none; /* Remove border */
        padding: 10px; /* Add padding */
        width: 50px; /* Set width */
        height: 50px; /* Set height */
        margin: 0 10px; /* Add space between buttons */
        opacity: 0.8; /* Slightly transparent */
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1; /* Fully visible on hover */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: white; /* Icon color */
        border-radius: 50%; /* Circular icons */
        padding: 10px; /* Space around icons */
    }
    .carousel-item img {
    width: 100%; /* Make sure it takes the full width of the carousel */
    height: 300px; /* Set a fixed height for the images */
    object-fit: cover; /* Ensure images cover the area without stretching */
}

</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-muted">Destination Details</h1>
        <a class="btn btn-primary" href="{{route('manage-tour')}}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    <div class="shadow-lg pb-5 pt-3 mb-5 bg-body rounded">
        <div class="container mt-5">
            <div class="row g-0">
                <div class="col-md-6">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Dynamic carousel items will be injected here -->
                        </div>
                        <div class="carousel-controls">
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <i class="fas fa-chevron-left"></i> <!-- Font Awesome left chevron icon -->
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <i class="fas fa-chevron-right"></i> <!-- Font Awesome right chevron icon -->
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>     
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">Product Name Title Here</h5>
                        <h6 class="card-subtitle mb-2 text-muted">PHP 23,000</h6>
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100 active"
                                   id="ex1-tab-1" data-bs-toggle="tab" href="#ex1-pills-1"
                                   role="tab" aria-controls="ex1-pills-1" aria-selected="true">
                                    Tour Description
                                </a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100"
                                   id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-pills-2"
                                   role="tab" aria-controls="ex1-pills-2" aria-selected="false">
                                    Tour Policy
                                </a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100"
                                   id="ex1-tab-3" data-bs-toggle="tab" href="#ex1-pills-3"
                                   role="tab" aria-controls="ex1-pills-3" aria-selected="false">
                                    Tour Included
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="ex1-content">
                            <!-- Tour Description -->
                            <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                                Loading description...
                            </div>
                            <!-- Tour Policy -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                Loading policy...
                            </div>
                            <!-- Tour Included -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                <ul id="included-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
 
    @include('admin/partials.footer')

   <script>
    $(document).ready(function() {
    // Replace with your destination ID dynamically based on the destination clicked
    var destinationId = {{ $destination->id }}; 

    // AJAX request to fetch destination data
    $.ajax({
        url: `/api/destination/${destinationId}`, // Your API endpoint
        type: 'GET',
        headers: {
            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47' // Replace with your actual token
        },
        success: function(response) {
            console.log(response); // Log the response to inspect the data

            function formatNumber(value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            var price = response.price; // Assuming price is a number in the response
            var formattedPrice = formatNumber(price); // Format the price

            // Update product details
            $('.card-title').text(response.name); // Product Name
            $('.card-subtitle').text('PHP ' + formattedPrice); // Formatted Price
            $('#ex1-pills-1').html(response.description); // Description
            $('#ex1-pills-2').html(response.policy); // Policy
            $('#ex1-pills-3').html(response.included); // Included

            // Fetch the images and create carousel items dynamically
            var carouselInner = $('.carousel-inner');
            carouselInner.empty(); // Clear any existing carousel items

            // Check if images are available
         // Check if images are available
         if (response.images && response.images.length > 0) {
                response.images.forEach(function(image, index) {
                    var isActive = index === 0 ? 'active' : ''; // Set the first image as active
                    var carouselItem = `
                        <div class="carousel-item ${isActive}">
                            <img src="${image}" class="d-block w-100 img-fluid rounded-start" alt="Product Image ${index + 1}">
                        </div>`;
                    carouselInner.append(carouselItem); // Append the new carousel item
                });
            } else {
                console.warn('No images found for this destination.'); // Log if no images found
                carouselInner.append('<div class="carousel-item active"><img src="/images/default.jpg" class="d-block w-100 img-fluid rounded-start" alt="Default Image"></div>');
            }
            // Refresh the carousel to ensure it displays correctly
            $('#productCarousel').carousel();
        },
        error: function(xhr) {
            alert('Error fetching data: ' + (xhr.responseJSON.message || 'An error occurred'));
        }
    });
});

   </script>






