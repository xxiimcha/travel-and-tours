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

</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-muted">Update Destination Service</h1>
        <a class="btn btn-primary" href="{{route('manage-tour')}}">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
     <div class="row justify-content-center mb-3">
        <div class="col-md-5">
       
        </div>
     </div>
   
     <form id="createTourForm" action="{{ route('update-destination-api',$destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">             
            <div class="col-md-5 ">          
                <div class="mb-3">
                    <label for="">Destination Category:</label>
                    <select name="destination_category" id="destinationSelect" class="form-control">
                    </select>
                </div>     
    
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="destination_name">Destination Name:</label>
                    <input type="text" id="destination_name" value="" name="destination_name" class="form-control @error('destination_name') text-danger is-invalid @enderror" placeholder="Enter your destination name">
                </div>
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="destination_price">Destination Price:</label>
                    <input type="number" id="destination_price" value="{{ old('destination_price') }}" name="destination_price" class="form-control @error('destination_price') text-danger is-invalid @enderror" placeholder="Enter your destination price">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="destination_location">Destination Location:</label>
                    <input type="text" id="destination_location" value="" name="destination_location" class="form-control @error('destination_name') text-danger is-invalid @enderror" placeholder="Enter your destination location">
                </div>
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="destination_days">Duration Days:</label>
                    <input type="number" id="destination_days" value="" name="destination_days" class="form-control @error('destination_days') text-danger is-invalid @enderror" placeholder="Enter duration in days">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="destination_description">Destination Description:</label>
                <textarea id="destination_description" name="destination_description" cols="20" rows="10" class="@error('destination_description') text-danger is-invalid @enderror form-control">{{ old('destination_description') }}</textarea>
            </div>
            <div class="col-md-5 mb-1">
                <label for="destination_included">Destination Included:</label>
                <textarea id="destination_included" name="destination_included" cols="20" rows="10" class="@error('destination_included') text-danger is-invalid @enderror form-control">{{ old('destination_included') }}</textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <label for="destination_policy">Destination Policy:</label>
                <textarea id="destination_policy" name="destination_policy" cols="200" class="@error('destination_policy') text-danger is-invalid @enderror form-control">{{ old('destination_policy') }}</textarea>

                <div class="mb-3 col-md-12">
                    <label for="image">Cover Photo:</label>
                    <input type="file" class="@error('images') text-danger is-invalid @enderror form-control" name="images[]" id="images" multiple>
                </div>
            </div>
            <div class="col-md-10 float-start mt-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    </div>

    
    @include('admin/partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!------------------------   UPDATE DESTINATION VIEW       ----------------------->
    <script>
      $(document).ready(function() {
     $('#createTourForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            headers: {
                'Authorization': 'Bearer YOUR_TOKEN_HERE' // Add your Bearer token here
            },
            success: function(response) {
                // Handle successful response (e.g., show success message)
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Destination updated successfully!',
                }).then(() => {
                    // Redirect to another page after confirmation
                    window.location.href = response.redirect_url; // Set the redirect URL
                });
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    // Clear previous error classes and messages
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    $.each(errors, function(key, value) {
                        const input = $('[name="' + key + '"]');
                        input.addClass('is-invalid'); // Add invalid class
                        input.after('<div class="invalid-feedback">' + value[0] + '</div>'); // Append error message
                    });
                } else {
                    // Handle other errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred. Please try again.',
                    });
                }
            }
        });
    });
});

        </script>
 

           <!---      FETCHING DATA FROM API DESTINATION  -->
    <script>
        function fetchDestinations() {
            $.ajax({
                url: '/api/get-destination-api',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
                },
                success: function(response) {
                    const select = $('#destinationSelect');
                    select.empty();
                    select.append('<option value="" disabled selected>Select a destination</option>');
    
                    if (response.length > 0) {
                        $.each(response, function(index, destination) {
                            select.append('<option value="' + destination.destination + '">' + destination.destination + '</option>');
                        });
                    } else {
                        console.log('No destinations found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', xhr.status, xhr.responseText); // Log status and response
                }
            });
        }
    
        $(document).ready(function() {
            fetchDestinations();
        });
    </script>

    <!------------------------   EDIT DESTINATION VEIW       ----------------------->
    <script>
        $(document).ready(function() {
            const destinationId = {{ $destination->id }}; // Replace with the actual destination ID
          // Get the Bearer token from local storage
    
            // Fetch tour data
            $.ajax({
                url: `/api/edit-destination/${destinationId}`, // Adjust this URL based on your API structure
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'  // Include the Bearer token in the header
                },
                success: function(response) {
                    // Populate the form fields with the response data
                    $('#destination_name').val(response.destination_name);
                    $('#destination_price').val(response.destination_price);
                    $('#destination_location').val(response.destination_location);
                    $('#destination_days').val(response.destination_days);
                    $('#destination_description').val(response.destination_description);
                    $('#destination_included').val(response.destination_included);
                    $('#destination_policy').val(response.destination_policy);
                },
                error: function(xhr) {
                    console.error(xhr.responseJSON.message); // Handle error if needed
                    alert('Failed to fetch destination data. Please try again.');
                }
            });
        });
    </script>


