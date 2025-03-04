@include('admin/partials.header-css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('css/manage-tours.css') }}">
 <!-- DataTables CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}


@include('admin/partials.sidebar')
@include('admin/partials.top-content')


<div class="container-fluid">
    <div class="container">
        <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
           <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h1 class="h3 mb-0 text-muted float-start">Manage Hotel</h1>
                        {{-- <h5 class="card-title text-muted"> Total Destination <span class="text-muted fw-normal ms-2">4234</span></h5> --}}
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                   
                        <div>
                            <a href="{{ route('create-hotel') }}" class="btn  btn-sm btn-primary"><i class="bx bx-plus"></i> Add New Hotel Service</a>
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
         <div class="col-lg-12 shadow-lg p-3 mb-5 bg-body rounded">
            <div class="table-responsive bg-light p-4 shadow-sm rounded">
                <table id="destination-table" class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center text-muted">ID</th>
                            <th scope="col" class="text-center text-muted">Hotel Name</th>
                            <th scope="col" class="text-center text-muted">Room Type</th>
                            <th scope="col" class="text-center text-muted">Hotel Price</th>
                            <th scope="col" class="text-center text-muted">Hotel Capacity</th>
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
            url: '/api/view-hotel-api',  // Your API endpoint
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
                $.each(response, function(index, booking) {
                    var row = `
                        <tr class="bg-light">
                            <td class=" text-center text-muted">${booking.id}</td>
                            <td class="text-center text-muted">${booking.hotel_name}</td>
                            <td class="text-center text-muted">${booking.room_type}</td>
                            <td class="text-center text-muted">${booking.hotel_price}</td>
                            <td class="text-center text-muted">${booking.capacity}</td>
                            <td>
                                <ul class="text-center list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="/view-hotel/${booking.id}" class="btn btn-sm btn-success" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" onclick="deleteHotel(${booking.id})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="/edit-hotel/${booking.id}"  class="btn btn-sm btn-warning">
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

  // Function to handle delete action with SweetAlert confirmation
  window.deleteHotel = function(id) {
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
                        url: `/api/delete-hotel-api/${id}`,  // API endpoint for deletion
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'  // Use the same token for deletion
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Hotel deleted successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // location.reload();  // Reload the page to reflect changes
                                window.location.href = response.redirect_url; // Set the redirect URL
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

