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
        <h1 class="h3 mb-0 text-muted">Create Flights Service</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
        <div class="row justify-content-center">         
            <div class="col-md-5">  
                <div class="mb-3">
                    <form id="createTourForm" action="{{route('create-flights-api')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <label for="">Title:</label>
                    <input type="text" value="{{ old('flights_title')}}"  name="flights_title"   class="form-control @error('flights_title') text-danger is-invalid @enderror"  placeholder="enter your hotel name">            
                </div>       
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Price:</label>
                    <input type="number" value="{{ old('price')}}"  name="flights_price"  class="form-control @error('price') text-danger is-invalid @enderror"   placeholder="enter your hotel price">
             
                </div>     
            </div>
        </div>
     
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Travel Dates:From</label>
                    <input type="text" value="{{ old('flights_from')}}" id="fromDate" name="flights_from"  class="form-control @error('flights_from') text-danger is-invalid @enderror"   placeholder="From....">
                       </select>
               
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Travel Dates:To</label>
                    <input type="text" value="{{ old('flights_to')}}"  id="toDate" name="flights_to"  class="form-control @error('flights_to') text-danger is-invalid @enderror"   placeholder="To....">
                </select>       
           
               </div>     
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Description</label>
                <textarea name="flights_description" value="{{ old('flights_description')}}"  id=""  cols="20" rows="10"  class="@error('flights_description') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Policy</label>
            <textarea name="flights_policy" value="{{ old('flights_policy')}}"   cols="20" rows="10"  class="@error('flights_policy') text-danger is-invalid @enderror form-control">
            </textarea>      
    </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <label for="">Included</label>
                <textarea name="flights_included" value="{{ old('flights_included')}}"  id=""  cols="20" rows="10"  class="@error('flights_included') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        </div>
        <div class="row justify-content-center">
            <div class="mb-3 col-md-10">
                <label for="">Cover Photo</label>
                <input type="file" class="@error('images') text-danger is-invalid @enderror form-control" name="images[]" id="images" multiple>    
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
                    url: '/api/create-flights-api', // Change to your API endpoint
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


  
  <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the "From" datepicker
            flatpickr("#fromDate", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    // Set the minimum date for the "To" datepicker based on the selected "From" date
                    toDatePicker.set("minDate", dateStr);
                }
            });
    
            // Initialize the "To" datepicker with a variable to manage minDate
            const toDatePicker = flatpickr("#toDate", {
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    // Optionally, set the maxDate of "From" date based on "To" date
                    fromDatePicker.set("maxDate", dateStr);
                }
            });
        });
    </script>


