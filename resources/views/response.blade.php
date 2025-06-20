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

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="d-flex my-xl-auto justify-content-end pb-3">
                            <div class="dropdown ms-2">
                                <select id="selectedSurvey" class="form-select">
                                    <option value="">Select Survey</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h4 class="page-title">Response List</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="board">
                    <div class="tasks" data-plugin="dragula"
                        data-containers='["task-list-one", "task-list-two", "task-list-three", "task-list-four"]'>
                        <h5 class="mt-0 task-header">Response list</h5>

                        <div id="task-list-one" class="task-list-items">

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-danger-subtle text-danger">High</span>
                                    <small class="text-muted">18 Jul 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">iOS App home page</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            iOS
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>74</b> Comments
                                        </span>
                                    </p>

                                    {{-- <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Leave</a>
                                        </div>
                                    </div> --}}

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-3.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hooker">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-bg-success">
                                                    K
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="More +">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle">
                                                    9+
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                        </div> <!-- end company-list-1-->
                    </div>

                    <div class="tasks">
                        <h5 class="mt-0 task-header text-uppercase">In Progress (2)</h5>

                        <div id="task-list-two" class="task-list-items">

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-warning-subtle text-warning">Medium</span>
                                    <small class="text-muted">22 Jun 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Write a release note</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            EOM
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>17</b> Comments
                                        </span>
                                    </p>

                                    <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Survey Details</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Location</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Audio</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Question</a>
                                        </div>
                                    </div>

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-7.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-8.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                        </div> <!-- end company-list-2-->
                    </div>


                    <div class="tasks">
                        <h5 class="mt-0 task-header text-uppercase">Review (4)</h5>
                        <div id="task-list-three" class="task-list-items">

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-danger-subtle text-danger">High</span>
                                    <small class="text-muted">2 May 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Kanban board design</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            CRM
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>65</b> Comments
                                        </span>
                                    </p>

                                    <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Leave</a>
                                        </div>
                                    </div>

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-4.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hooker">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-bg-light">
                                                    D
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-warning-subtle text-warning">Medium</span>
                                    <small class="text-muted">7 May 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Code HTML email template</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            CRM
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>106</b> Comments
                                        </span>
                                    </p>

                                    <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Leave</a>
                                        </div>
                                    </div>

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-10.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-5.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-warning-subtle text-warning">Medium</span>
                                    <small class="text-muted">8 Jul 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Brand logo design</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            Design
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>95</b> Comments
                                        </span>
                                    </p>

                                    <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Leave</a>
                                        </div>
                                    </div>

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hooker">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-bg-primary">
                                                    M
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hooker">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-bg-info">
                                                    A
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-danger-subtle text-danger">High</span>
                                    <small class="text-muted">22 Jul 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Improve animation loader</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            CRM
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>39</b> Comments
                                        </span>
                                    </p>

                                    <div class="dropdown float-end mt-2">
                                        <a href="#" class="dropdown-toggle text-muted arrow-none"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-18"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-edit-box-line me-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-delete-bin-line me-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-user-add-line me-1"></i>Add People</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i
                                                    class="ri-logout-circle-line me-1"></i>Leave</a>
                                        </div>
                                    </div>

                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-2.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-4.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                        </div> <!-- end company-list-3-->
                    </div>

                    <div class="tasks">
                        <h5 class="mt-0 task-header text-uppercase">Complete</h5>
                        <div id="task-list-four" class="task-list-items">

                            <!-- Task Item -->
                            <div class="card mb-0">
                                <div class="card-body p-3">
                                    <span class="float-end badge bg-success-subtle text-success">Low</span>
                                    <small class="text-muted">16 Jul 2023</small>

                                    <h5 class="my-2 fs-16">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal"
                                            class="text-body">Dashboard design</a>
                                    </h5>

                                    <p class="mb-0">
                                        <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                            <i class="ri-briefcase-2-line text-muted"></i>
                                            EOM
                                        </span>
                                        <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="ri-discuss-line text-muted"></i>
                                            <b>287</b> Comments
                                        </span>
                                    </p>
                                    
                                    <div class="avatar-group mt-2">
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-1.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brain">
                                            <img src="assets/images/users/avatar-3.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tosha">
                                            <img src="assets/images/users/avatar-8.jpg" alt=""
                                                class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Hooker">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle text-bg-danger">
                                                    K
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- Task Item End -->

                        </div> <!-- end company-list-4-->
                    </div>

                </div> <!-- end .board-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div>

<!-- content -->



@include('layouts.footer')


<!-- Datatables js -->
<script src="assets/vendor/dragula/dragula.min.js"></script>
<script src="assets/js/pages/component.dragula.js"></script>
<!-- App js -->
</body>

</html>