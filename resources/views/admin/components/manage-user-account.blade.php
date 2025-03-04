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
                <table id="userTable" class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center text-muted">User ID:</th>
                            <th scope="col" class="text-muted">First Name:</th>
                            <th scope="col" class="text-muted">Last Name:</th>
                            <th scope="col" class="text-muted">Email Address:</th>
                            <th scope="col" class="text-muted">Password:</th>
                            <th scope="col" class="text-center text-muted" style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        <!-- Dynamic rows will be appended here -->
           
                            @foreach ($data as $user )
                            <tr class="bg-light">
                                <td class="text-muted text-center">{{ substr($user->uuid, 0, 12) }}</td>

                            <td class="text-muted">{{$user->firstname}}</td>
                            <td class="text-muted">{{$user->lastname}}</td>
                            <td class="text-muted">{{$user->email}}</td>
                            <td class="text-muted">{{ substr($user->password, 0, 8) . '******' }}</td>

                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="" class="btn btn-sm btn-success" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" onclick="" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" onclick="" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> <!-- Changed to edit icon -->
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
    </div>
@include('admin/partials.footer')
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

