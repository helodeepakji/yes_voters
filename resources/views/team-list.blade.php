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
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        cursor: default;
        padding-left: 2px;
        padding-right: 5px;
        color: black;
    }
</style>

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
                <h2 class="mb-1">Team List</h2>
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Team
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Team List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
                <div class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_team"
                        class="btn btn-primary d-flex align-items-center"><i class="ri-add-circle-line mx-1"></i>Create
                        Team</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3 pe-0  ps-0">
                            <h4 class="header-title">Team List</h4>
                            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                                <div class="dropdown ms-2">
                                    <select id="selectedTeam" class="form-select">
                                        <option value="">Select Team</option>
                                        @foreach ($team as $item)
                                            <option value="{{$item->id}}">{{$item->team_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Team Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Team Size</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                @php $i = 0; @endphp
                                @foreach ($members as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <img src="{{ $item->profile ? asset('storage/' . $item->profile) : asset('assets/images/users/avatar-1.jpg') }}"
                                                        alt="user-logo" width="32" class="rounded-circle">
                                                </div>
                                                <div class="col-8">
                                                    {{$item->name}}
                                                    <br>
                                                    <span
                                                        class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                                        <i class="ti ti-point-filled me-1"></i>{{$item->role->role_name}}
                                                    </span>
                                                    @if ($item->is_team_leader == 1)
                                                        <span
                                                            class="badge badge-success d-inline-flex align-items-center badge-xs">
                                                            <i class="ti ti-point-filled me-1"></i> Leader
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->team->team_name}}</td>
                                        <td>{{ $item->phone }} </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->team->users_count ?? 0 }}</td>
                                        <td>
                                            <i class="ri-eye-fill cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#view_team"
                                                onclick="getTeamDetails({{ $item->team->id}})"></i>
                                            <i class="ms-2 ri-delete-bin-line cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#delete_modal"
                                                onclick="deleteTeam({{ $item->team->id }})"></i>
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


<!-- Add Team -->
<div class="modal fade" id="add_team">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Team</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/team-list" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Team Name</label>
                                <input type="text" class="form-control" name="team_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Team Leader</label>
                                <select class="form-control" name="team_leader_id" id="team_leader_id" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->role->role_name}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Team</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Team -->

