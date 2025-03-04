<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.css')}}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('img/jvdlogo.png') }}" type="image/x-icon">
    <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
rel="stylesheet"
/>
    <link rel="stylesheet" href=" {{ asset('css/profile-user.css') }}">
    <title>Document</title>
</head>
<body>
   
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                  
                          @if($details && $details->user_images)
                            <img class="img-account-profile rounded-circle mb-2"    src="{{ asset('profile-pictures/' . $details->user_images) }}" alt="Profile Image" />
                        @else
                            <img class="img-account-profile rounded-circle mb-2"  style="height: 100px"  src="{{ asset('img/undraw_augmented_reality_re_f0qd.svg') }}" alt="Default Profile Image" />
                        @endif

                        <div class="small font-italic text-muted mb-4">User ID: <br> {{ Auth::user()->uuid  }}</div>
                
                      
                    </div>
                </div>
            </div>
                 
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details
                        <a href="{{ route('home') }}" class="btn btn-primary float-end text-white">Home</a>

                    </div>
                    <div class="card-body">
                        <form action="{{route('update-profile')}}" method="POST" enctype="multipart/form-data">        
                            @csrf     
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                    <input class="form-control" name="firstname" type="text" placeholder="Enter your first name" 
                                      value="{{ $details->firstname ?? Auth::user()->firstname }}"  >
                                    @error('firstname')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                    </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                    <input class="form-control" name="lastname" id="inputLastName" type="text" placeholder="Enter your last name"  value="{{ $details->lastname ?? Auth::user()->lastname }}"  >
                                    @error('lastname')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Address</label>
                                    <input class="form-control" name="address" id="inputOrgName" type="text" placeholder="Enter your address name" value="{{ $details->address ?? 'N/A' }}">
                                    @error('address')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Gender</label>
                                    <select name="gender" id="" class="form-control">
                                        <option value="" class="text-muted" disabled selected>---Select Gender---</option>
                                        <option value="{{ $details->gender ?? 'N/A' }}" disabled selected>{{ $details->gender ?? 'N/A'}}</option>               
                                        <option value="Male"  class="text-muted" >Male</option>
                                        <option value="Female"  class="text-muted" >Female</option>
                                        <option value="Prefer not to say"  class="text-muted" >Prefer not to say</option>
                            
                             
                             
                                    </select>
                                    @error('religion')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>
                            </div>
                            @if(session('success'))
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                        
                    
                        
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ session('success') }}',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            </script>
                        @endif
                        
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control"  name="email" id="inputEmailAddress" type="email" placeholder="Enter your email address"
                                 value="{{ $details->email ?? 'N/A' }}" >
                                 @error('email')
                                 <span class="text-danger">{{$message}} </span>
                             @enderror
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" value="{{ $details->phone_number ?? 'N/A' }}" name="phone_number" id="inputPhone" type="text" placeholder="Enter your phone number"  >
                                    @error('phone_number')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>
                                <div class="col-md-6">
                                    <!-- Profile picture upload button-->
                                <label class="form-label" for="customFile">Upload Image</label> 
                                <input type="file" class="form-control" id="customFile" name="user_images" />
                                @error('user_images')
                                <span class="text-danger">{{$message}} </span>
                            @enderror
                                     </div>
                        
                            </div>
                                <input type="submit" class="btn btn-primary" value="save changes"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB5 JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>

</body>
</html>