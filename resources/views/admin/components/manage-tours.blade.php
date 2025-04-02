@include('admin/partials.header-css')
@include('admin/partials.sidebar')
@include('admin/partials.top-content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h1 class="h3 text-muted">Manage Tours</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('create-tours') }}" class="btn btn-sm btn-primary">
                    <i class="bx bx-plus"></i> Add Destination
                </a>
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </button>
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
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="destination-table" class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Destination Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="destination-table-body">
                        <!-- Rows populated via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin/partials.footer')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/api/view-destination-api',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
            },
            success: function (response) {
                const tableBody = $('#destination-table-body');
                tableBody.empty();

                if (response.length === 0) {
                    tableBody.append('<tr><td colspan="6" class="text-center text-muted">No data found</td></tr>');
                    return;
                }

                $.each(response, function (index, destination) {
                    const row = `
                        <tr>
                            <td class="text-center text-muted">${destination.id}</td>
                            <td class="text-muted">${destination.destination_name}</td>
                            <td class="text-muted">${destination.destination_description}</td>
                            <td class="text-muted">₱ ${new Intl.NumberFormat('en-PH', { minimumFractionDigits: 2 }).format(destination.destination_price)}</td>
                            <td class="text-muted">${destination.destination_category}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="/destination/${destination.id}" class="btn btn-sm btn-success" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" onclick="deleteDestination(${destination.id})" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="/edit-destination/${destination.id}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                    tableBody.append(row);
                });

                $('#destination-table').DataTable({
                    pageLength: 5,
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                    language: {
                        lengthMenu: "Entries per page: _MENU_"
                    }
                });
            },
            error: function (xhr) {
                alert('Error fetching data: ' + (xhr.responseJSON.message || 'An error occurred'));
            }
        });

        window.deleteDestination = function (id) {
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
                    $.ajax({
                        url: `/api/delete-destination-api/${id}`,
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer 7|DYYr2BONWW9HXLbuYaXpWhZEJ9wmiaH5JpB9EpGr9170ee47'
                        },
                        success: function () {
                            Swal.fire('Deleted!', 'Destination deleted successfully.', 'success')
                                .then(() => location.reload());
                        },
                        error: function (xhr) {
                            Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting.', 'error');
                        }
                    });
                }
            });
        };
    });
</script>
