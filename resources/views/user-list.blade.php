@include('layouts.main')
<!-- Daterangepicker css -->
<link href="assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet"
    type="text/css" />
<link href="assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
</head>

@include('layouts.menu')

<!-- content -->

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif

        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3 mt-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">User List</h2>
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            User
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                <div class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_user"
                        class="btn btn-primary d-flex align-items-center"><i class="ri-add-circle-line mx-1"></i>Add
                        User</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">User List</h4>

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                @foreach ($users as $item)
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src="/assets/images/users/avatar-1.jpg" alt="company-logo"
                                                        width="32" class="rounded-circle">
                                                </div>
                                                <div class="col-8">
                                                    {{$item->name}}
                                                    <br>
                                                    <span
                                                        class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                                        <i class="ti ti-point-filled me-1"></i>{{$item->role->role_name}}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ucfirst($item->gender)}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>

                                            <a href="#edit_user" onclick="getUser({{$item->id}})" data-bs-toggle="modal"
                                                data-bs-target="#edit_user">
                                                <i class="ri-pencil-fill cursor-pointer"></i> </a>

                                            <a href="#delete_modal" data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                onclick="getDelete({{$item->id}})">
                                                <i class="ms-2 ri-delete-bin-line cursor-pointer" data-bs-toggle="modal"
                                                    data-bs-target="#delete_modal"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->

    </div>
    <!-- container -->

</div>

<!-- Add User -->
<div class="modal fade" id="add_user">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/user-list" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Phone No.</label>
                                <input type="number" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Role</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach ($role as $item)
                                        <option value="{{$item->id}}">{{$item->role_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add User -->

<!-- Update User -->
<div class="modal fade" id="edit_user">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/user-update" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" required>
                                <input type="hidden" class="form-control" name="user_id" id="user_id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Phone No.</label>
                                <input type="number" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Role</label>
                                <select name="role_id" id="edit_role_id" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach ($role as $item)
                                        <option value="{{$item->id}}">{{$item->role_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Update User -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this user, this cant be undone once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="deleteUser()" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->


<!-- content -->



@include('layouts.footer')


<!-- Datatables js -->
<script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="assets/js/pages/demo.datatable-init.js"></script>
<!-- App js -->
<script>


    function getUser(id) {
        $.ajax({
            url: '/api/getUser/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#full_name').val(response.name);
                $('#edit_role_id').val(response.role_id);
                $('#user_id').val(response.id);
                $('#phone').val(response.phone);
                $('#email').val(response.email);
                $('#gender').val(response.gender);
            }
        });
    }

    function getDelete(id) {
        $('#user_id').val(id);
    }

    function deleteUser() {
        var id = $('#user_id').val();
        window.location.href = '/delete-user/' + id;
    }

</script>
</body>

</html>