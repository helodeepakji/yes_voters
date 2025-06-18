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
                <h2 class="mb-1">Role List</h2>
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            User
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                <div class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_role"
                        class="btn btn-primary d-flex align-items-center"><i class="ri-add-circle-line mx-1"></i>Add
                        Role</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Role List</h4>

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Role Name</th>
                                    <th>Total People</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            <tbody id="table_body">
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            {{$item->role_name}}
                                        </td>
                                        <td>{{$item->users_count }}</td>
                                        <td>

                                            <a href="#edit_role" data-bs-toggle="modal" data-bs-target="#edit_role" onclick="getRole({{$item->id}})">
                                                <i class="ri-pencil-fill cursor-pointer"></i> </a>

                                            <a href="#delete_modal" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="getDeleteRole({{$item->id}})">
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

<!-- Add Role -->
<div class="modal fade" id="add_role">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Role</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/role-list" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role_name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Role -->

<!-- Edit Role -->
<div class="modal fade" id="edit_role">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Role</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/role-edit" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role_name" id="role_name" required>
                                <input type="hidden" name="id" id="role_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Edit Role -->


<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this role, this cant be undone once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="getDelete()" id="btn-role-id" class="btn btn-danger">Yes, Delete</a>
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

    function getDeleteRole(id){
        $('#btn-role-id').data('role-id',id);
    }


    function getRole(id){
        $.ajax({
            url : '/api/getRole/'+id,
            type : 'GET',
            dataType : 'json',
            success : function(response){
                $('#role_name').val(response.role_name);
                $('#role_id').val(response.id);    
            }
        });
    }

    function getDelete(){
        var id = $('#btn-role-id').data('role-id');
        window.location.href = '/delete-role/'+id;
    }

</script>
</body>

</html>