<!-- view Team -->
<div class="modal fade" id="view_team">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Team</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/team-update" method="post">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Team Name</label>
                                <input type="text" class="form-control" name="team_name" id="team_name" required>
                                <input type="hidden" name="team_id" value="" id="team_id_edit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-12">
                                <label class="form-label">Team Leader</label>
                                <select class="form-control" name="team_leader_id" id="edit_team_leader_id" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->role->role_name}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Team Members</label>
                                <select class="form-control select2" name="team_member[]" id="team_member" multiple>
                                    <option value="">Select User</option>
                                    @foreach ($teamMember as $item)
                                        <option value="{{$item->id}}">{{$item->name}} ({{$item->role->role_name}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Team</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /view Team -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this Team, Make all Members is resets, This cant be undone
                    once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="getDelete()" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->



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
<script>
    function getDelete() {
        var id = $('#team_id_edit').val();
        window.location.href = '/team-delete/' + id;
    }

    function deleteTeam(id) {
        $('#team_id_edit').val(id);
    }

    function getTeamDetails(team_id) {
        $('#team_id_edit').val(team_id);
        if (team_id) {
            $.ajax({
                url: '/api/getTeamLeaderDetails/' + team_id,
                method: 'GET',
                success: function (response) {
                    const $teamMemberSelect = $('#team_member');
                    const $statesSelect = $('#edit_states');

                    const selectedMembers = response.members
                        .filter(member => member.is_team_leader === 0)
                        .map(member => member.id);
                    $teamMemberSelect.val(selectedMembers).trigger('change');

                    const selectedStates = response.states;
                    $statesSelect.val(selectedStates).trigger('change');

                    if (response.leader && response.leader.id) {
                        $('#edit_team_leader_id').val(response.leader.id);
                    } else {
                        $('#edit_team_leader_id').val('');
                        console.warn('No leader found for this team');
                    }

                    $('#team_name').val(response.team_name);
                }
            });
        } else {
            notyf.success('Team Leader is Required.');
        }

    }

    $(document).ready(function () {

        $('#selectedTeam').on('change', function () {
            fetchFilteredData();
        });

        function fetchFilteredData() {
            const team_id = $('#selectedTeam').val();

            if (team_id !== '') {
                $('#table_body').html('<tr><td colspan="9" class="text-center">Loading...</td></tr>');

                $.ajax({
                    url: '/api/getMembersByTeam/' + team_id,
                    method: 'GET',
                    success: function (response) {
                        if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
                            let table = $('#datatable-buttons').DataTable();
                            table.destroy();
                        }

                        let rows = '';

                        response.forEach((item, index) => {
                            let profile = item.profile ? `/storage/${item.profile}` : '/assets/images/users/avatar-1.jpg';
                            let companyLogo = item.company?.logo ? `/storage/${item.company.logo}` : '/assets/images/buildings.png';
                            let roleName = item.role?.role_name ?? 'N/A';
                            let teamName = item.team?.name ?? '-';
                            let phone = item.phone ?? '-';
                            let email = item.email ?? '-';
                            let companyName = item.company?.company_name ?? '-';
                            let leadsCount = item.leads_count ?? '0';
                            let companyId = item.company_id;
                            let teamId = item.team?.id ?? '';

                            rows += `<tr>
                                <td>${index + 1}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="${profile}" alt="user-profile" width="32" class="rounded-circle">
                                        </div>
                                        <div class="col-8">
                                            ${item.name}<br>
                                            <span class="badge badge-danger d-inline-flex align-items-center badge-xs">
                                                <i class="ti ti-point-filled me-1"></i>${roleName}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>${teamName}</td>
                                <td>${phone}<br>${email}</td>
                                <td>
                                    <img src="${companyLogo}" alt="company-logo" width="32" class="rounded-circle me-2">
                                    ${companyName}
                                </td>
                                <td>${leadsCount}</td>
                                <td>
                                    <i class="ri-eye-fill cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#view_team"
                                        onclick="getTeamLeaderByCompany(${companyId}, '${teamId}')"></i>
                                    <i class="ms-2 ri-delete-bin-line cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#delete_modal"
                                        onclick="deleteTeam(${teamId})"></i>
                                </td>
                            </tr>`;
                        });

                        $('#table_body').html(rows);

                        $('#datatable-buttons').DataTable({
                            lengthChange: true,
                            buttons: ["copy", "csv", "print"],
                            destroy: true,
                            language: {
                                paginate: {
                                    previous: "<i class='ri-arrow-left-s-line'></i>",
                                    next: "<i class='ri-arrow-right-s-line'></i>"
                                }
                            },
                            drawCallback: function () {
                                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                            }
                        }).buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                    },
                    error: function () {
                        alert('Error fetching data.');
                    }
                });
            }
        }

    });

    $('#view_team').on('shown.bs.modal', function () {
        $('#team_member').select2({
            dropdownParent: $('#view_team'),
            placeholder: 'Select User',
            width: '100%'
        });

        $('#edit_states').select2({
            dropdownParent: $('#view_team'),
            placeholder: 'Select States',
            width: '100%'
        });
    });

    $('#add_team').on('shown.bs.modal', function () {
        const $stateSelect = $('#states');
        $stateSelect.select2({
            dropdownParent: $('#add_team'),
            placeholder: 'Select States',
            width: '100%'
        });

        $('#team_leader_id').on('change', function () {
            const company_id = $('#companyIds').val();
            if (company_id) {
                $.ajax({
                    url: '/api/getStateFromLead/' + company_id,
                    method: 'GET',
                    success: function (response) {
                        $stateSelect.empty().append(`<option value="">Select States</option>`);
                        response.forEach((state) => {
                            $stateSelect.append(`<option value="${state}">${state}</option>`);
                        });
                        $stateSelect.trigger('change');
                    }
                });
            } else {
                $stateSelect.html(`<option value="">Select States</option>`);
                $stateSelect.trigger('change');
            }
        });
    });
</script>

</body>

</html>