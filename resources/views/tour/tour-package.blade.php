<div class="flex flex-col md:flex-row">
        <!-- Toggle Button -->

    <!-- Sidebar -->
    <aside id="filter-sidebar" class="w-full md:w-64 bg-gray-100 h-auto md:h-screen p-5 shadow-lg md:block">
        <h2 class="text-lg font-bold mb-4">Filters</h2>
        
        <div class="mb-5">
            <h3 class="font-semibold">Search</h3>
            <input type="text" class="border border-gray-300 rounded-md px-3 py-2 mt-2 w-full" placeholder="Search...">
        </div>

        <div class="mb-5">
            <h3 class="font-semibold">Destination</h3>
            <ul class="mt-2">

                @foreach ($destination as $destination )
                <li class="my-1">
                    <a href="#" class="block p-2 hover:bg-blue-600 hover:text-white rounded">
                        {{$destination->destination}}
                    </a>
                </li>
                
                @endforeach        
            </ul>
        </div>

        <div>
            <h3 class="font-semibold">Duration Day</h3>
            <ul class="mt-2 grid grid-cols-2 gap-2">
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">1 Day</a>
                </li>   
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">2 Days</a>
                </li>               
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">3 Days</a>
                </li>         
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">4 Days</a>
                </li>         
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">5 Days</a>
                </li>         
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">6 Days</a>
                </li>         
                <li>
                    <a href="#" class="block p-2 bg-gray-100 hover:bg-blue-600 hover:text-white rounded text-left">7 Days</a>
                </li>         
            </ul>
            
            
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-5">
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
            <div class="border-b mb-5 flex flex-col md:flex-row justify-between text-sm">
                <!-- Title and Icon Section -->
                <div class="text-indigo-600 flex items-center pb-2 pr-2 border-b-2 border-indigo-600 uppercase mb-4 md:mb-0">
                    <svg class="h-6 mr-3" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 455.005 455.005"
                        style="enable-background:new 0 0 455.005 455.005;" xml:space="preserve">
                        <g>
                            <path d="M446.158,267.615c-5.622-3.103-12.756-2.421-19.574,1.871l-125.947,79.309c-3.505,2.208-4.557,6.838-2.35,10.343 c2.208,3.505,6.838,4.557,10.343,2.35l125.947-79.309c2.66-1.675,4.116-1.552,4.331-1.432c0.218,0.12,1.096,1.285,1.096,4.428 c0,8.449-6.271,19.809-13.42,24.311l-122.099,76.885c-6.492,4.088-12.427,5.212-16.284,3.084c-3.856-2.129-6.067-7.75-6.067-15.423 c0-19.438,13.896-44.61,30.345-54.967l139.023-87.542c2.181-1.373,3.503-3.77,3.503-6.347s-1.323-4.974-3.503-6.347L184.368,50.615 c-2.442-1.538-5.551-1.538-7.993,0L35.66,139.223C15.664,151.815,0,180.188,0,203.818v4c0,23.63,15.664,52.004,35.66,64.595 l209.292,131.791c3.505,2.207,8.136,1.154,10.343-2.35c2.207-3.505,1.155-8.136-2.35-10.343L43.653,259.72 C28.121,249.941,15,226.172,15,207.818v-4c0-18.354,13.121-42.122,28.653-51.902l136.718-86.091l253.059,159.35l-128.944,81.196 c-20.945,13.189-37.352,42.909-37.352,67.661c0,13.495,4.907,23.636,13.818,28.555c3.579,1.976,7.526,2.956,11.709,2.956 c6.231,0,12.985-2.176,19.817-6.479l122.099-76.885c11.455-7.213,20.427-23.467,20.427-37.004 C455.004,277.119,451.78,270.719,446.158,267.615z"> </path>
                            <path d="M353.664,232.676c2.492,0,4.928-1.241,6.354-3.504c2.207-3.505,1.155-8.136-2.35-10.343l-173.3-109.126 c-3.506-2.207-8.136-1.154-10.343,2.35c-2.207,3.505-1.155,8.136,2.35,10.343l173.3,109.126 C350.916,232.303,352.298,232.676,353.664,232.676z"> </path>
                            <path d="M323.68,252.58c2.497,0,4.938-1.246,6.361-3.517c2.201-3.509,1.14-8.138-2.37-10.338L254.46,192.82 c-3.511-2.202-8.139-1.139-10.338,2.37c-2.201,3.51-1.14,8.138,2.37,10.338l73.211,45.905 C320.941,252.21,322.318,252.58,323.68,252.58z"> </path>
                            <path d="M223.903,212.559c-3.513-2.194-8.14-1.124-10.334,2.39c-2.194,3.514-1.124,8.14,2.39,10.334l73.773,46.062 c1.236,0.771,2.608,1.139,3.965,1.139c2.501,0,4.947-1.251,6.369-3.529c2.194-3.514,1.124-8.14-2.39-10.334L223.903,212.559z"> </path>
                            <path d="M145.209,129.33l-62.33,39.254c-2.187,1.377-3.511,3.783-3.503,6.368s1.345,4.983,3.54,6.348l74.335,46.219 c1.213,0.754,2.586,1.131,3.96,1.131c1.417,0,2.833-0.401,4.071-1.201l16.556-10.7c3.479-2.249,4.476-6.891,2.226-10.37L145.209,129.33z"> </path>
                        </g>
                    </svg>
                    <h2 class="text-lg font-bold">Tour Packages</h2>
                </div>
                <!-- Filter Section -->
                {{-- <div class="flex flex-col md:flex-row items-center">
                    <label for="filter-options" class="mr-2 text-gray-700">Select Filter:</label>
                    <select id="filter-options" class="bg-indigo-600 text-white px-4 py-2 rounded mt-2 md:mt-0">
                        <option value="all">All Tours</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="duration">Education Tour</option>
                        <option value="popularity">Corporate Incentive Tour</option>
                        <option value="popularity">Cruise Tour</option>
                        <option value="popularity">Day Tour</option>
                        <option value="popularity">Scenic Tour</option>
                        <option value="popularity">Wildlife Tours</option>
                        <option value="popularity">Special Interest Tours</option>
                        <option value="popularity">Group Tours</option>
                        <option value="popularity">Factory Tours</option>
                        <option value="popularity">Golf Tours</option>
                        <option value="popularity">Scuba Diving</option>
                        <option value="popularity">Snorkeling</option>
                        <option value="popularity">Fishing Packages</option>
                        <option value="popularity">Trekking Tours</option> 
                    </select>
                </div> --}}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($data as $tours)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">
                    @if ($tours->first_image)
                        <img src="{{ asset('destination-images/' . $tours->first_image) }}" alt="Package Image" class="w-full h-40 object-cover">
                    @else
                        <p>No image available</p>
                    @endif
                    
                    <!-- Price in the top-right corner of the image -->
                    <div class="absolute top-2 right-2 bg-blue-500 text-white font-medium px-2 py-1 text-sm rounded-md">
                        PHP {{ number_format($tours->destination_price) }}
                    </div>                   
            
                    <div class="p-5">
                        <h3 class="text-lg font-semibold">{{ $tours->destination_name }}</h3>
                        <p class="text-gray-700">
                            {{ Str::limit($tours->destination_description, 120) }}
                        </p>
                        <a href="{{route('view-details',$tours->id)}}" class="bg-blue-500 text-white rounded px-3 py-1 text-sm inline-block">
                            View Details
                        </a>
                        
                    </div>           
                </div>
            @endforeach
            
        </div>
        
    </main>
</div>
<div>
    <div class="mt-4">
        <div class="flex justify-center space-x-1">
            {{ $data->links('pagination::simple-tailwind') }}
        </div>
    </div>
    
</div>

