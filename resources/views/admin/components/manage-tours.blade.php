@include('admin/partials.header-css')



@include('admin/partials.sidebar')
@include('admin/partials.top-content')


<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

  
    </div>

    
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        {{-- <h5 class="card-title text-muted"> Total Destination <span class="text-muted fw-normal ms-2"></span></h5> --}}
                        <h1 class="h3 mb-0 text-muted">Manage Tours</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                        <div>
                            <a href="{{ route('create-tours') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add Destination</a>
                        </div>
                        <div class="dropdown">
                            <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
    
         <!-- Table Section -->
         <div class="shadow-lg p-3 mb-5 bg-body rounded col-lg-12">
            <div class="table-responsive bg-light p-4 shadow-sm rounded">
                <table id="destination-table" class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center text-muted">ID</th>
                            <th scope="col" class="text-muted">Destination Name</th>
                            <th scope="col" class="text-muted">Description</th>
                            <th scope="col" class="text-muted">Price</th>
                            <th scope="col" class="text-muted">Category</th>
                            <th scope="col" class="text-center text-muted" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="destination-table-body">
                        <!-- Dynamic rows will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    
     <!-- DataTables JS -->

    @include('admin/partials.footer')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    
    $(document).ready(function() {
        
        // Fetch the data from the API
        $.ajax({
            url: '/api/view-destination-api',  // Your API endpoint
            type: 'GET',
            headers: {
                'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47' 
            },
            success: function(response) {
                var tableBody = $('#destination-table-body');
                tableBody.empty(); // Clear any existing data

                // Check if data is returned
                if (response.length === 0) {
                    tableBody.append('<tr><td colspan="6" class="text-muted text-center">No data found</td></tr>');
                    return;
                }

                // Loop through the response data and populate the table
                $.each(response, function(index, destination) {
                    var row = `
                        <tr class="bg-light">
                            <td class="text-muted text-center">${destination.id}</td>
                            <td class="text-muted">${destination.destination_name}</td>
                            <td class="text-muted">${destination.destination_description}</td>
                            <td class="text-muted">${destination.destination_price}</td>
                            <td class="text-muted">${destination.destination_category}</td>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="/destination/${destination.id}" class="btn btn-sm btn-success" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" onclick="deleteDestination(${destination.id})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="/edit-destination/${destination.id}" onclick="editDestination(${destination.id})" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> <!-- Changed to edit icon -->
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
                 // Initialize DataTable after the data is populated
                      // Initialize DataTable after populating data
                      $('#destination-table').DataTable({
                "pageLength": 5,  // Default to 5 entries per page
                "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],  // Options for the dropdown
                "language": {
            "lengthMenu": "Entries per page: _MENU_", // Customize label
        },
            });
            },
            error: function(xhr) {
                // Handle error responses
                var message = 'Error fetching data: ' + (xhr.responseJSON.message || 'An error occurred');
                alert(message);
            }
        });

        // Function to handle delete action
  // Function to handle delete action with SweetAlert confirmation
  window.deleteDestination = function(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this destination?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, proceed with the AJAX request
                    $.ajax({
                        url: `/api/delete-destination-api/${id}`,  // API endpoint for deletion
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'  // Use the same token for deletion
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Destination deleted successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();  // Reload the page to reflect changes
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'An error occurred while deleting the destination.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        };
    });
</script>


