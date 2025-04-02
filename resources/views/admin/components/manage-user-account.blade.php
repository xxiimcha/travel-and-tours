@include('admin/partials.header-css')
@include('admin/partials.sidebar')
@include('admin/partials.top-content')

<div class="container-fluid">
    <div class="container">
        <!-- Page Heading -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h1 class="h3 text-muted">Account Management</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="#" class="btn btn-sm btn-primary disabled">
                    <i class="bx bx-plus"></i> Add Account
                </a>
            </div>
        </div>

        <!-- Tabs for User and Admin Accounts -->
        <ul class="nav nav-pills mb-3" id="accountTabs">
            <li class="nav-item">
                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#userAccounts">
                    <i class="bi bi-people"></i> User Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#adminAccounts">
                    <i class="bi bi-person-badge"></i> Admin Accounts
                </a>
            </li>
        </ul>

        <div class="tab-content">

            <!-- User Accounts Tab -->
            <div class="tab-pane fade show active" id="userAccounts">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center px-4 py-3">
                        <h5 class="mb-0 text-primary"><i class="bi bi-people-fill me-2"></i> User Accounts</h5>
                        <span class="text-muted small">Showing {{ $users->count() }} users</span>
                    </div>
                    <div class="card-body bg-light rounded-bottom px-4 py-4">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-bordered table-hover table-striped align-middle mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>User ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Password</th>
                                        <th style="width: 180px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ substr($user->uuid, 0, 12) }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ str_repeat('*', 10) }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-success" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Accounts Tab -->
            <div class="tab-pane fade" id="adminAccounts">
                <div class="card border-0 shadow-sm rounded-4 mt-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center px-4 py-3">
                        <h5 class="mb-0 text-secondary"><i class="bi bi-person-badge-fill me-2"></i> Admin Accounts</h5>
                        <span class="text-muted small">Showing {{ $admins->count() }} admins</span>
                    </div>
                    <div class="card-body bg-light rounded-bottom px-4 py-4">
                        <div class="table-responsive">
                            <table id="adminTable" class="table table-bordered table-hover table-striped align-middle mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Admin ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Password</th>
                                        <th style="width: 180px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td class="text-center">{{ substr($admin->uuid, 0, 12) }}</td>
                                        <td>{{ $admin->firstname }}</td>
                                        <td>{{ $admin->lastname }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ str_repeat('*', 10) }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-success" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete({{ $admin->id }})" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End of Tab Content -->
    </div>
</div>

@include('admin/partials.footer')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#userTable, #adminTable').DataTable({
            pageLength: 5,
            lengthChange: false,
            ordering: true,
            info: false
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/delete-account/" + id;
            }
        });
    }
</script>

<!-- Optional Styling (can go to your CSS file) -->
<style>
    .card-header h5 {
        font-weight: 600;
    }

    .table > thead > tr > th {
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table > tbody > tr > td {
        vertical-align: middle;
        font-size: 0.92rem;
    }

    .card-body.bg-light {
        background-color: #f9fbfc !important;
    }
</style>
    