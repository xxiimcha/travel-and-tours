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
                <h1 class="h3 mb-0 text-muted">Update Flights Service</h1>
                <a class="btn btn-primary" href="{{route('manage-flights')}}">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                </a>
            </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded"> 
        <div class="row justify-content-center">         
            <div class="col-md-5">  
                <div class="mb-3">
                    <form id="createTourForm" action="{{route('update-flights-api',$booking->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <label for="">Title:</label>
                    <input type="text" value="{{ old('flights_title')}}"  id="flights_title" name="flights_title"   class="form-control @error('flights_title') text-danger is-invalid @enderror"  placeholder="enter your hotel name">            
                </div>       
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Price:</label>
                    <input type="number" value="{{ old('price')}}"  id="flights_price" name="flights_price"  class="form-control @error('price') text-danger is-invalid @enderror"   placeholder="enter your hotel price">
             
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
                <textarea name="flights_description" value="{{ old('flights_description')}}"  id="flights_description"  cols="20" rows="10"  class="@error('flights_description') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Policy</label>
            <textarea name="flights_policy" value="{{ old('flights_policy')}}" id="flights_policy"  cols="20" rows="10"  class="@error('flights_policy') text-danger is-invalid @enderror form-control">
            </textarea>      
    </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <label for="">Included</label>
                <textarea name="flights_included" value="{{ old('flights_included')}}"  id="flights_included"  cols="20" rows="10"  class="@error('flights_included') text-danger is-invalid @enderror form-control">

          </textarea> 
     
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
        $(document).ready(function () {
    const bookingId = {{ $booking->id }}; // Use the booking ID from your backend

    // Fetch existing data and populate the form fields
    $.ajax({
        url: `/api/edit-flights/${bookingId}`,
        method: 'GET',
        headers: {
            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
        },
        success: function (response) {
            $('#flights_title').val(response.flights_title);
            $('#flights_price').val(response.flights_price);
            $('#fromDate').val(response.flights_from);
            $('#toDate').val(response.flights_to);
            $('#flights_description').val(response.flights_description);
            $('#flights_included').val(response.flights_included);
            $('#flights_policy').val(response.flights_policy);
        },
                
        error: function (xhr) {
            console.error(xhr.responseJSON.message);
            alert('Failed to fetch Hotel data. Please try again.');
        }
    });

});
      </script>
    {{-- UPDATE  FUNCTION --}}
             
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
                      text: 'Flights updated successfully!',
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


