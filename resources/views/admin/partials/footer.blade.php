
     
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white shadow">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->

   



    </div>
    <!-- Bootstrap 5 JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src=" {{ asset('vendor/jquery/jquery.min.js') }} "></script>
    <script src=" {{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src=" {{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom scripts for all pages-->
    <script src=" {{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src=" {{ asset('vendor/chart.js/Chart.min.js') }}"></script>

   
    <script src=" {{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->  
    <script src=" {{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const manageToursLink = document.querySelector('[data-target="#manageToursDropdown"]');
    const manageToursIcon = document.getElementById('manageToursIcon');

    manageToursLink.addEventListener('click', () => {
        const isExpanded = manageToursLink.getAttribute('aria-expanded') === 'true';
        manageToursIcon.classList.toggle('bi-chevron-down', !isExpanded);
        manageToursIcon.classList.toggle('bi-chevron-up', isExpanded);
    });
});

    </script>
 <!-- jQuery Script -->
<script>
    $(document).ready(function() {
        $('#createBookingDetails').on('click', function() {
            // Toggle visibility of hotel details
            $('#hotelDetails').toggle(); // Show/hide hotel details
            // Change the icon direction
            $('#createArrow').toggleClass('bi-chevron-down bi-chevron-up');
        });
    });


    
</script>

<script>
      document.getElementById('searchBar').addEventListener('input', function () {
        var searchQuery = this.value.toLowerCase().trim();  // Get the search query and trim extra spaces
        var sidebarLinks = document.querySelectorAll('.navbar-nav .collapse-item');
        var searchResultsContainer = document.getElementById('searchResults');
        
        // Clear previous results
        searchResultsContainer.innerHTML = '';

        // Hide results if the search box is empty
        if (searchQuery === '') {
            searchResultsContainer.style.display = 'none';
            return;
        }
        
        var resultsFound = false;
        
        // Loop through all sidebar links and check if they contain the search query
        sidebarLinks.forEach(function(link) {
            var linkText = link.textContent.toLowerCase();  // Get the link text in lowercase
            var linkHref = link.getAttribute('href');  // Get the link's href
            
            // Check if the link text matches the search query
            if (linkText.includes(searchQuery)) {
                var resultItem = document.createElement('a');
                resultItem.href = linkHref;
                resultItem.classList.add('dropdown-item');
                resultItem.textContent = link.textContent;  // Use the link's text for the result
                searchResultsContainer.appendChild(resultItem);  // Append the result to the container
                resultsFound = true;
            }
        });
        
        // Show or hide the search results container
        if (resultsFound) {
            searchResultsContainer.style.display = 'block';  // Show if results are found
        } else {
            searchResultsContainer.style.display = 'none';  // Hide if no results
        }
    });

</script>

</body>

</html>