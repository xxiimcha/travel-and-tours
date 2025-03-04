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
                <h1 class="h3 mb-0 text-muted">Update Hotel Service</h1>
                <a class="btn btn-primary" href="{{route('manage-hotel')}}">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                </a>
            </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <div class="row justify-content-center">         
            <div class="col-md-5">  
                <div class="mb-3">
                    <form id="createTourForm" action="{{ route('update-hotel-api', $booking->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <label for="">Hotel Name:</label>
                    <input type="text" value="{{ old('hotel_name')}}"  id="hotel_name" name="hotel_name"   class="form-control @error('hotel_name') text-danger is-invalid @enderror"  placeholder="enter your hotel name">            
                </div>       
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Hotel Price:</label>
                    <input type="number" value="{{ old('hotel_price')}}"  id="hotel_price"  name="hotel_price"  class="form-control @error('hotel_price') text-danger is-invalid @enderror"   placeholder="enter your hotel price">
             
                </div>     
            </div>
        </div>
     
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Room Type</label>
                    <input type="text" value="{{ old('room_type')}}"  id="room_type" name="room_type"  class="form-control @error('room_type') text-danger is-invalid @enderror"   placeholder="enter hotel  room type">
                       </select>
               
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Capacity</label>
                    <input type="text" value="{{ old('capacity')}}"  id="capacity" name="capacity"  class="form-control @error('capacity') text-danger is-invalid @enderror"   placeholder="enter hotel capacity">
                </select>       
           
               </div>     
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Description</label>
                <textarea name="hotel_description" value="{{ old('hotel_description')}}"  id="hotel_description"  cols="20" rows="10"  class="@error('car_description') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Policy</label>
            <textarea name="hotel_policy" value="{{ old('hotel_policy')}}"  id="hotel_policy"  cols="20" rows="10"  class="@error('hotel_policy') text-danger is-invalid @enderror form-control">
            </textarea>      
    </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <label for="">Included</label>
                <textarea name="hotel_included" value="{{ old('hotel_included')}}"  id="hotel_included"  cols="20" rows="10"  class="@error('flights_included') text-danger is-invalid @enderror form-control">

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
        url: `/api/edit-hotel/${bookingId}`,
        method: 'GET',
        headers: {
            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
        },
        success: function (response) {
            $('#hotel_name').val(response.hotel_name);
            $('#hotel_price').val(response.hotel_price);
            $('#room_type').val(response.room_type);
            $('#capacity').val(response.capacity);
            $('#hotel_description').val(response.hotel_description);
            $('#hotel_policy').val(response.hotel_policy);
            $('#hotel_included').val(response.hotel_included);
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
                      text: 'Hotel updated successfully!',
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

