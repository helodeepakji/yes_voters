@include('layouts.main')
<!-- Daterangepicker css -->
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
    type="text/css" />
</head>

@include('layouts.menu')
<style>
    table.dataTable td {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: 150px;
    }
</style>

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
                @if ($question)
                    <h2 class="mb-1">{{$question->title}}</h2>
                @else
                    <h2 class="mb-1">Surveys List</h2>
                @endif
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Surveys
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Question List</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div
                            class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3 pe-0  ps-0">
                            <h4 class="header-title">Question List</h4>
                            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                                <div class="dropdown ms-2">
                                    <select id="selectedSurvey" class="form-select">
                                        <option value="">Select Survey</option>
                                        @foreach ($surveys as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Question</th>
                                    <th>Type</th>
                                    <th>Option</th>
                                    <th>Status</th>
                                    @if (auth()->user()->authorizedPages->contains('slug', 'survey-question-action') || auth()->user()->role_id == 1)
                                        <th></th>
                                    @endif
                                </tr>
                            </thead>
                            @php
                                $i = 0;
                                if ($question) {
                                    $status = $question->is_active;
                                }
                            @endphp
                            <tbody id="table_body">
                                @if ($question)

                                    @if ($question->questions && $question->questions->count())

                                        @php $i = 0; @endphp
                                        @foreach ($question->questions as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->question }}</td>
                                                <td>{{ ucfirst($item->type) }}</td>
                                                <td>{{ $item->options}}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $status == 0 ? 'danger' : 'success' }} d-inline-flex align-items-center badge-xs">
                                                        <i
                                                            class="ti ti-point-filled me-1"></i>{{ $status == 0 ? 'Inactive' : 'Active' }}
                                                    </span>
                                                </td>
                                                @if (auth()->user()->authorizedPages->contains('slug', 'survey-question-action') || auth()->user()->role_id == 1)
                                                    <td>
                                                        <a href="#edit_question" data-bs-toggle="modal" data-bs-target="#edit_question"
                                                            onclick="getSurveyQestion({{ $item->id }})">
                                                            <i class="ri-pencil-fill cursor-pointer"></i>
                                                        </a>

                                                        <a href="#add_question" data-bs-toggle="modal" data-bs-target="#add_question"
                                                            onclick="addSurveyQestion({{$question->id}})">
                                                            <i class="ms-2 ri-question-line cursor-pointer"></i> </a>

                                                        <a href="#delete_modal" data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                            onclick="getDeleteSurveyQestion({{ $item->id }})">
                                                            <i class="ms-2 ri-delete-bin-line cursor-pointer"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                    @else

                                    <tr>
                                        <td colspan="7" class="text-center text-danger">There is no Questions.</td>
                                    </tr>

                                    @endif


                                @else
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">Please select a survey.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->

    </div>
    <!-- container -->

</div>


<!-- Add Question -->
<div class="modal fade" id="add_question">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Question</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/add-question" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Question</label>
                                <input type="text" class="form-control" name="question" required>
                                <input type="hidden" name="id" id="survey_id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label for="type" class="form-label">Answer Type</label>
                                <select class="form-select" id="addtype" name="type" required
                                    onchange="toggleOptions(this.value)">
                                    <option value="">Select Type</option>
                                    <option value="text">Text</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="select">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="addoptionsGroup" style="display:none;">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Options <small>(comma-separated)</small></label>
                                <textarea class="form-control" id="addoptions" name="options" rows="3"
                                    placeholder="Yes,No,Maybe"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Question -->

<!-- Add Question -->
<div class="modal fade" id="edit_question">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Question</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="/edit-question" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Question</label>
                                <input type="text" class="form-control" name="question" id="question" required>
                                <input type="hidden" name="id" id="question_id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label for="type" class="form-label">Answer Type</label>
                                <select class="form-select" id="type" name="type" required
                                    onchange="toggleOptions(this.value)">
                                    <option value="">Select Type</option>
                                    <option value="text">Text</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="select">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="optionsGroup" style="display:none;">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label class="form-label">Options <small>(comma-separated)</small></label>
                                <textarea class="form-control" id="options" name="options" rows="3"
                                    placeholder="Yes,No,Maybe"></textarea>
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
<!-- /Add Question -->


<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">You want to delete this survey question, this cant be undone once you delete.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a onclick="getDelete()" id="btn-survey-id" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->


<!-- content -->



@include('layouts.footer')


<!-- Datatables js -->
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{ asset('assets/js/pages/demo.datatable-init.js')}}"></script>
<!-- App js -->
<script>

    $('#selectedSurvey').on('change', function () {
        var id = $('#selectedSurvey').val();
        window.location.href = '/survey-question/' + id;
    });

    function toggleOptions(type) {
        const optionsGroup = document.getElementById('optionsGroup');
        if (type === 'radio' || type === 'checkbox' || type === 'select') {
            optionsGroup.style.display = 'block';
        } else {
            optionsGroup.style.display = 'none';
            document.getElementById('options').value = '';
        }

        const addoptionsGroup = document.getElementById('addoptionsGroup');
        if (type === 'radio' || type === 'checkbox' || type === 'select') {
            addoptionsGroup.style.display = 'block';
        } else {
            addoptionsGroup.style.display = 'none';
            document.getElementById('addoptions').value = '';
        }
    }

    function getDeleteSurveyQestion(id) {
        $('#btn-survey-id').data('survey-id', id);
    }

    function addSurveyQestion(id) {
        $('#survey_id').val(id);
    }

    function getSurveyQestion(id) {
        $.ajax({
            url: '/api/getSurveyQuestion/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#question').val(response.question);
                $('#options').val(response.options);
                $('#question_id').val(response.id);
                $('#type').val(response.type);
                var type = response.type;
                if (type === 'radio' || type === 'checkbox' || type === 'select') {
                    optionsGroup.style.display = 'block';
                } else {
                    optionsGroup.style.display = 'none';
                    document.getElementById('options').value = '';
                }
            }
        });
    }

    function getDelete() {
        var id = $('#btn-survey-id').data('survey-id');
        window.location.href = '/delete-question/' + id;
    }

</script>
</body>

</html>