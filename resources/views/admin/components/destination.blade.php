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
        <h1 class="h3 mb-0 text-muted">Add Destination</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-body rounded">

        <div class="row justify-content-center">
          
            <div class="col-md-5">
                <form action="{{ route('add-destination') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="mb-3">
                    <label for="">Destinations</label>
                    <input type="text" name="destination"  class="form-control @error('destination')  text-danger is-invalid @enderror" value="" placeholder="enter your destinationss">             
                    @error('destination')
                    <span class="text-danger">{{ $message }}</span>
                        
                    @enderror
                </div>
         
              
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Adventour Tours</label>
                    <input type="text" name="adventour"  class="form-control  @error('adventour')  text-danger is-invalid @enderror" value=""  placeholder="enter your adventours">
                    @error('adventour')
                    <span class="text-danger">{{ $message }}</span>
                        
                    @enderror
                </div>     
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Leisure and Scenic Tours</label>
                    <input type="text" name="leisureAndScenicTour"  class=" @error('leisureAndScenicTour')  text-danger is-invalid @enderror form-control"  placeholder="enter your Leisure">
                    @error('leisureAndScenicTour')
                    <span class="text-danger">{{ $message }}</span>
                        
                    @enderror
                </div>
             
                    <div class="mb-3">
                        <label for="">Destination Photo</label>
                        <input type="file"  class="@error('image')  text-danger is-invalid @enderror form-control" name="image" id="">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                            
                        @enderror
                    </div>   
                 
        
                    <button type="submit" class="btn btn-primary">Save</button>
            
              
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label for="">Specialized and Educational Tours</label>
                    <input type="text" name="SpecialEducational"  class="@error('SpecialEducational')  text-danger is-invalid @enderror form-control" placeholder="enter your specialized">
                    
                </div>   
             
            </div>
         
        </form>  
        </div>
      
    
    </div>
    @include('admin/partials.footer')






