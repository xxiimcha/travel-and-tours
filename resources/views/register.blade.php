@include('auth.form.header-css')
@include('auth.form.navigation')

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 px-6">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-10 w-auto" src="https://www.svgrepo.com/show/301692/login.svg" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            Create a new account
        </h2>
        <p class="mt-2 text-center text-sm leading-5 text-blue-500 max-w">
            Or
            <a href="{{ route('login')}}" class="font-medium text-blue-500 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                sign in to your account
            </a>
        </p>
    </div>

    <div id="loader" class="loader-wrapper fixed inset-0 bg-white flex items-center justify-center z-50">
        <div class="spin-loader flex flex-col items-center">
            <div class="circle">
                <!-- Plane icon inside the spinning circle -->
                <i class="fas fa-plane text-blue-500 text-3xl"></i>
            </div>
            <span class="loading text-blue-700 font-semibold text-lg mt-4">Loading your journey...</span>
        </div>
    </div>

  
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form id="registrationForm" action="{{ route('register-account') }}" method="POST">
            {{-- <form id="registrationForm" action="{{ route('register-api') }}" method="POST"> --}}
                @csrf
                <div>
                    <label for="first-name" class="block text-sm font-medium leading-5 text-gray-700">First Name</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="first-name" name="firstname" type="text" value="{{old('firstname')}}"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                  
                        @error('firstname')
                            <span class="text-red-500 text-sm">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
            
                <div class="mt-6">
                    <label for="last-name" class="block text-sm font-medium leading-5 text-gray-700">Last Name</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="last-name" name="lastname" value="{{old('lastname')}}" type="text"  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        @error('lastname')
                        <span class="text-red-500 text-sm">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
               
                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="email" name="email" type="text" value="{{old('email')}}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Password</label>
                    <div class="mt-1 rounded-md shadow-sm relative flex items-center">
                        <input id="password" name="password" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        
                        <!-- Eye icon centered vertically -->
                        <i id="toggle-password" class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></i>
                    </div>
                
                    <div id="password-requirements" class="mt-2 text-sm">
                        <ul class="grid grid-cols-2 gap-x-6">
                            <li id="lowercase" class="flex items-center text-black" style="font-size: 12px;">
                                <i class="fas fa-times-circle mr-2"></i>
                                One lowercase character
                            </li>
                            <li id="uppercase" class="flex items-center text-black" style="font-size: 12px;">
                                <i class="fas fa-times-circle mr-2"></i>
                                One uppercase character
                            </li>
                            <li id="special" class="flex items-center text-black" style="font-size: 12px;">
                                <i class="fas fa-times-circle mr-2"></i>
                                One special character
                            </li>
                            <li id="length" class="flex items-center text-black" style="font-size: 12px;">
                                <i class="fas fa-times-circle mr-2"></i>
                                8 characters minimum
                            </li>
                        </ul>
                    </div>
                </div>                

                <div class="mt-6">
                    <label for="confirm-password" class="block text-sm font-medium leading-5 text-gray-700">Confirm Password</label>
                    <div class="mt-1 rounded-md shadow-sm relative">
                        <input id="confirm-password" name="password_confirmation" type="password" 
                         class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                         <i id="toggle-confirm-password" class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer"></i>
                    </div>
                    
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
            
                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" id="create-account" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Create account
                        </button>
                    </span>
                </div>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Already have an account? 
                <a href="{{route('login')}}" class="font-medium text-blue-500 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('toggle-password');
    const passwordInputs = document.getElementById('password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const confirmPasswordInput = document.getElementById('confirm-password');

    togglePassword.addEventListener('click', function() {
        // Toggle visibility of the password field
        const type = passwordInputs.type === 'password' ? 'text' : 'password';
        passwordInputs.type = type;

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash'); // Ensure toggling between fa-eye and fa-eye-slash
        this.classList.toggle('fa-eye'); // Also toggle the fa-eye class
    });

    toggleConfirmPassword.addEventListener('click', function() {
        // Toggle visibility of the confirm password field
        const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
        confirmPasswordInput.type = type;

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash'); // Ensure toggling between fa-eye and fa-eye-slash
        this.classList.toggle('fa-eye'); // Also toggle the fa-eye class
    });

    
</script>

<script>
    const passwordInput = document.getElementById('password');
    const lowercaseRequirement = document.getElementById('lowercase');
    const uppercaseRequirement = document.getElementById('uppercase');
    const specialRequirement = document.getElementById('special');
    const lengthRequirement = document.getElementById('length');
    const createAccountButton = document.getElementById('create-account');

    function checkRequirements() {
        const password = passwordInput.value;

        const hasLowercase = /[a-z]/.test(password);
        const hasUppercase = /[A-Z]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const hasLength = password.length >= 8;

        // Update UI for each requirement
        updateRequirementUI(lowercaseRequirement, hasLowercase);
        updateRequirementUI(uppercaseRequirement, hasUppercase);
        updateRequirementUI(specialRequirement, hasSpecial);
        updateRequirementUI(lengthRequirement, hasLength);

        // Enable or disable the button based on requirements
        if (hasLowercase && hasUppercase && hasSpecial && hasLength) {
            createAccountButton.disabled = false;
            createAccountButton.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            createAccountButton.disabled = true;
            createAccountButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    function updateRequirementUI(element, isMet) {
        if (isMet) {
            element.classList.add('text-green-500');
            element.classList.remove('text-black');
        } else {
            element.classList.add('text-black');
            element.classList.remove('text-green-500');
        }
    }

    passwordInput.addEventListener('input', checkRequirements);
</script>



{{-- <script>
    $(document).ready(function() {
        let showError = true;
    
        $('#registrationForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
    
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    // Handle successful registration
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/login'; // Redirect to home or desired page
                    });

                },
                error: function(xhr) {
                    // Show validation errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        
                        // Show only the first error
                        if (showError) {
                            let firstErrorField = Object.keys(errors)[0];
                            let firstErrorMessage = errors[firstErrorField][0];
    
                            Swal.fire({
                                title: 'Error!',
                                text: firstErrorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    } else {
                        // Handle other errors
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    
      
    });
    </script> --}}
    

@include('auth.form.footer')