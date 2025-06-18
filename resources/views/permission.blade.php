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
<link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
@include('layouts.menu')


<div class="content">
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3 mt-3">
            <div class="my-auto mb-2">
                <h2 class="mb-1">Permission</h2>
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Settings
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permission List</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div
                            class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3 pe-0  ps-0">
                            <h4 class="header-title">Pages List</h4>
                            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                                <div class="dropdown">
                                    <select id="role_id" class="form-select">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $item)
                                            <option value="{{$item->id}}">{{$item->role_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table id="" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Page Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($pages as $item)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            {{$item->name}}
                                        </td>
                                        <td>
                                            <input data-id="{{$item->id}}" data-slug="{{$item->slug}}"
                                                class="toggle_btn_page" type="checkbox" data-on="Allow" data-off="Not Allow"
                                                data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
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
</div>


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
<script src="assets/js/bootstrap-toggle.min.js"></script>
<script>
    var flag = 1;
    $(document).ready(function () {
        $('#role_id').change(() => {
            var role_id = $('#role_id').val();
            flag = 0;
            if (role_id != '') {
                $.ajax({
                    url: '/api/authentication/' + role_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $('.toggle_btn_page').each(function () {
                            var page_id = $(this).data('id');
                            var hasAccess = response.some(page => page.id === page_id && page.access === 1);
                            $(this).prop('checked', hasAccess).change();
                        });

                        notyf.success("Permissions loaded successfully.");
                        flag = 1;
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "Something went wrong.";
                        notyf.error(errorMessage);
                        flag = 1;
                    }
                });
            } else {
                $('.toggle_btn_page').each(function () {
                    var hasAccess = 0;
                    $(this).prop('checked', hasAccess).change();
                });
                flag = 1;
            }
        });

    });


    $('.toggle_btn_page').on('change', function () {
        var role_id = $('#role_id').val();

        if (flag == 1) {
            if (role_id == '') {
                $(this).prop('checked', false);
                notyf.error('Select Role First.');
                return;
            }

            var dataId = $(this).data('id');
            if ($(this).prop('checked')) {
                $.ajax({
                    url: '/api/giveAccessPage/' + role_id,
                    type: 'POST',
                    data: {
                        page_id: dataId,
                        role_id: 1,
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('#toggle-trigger').prop('checked', false).change()
                        notyf.success(response.message);
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "Something went wrong.";
                        notyf.error(errorMessage);
                    }
                });
            }
        }
    });
</script>
</body>

</html>