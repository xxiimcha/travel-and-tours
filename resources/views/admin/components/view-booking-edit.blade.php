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
                <h4 class=" mb-0 text-muted">Update Car Service</h4>
                <a class="btn btn-primary" href="{{route('manage-booking')}}">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                </a>
            </div>
    <div class="shadow-lg p-3 mb-5 bg-body rounded">  
    <div class="row justify-content-center">
        <div class="col-md-4"> <!-- Changed from col-md-5 to col-md-4 -->
            <div class="mb-3">
                <form id="createTourForm"action="{{route('update-booking-api',$booking->id)}}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">Type</label>
                    <input type="text" id="Type" name="Type" class="form-control @error('Type') text-danger is-invalid @enderror" placeholder="enter your car type">
             
            </div>
        </div>
    </div>
        <div class="row justify-content-center">         
            <div class="col-md-5">  
                <div class="mb-3">
                    <label for="">Manufacturer:</label>
                    <input type="text" id="manufacturer" value="{{ old('destination_name')}}"  name="manufacturer"   class="form-control @error('manufacturer') text-danger is-invalid @enderror"  placeholder="enter your destination name">            
                </div>       
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Car Price:</label>
                    <input type="number"  id="car_price" value="{{ old('car_price')}}"  name="car_price"  class="form-control @error('car_price') text-danger is-invalid @enderror"   placeholder="enter your desination price">
             
                </div>     
            </div>
        </div>
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Model</label>
                    <input type="text" value="{{ old('model')}}" id="model" name="model"  class="form-control @error('model') text-danger is-invalid @enderror"   placeholder="enter your desination price">
                       </select>
               
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Capacity</label>
                    <input type="text" id="capacity" value="{{ old('capacity')}}"  name="capacity"  class="form-control @error('capacity') text-danger is-invalid @enderror"   placeholder="enter your desination price">
                </select>       
           
               </div>     
            </div>
        </div>
        <div class="row justify-content-center"> 
            <div class="col-md-5">      
                <div class="mb-3">
                    <label for="">Fuel Type</label>
                    <input type="text" id="fuel_type" value="{{ old('fuel_type')}}"  name="fuel_type"  class="form-control @error('fuel_type') text-danger is-invalid @enderror"   placeholder="enter your desination price">
                </select> 
                
                </div>            
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Colors</label>
                    <input type="text" id="color" value="{{ old('color')}}"  name="color"  class="form-control @error('color') text-danger is-invalid @enderror"   placeholder="enter your desination price">
                </select>
                
               </div>     
            </div>
        </div>
    
        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Description</label>
                <textarea name="car_description" id="car_description" value="{{ old('destination_description')}}"  id=""  cols="20" rows="10"  class="@error('car_description') text-danger is-invalid @enderror form-control">

          </textarea> 
     
        </div>
        <div class="col-md-5 mb-1">
            <label for="">Policy</label>
            <textarea name="policy" id="policy" value="{{ old('destination_included')}}"   cols="20" rows="10"  class="@error('policy') text-danger is-invalid @enderror form-control">
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
        $(document).ready(function () {
    const bookingId = {{ $booking->id }}; // Use the booking ID from your backend

    // Fetch existing data and populate the form fields
    $.ajax({
        url: `/api/edit-booking/${bookingId}`,
        method: 'GET',
        headers: {
            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
        },
        success: function (response) {
            $('#Type').val(response.Car_type);
            $('#manufacturer').val(response.Manufacturer);
            $('#car_price').val(response.Car_price);
            $('#model').val(response.Model);
            $('#capacity').val(response.Capacity);
            $('#fuel_type').val(response.Fuel_type);
            $('#color').val(response.Colors);
            $('#car_description').val(response.Description);
            $('#policy').val(response.Policy);
        },
        error: function (xhr) {
            console.error(xhr.responseJSON.message);
            alert('Failed to fetch transportation data. Please try again.');
        }
    });

});

      </script>

      {{-- UPDATE BOOKING FUNCTION --}}
             
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
                              text: 'Booking updated successfully!',
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




