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
                    <h1 class="h3 mb-0 text-muted">Account Management</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <a href="{{ route('create-account') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-plus"></i> Add Account
                        </a>
                    </div>
                </div>
            </div>
        </div> 

        <!-- Tabs for User and Admin Accounts -->
        <ul class="nav nav-tabs" id="accountTabs">
            <li class="nav-item">
                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#userAccounts">User Accounts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#adminAccounts">Admin Accounts</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- User Accounts Tab -->
            <div class="tab-pane fade show active" id="userAccounts">
                <div class="shadow-lg p-3 mb-5 bg-body rounded col-lg-12">
                    <div class="table-responsive bg-light p-4 shadow-sm rounded">
                        <table id="userTable" class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center text-muted">User ID</th>
                                    <th class="text-muted">First Name</th>
                                    <th class="text-muted">Last Name</th>
                                    <th class="text-muted">Email Address</th>
                                    <th class="text-muted">Password</th>
                                    <th class="text-center text-muted" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="bg-light">
                                    <td class="text-muted text-center">{{ substr($user->uuid, 0, 12) }}</td>
                                    <td class="text-muted">{{$user->firstname}}</td>
                                    <td class="text-muted">{{$user->lastname}}</td>
                                    <td class="text-muted">{{$user->email}}</td>
                                    <td class="text-muted">{{ str_repeat('*', 10) }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ route('view-account', $user->id) }}" class="btn btn-sm btn-success" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('edit-account', $user->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" onclick="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>             
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Admin Accounts Tab -->
            <div class="tab-pane fade" id="adminAccounts">
                <div class="shadow-lg p-3 mb-5 bg-body rounded col-lg-12">
                    <div class="table-responsive bg-light p-4 shadow-sm rounded">
                        <table id="adminTable" class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center text-muted">Admin ID</th>
                                    <th class="text-muted">First Name</th>
                                    <th class="text-muted">Last Name</th>
                                    <th class="text-muted">Email Address</th>
                                    <th class="text-muted">Password</th>
                                    <th class="text-center text-muted" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr class="bg-light">
                                    <td class="text-muted text-center">{{ substr($admin->uuid, 0, 12) }}</td>
                                    <td class="text-muted">{{$admin->firstname}}</td>
                                    <td class="text-muted">{{$admin->lastname}}</td>
                                    <td class="text-muted">{{$admin->email}}</td>
                                    <td class="text-muted">{{ str_repeat('*', 10) }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ route('view-account', $admin->id) }}" class="btn btn-sm btn-success" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('edit-account', $admin->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" onclick="confirmDelete({{ $admin->id }})" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>             
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- End of Tab Content -->
    </div>
</div>

@include('admin/partials.footer')

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#userTable, #adminTable').DataTable();
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
