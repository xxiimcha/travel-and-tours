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
    
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-muted">Create Tours</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
     <div class="row justify-content-center mb-3">
        <div class="col-md-5">
        
      
        </div>
     </div>
     <div class="row justify-content-center">      
    
        <div class="col-md-5 ">      
            <form  id="destinationForm" action="{{ route('create-destination-api')}}" method="post">    
                @csrf
            <div class="mb-3">
               <!-- Dismissible success alert -->
                <div id="successMessage" class="alert alert-success alert-dismissible fade show mt-2" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span id="successText"></span>
                </div>
                <label for="">Add Destination :</label>
                <input type="text" value="" id="destination"  name="destination"   class="form-control @error('destination') text-danger is-invalid @enderror"  placeholder="enter your destination name">     
                <span class="invalid-feedback" id="destinationError"></span>
              
            </div>     
            <button type="submit" class="btn btn-primary btn-sm">Add Destination</button>   
        </div>
    </form>
    </div>
    <form id="createTourForm" action="{{route('create-destination-Api')}}" method="POST" enctype="multipart/form-data">
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
                    <label for="">Destination Name:</label>
                    <input type="text" value="{{ old('destination_name')}}"  name="destination_name"   class="form-control @error('destination_name') text-danger is-invalid @enderror"  placeholder="enter your destination name">     
                </div>        
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Destination Price:</label>
                    <input type="number" value="{{ old('destination_price')}}"  name="destination_price"  class="form-control @error('destination_price') text-danger is-invalid @enderror"   placeholder="enter your desination price">          
                </div>     
            </div>
        </div>

        <div class="row justify-content-center">      
            <div class="col-md-5">          
                <div class="mb-3">
                    <label for="">Destination location:</label>
                    <input type="text" value=""  name="destination_location"   class="form-control @error('destination_name') text-danger is-invalid @enderror"  placeholder="enter your destination name">     
                </div>        
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Duration Days 
                        
                    </label>
                    <input type="number" value=""  name="destination_days"  class="form-control @error('destination_price') text-danger is-invalid @enderror"   placeholder="enter your desination price">          
                </div>     
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Destination Description</label>
                <textarea name="destination_description" value="{{ old('destination_description')}}"  id=""  cols="20" rows="10"  class="@error('destination_description') text-danger is-invalid @enderror form-control">
          </textarea>   
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Destination Included</label>
            <textarea name="destination_included" value="{{ old('destination_included')}}"   cols="20" rows="10"  class="@error('destination_included') text-danger is-invalid @enderror form-control">
            </textarea>   
    </div>
    <div class="row  justify-content-center">
        <div class="col-md-10">
        <label for="">Destination Policy</label>
        <textarea name="destination_policy" value="{{ old('destination_policy')}}"      cols="200"  class="@error('destination_policy') text-danger is-invalid @enderror form-control">         
        </textarea> 
        <div class="mb-3 col-md-12">
            <label for="images">Cover Photos</label>
            <input type="file" class="@error('images') text-danger is-invalid @enderror form-control" name="images[]" id="images" multiple>
        </div>
    </div>       
</div>
            <div class="col-md-10 float-start mt-2" >
                <button type="submit" class="btn btn-primary">Save</button>
            </div>      
        </form> 
    </div>

    
    @include('admin/partials.footer')





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-----    SHOW MESSGAE CREATE-API DESTINATION  ---------->
      <script>
        $(document).ready(function() {
            $('#createTourForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
        
                // Clear previous error messages
                $('.text-danger').remove();
                $('.is-invalid').removeClass('is-invalid');
        
                // Gather form data
                var formData = new FormData(this);
        
                // AJAX request to the API
                $.ajax({
                    url: '/api/create-destination-Api', // Change to your API endpoint
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'  // Include the API token in the header
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            // Use SweetAlert for success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#createTourForm')[0].reset(); // Reset form after confirmation
                                }
                                 // Redirect to another page after confirmation
                                 window.location.href = response.redirect_url; // Set the redirect URL
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Show validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                var inputField = $('[name=' + key + ']');
                                inputField.addClass('is-invalid'); // Highlight invalid field
                                inputField.after('<span class="text-danger">' + messages[0] + '</span>'); // Show error message
                            });
                        } else {
                            // Use SweetAlert for general error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred: ' + xhr.responseJSON.message,
                                confirmButtonText: 'OK'
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
      
    <!-----    SHOW MESSGAE ---------->
    <script>
        document.getElementById('destinationForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
    
            const destinationInput = document.getElementById('destination');
            const destinationError = document.getElementById('destinationError');
            const successMessage = document.getElementById('successMessage');
            const successText = document.getElementById('successText');
    
            // Clear previous errors
            destinationInput.classList.remove('is-invalid');
            destinationError.innerText = '';
            successMessage.style.display = 'none';
    
            // Send AJAX request
            fetch('{{ route('create-destination-api') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    destination: destinationInput.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    // If validation failed, show errors
                    if (data.errors && data.errors.destination) {
                        destinationInput.classList.add('is-invalid');
                        destinationError.innerText = data.errors.destination[0];
                    }
                } else {
                    // If successful, show success message
                    successMessage.style.display = 'block';
                    successText.innerText = data.message;
                     // Refresh the browser after a short delay
                setTimeout(() => {
                    location.reload(); // Refresh the page
                }, 1000); // 2-second delay (adjust as needed)
                    // Optionally reset the form
                    document.getElementById('destinationForm').reset();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>




