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
        <h1 class="h3 mb-0 text-muted">Create Booking</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
   
        
        <div class="row justify-content-center">
            <div class="col-md-4"> <!-- Changed from col-md-5 to col-md-4 -->
                <div class="mb-3">
                    <form id="createTourForm" action="{{ route('create-booking-api') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">Type</label>
                        <input type="text" name="Type" class="form-control @error('Type') text-danger is-invalid @enderror" placeholder="enter your car type">
                 
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">         
            <div class="col-md-5">  
                <div class="mb-3">
                    <label for="">Manufacturer:</label>
                    <input type="text" value="{{ old('destination_name')}}"  name="manufacturer"   class="form-control @error('manufacturer') text-danger is-invalid @enderror"  placeholder="">            
                </div>       
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Car Price:</label>
                    <input type="number" value="{{ old('car_price')}}"  name="car_price"  class="form-control @error('car_price') text-danger is-invalid @enderror"   placeholder="">
             
                </div>     
            </div>
        </div>
     
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Model</label>
                    <input type="text" value="{{ old('model')}}"  name="model"  class="form-control @error('model') text-danger is-invalid @enderror"   placeholder="">
                       </select>
               
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Capacity</label>
                    <input type="text" value="{{ old('capacity')}}"  name="capacity"  class="form-control @error('capacity') text-danger is-invalid @enderror"   placeholder="">
                </select>       
           
               </div>     
            </div>
        </div>
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Fuel Type</label>
                    <input type="text" value="{{ old('fuel_type')}}"  name="fuel_type"  class="form-control @error('fuel_type') text-danger is-invalid @enderror"   placeholder="">
                </select> 
                
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Colors</label>
                    <input type="text" value="{{ old('color')}}"  name="color"  class="form-control @error('color') text-danger is-invalid @enderror"   placeholder="">
                </select>
                
               </div>     
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Description</label>
                <textarea name="car_description" value="{{ old('destination_description')}}"  id=""  cols="20" rows="10"  class="@error('car_description') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Policy</label>
            <textarea name="policy" value="{{ old('destination_included')}}"   cols="20" rows="10"  class="@error('policy') text-danger is-invalid @enderror form-control">
            </textarea>      
    </div> 
        </div>
        <div class="row justify-content-center">
            <div class="mb-3 col-md-10">
                <label for="">Cover Photo</label>
                <input type="file"  class="@error('image')  text-danger is-invalid @enderror form-control" name="images[]" id="" multiple>      
            </div>    
            <div class="col-md-10 float-start mt-2" >
                <button type="submit" class="btn btn-primary">Save</button>
            </div>  
        </div>
   
         </div>
      </form> 
</div>
    @include('admin/partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
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
                    url: '/api/create-booking-api', // Change to your API endpoint
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




