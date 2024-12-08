@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
<style>
    .multiselect {
        width: 200px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }

    #checkboxes2 {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes2 label {
        display: block;
    }

    #checkboxes2 label:hover {
        background-color: #1e90ff;
    }
</style>
@section('title', 'Exam Routing Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Routing Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="javascript:void(0)" id="createNew2"> View Routine </a>
                                </span>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Exam Name</th>
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>First Subject</th>
                                                <th>Second Subject</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                @php
                                                    $examName = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $examName ? $examName->title : '' }} </td>
                                                    <td>{{ $ndata->date }} </td>
                                                    <td>{{ $ndata->day }} </td>
                                                    <td>{{ $ndata->first_sub }}</td>
                                                    <td>{{ $ndata->second_sub }}</td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" class="form-horizontal"
                                action="{{ route('examroutine.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="exam_name" class="col-sm-12 control-label">Exam Name:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="exam_name" name="exam_name">
                                            <option value="" selected>--Select Exam Name--</option>
                                            @foreach ($examname as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date" class="col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="datename" name="date"
                                            placeholder="Date" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Roll" class="col-sm-12 control-label">Day</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="day" name="day"
                                            placeholder="Day" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="first_subject" class="col-sm-12 control-label">First Subject</label>
                                    <div class="col-sm-12">
                                        <select class="js-select2" id="first_subject" name="first_subject[]" multiple>
                                            <option class="" value="0">--Select--</option>
                                            @foreach ($CourseName as $course)
                                                <option class="" value="{{ $course->course_code }}">
                                                    {{ $course->name }}--{{ $course->course_code }}</option>
                                            @endforeach
                                            @foreach ($degreeCourseName as $item)
                                                <option class="" value="{{ $item->course_code }}">
                                                    {{ $item->name }}--{{ $item->course_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="second_subject" class="col-sm-12 control-label">Second Subject</label>
                                    <div class="col-sm-12">
                                        <select class="js-select2" id="second_subject" name="second_subject[]" multiple>
                                            <option class="" value="0">--Select--</option>
                                            @foreach ($CourseName as $course)
                                                <option class="" value="{{ $course->course_code }}">
                                                    {{ $course->name }}--{{ $course->course_code }}</option>
                                            @endforeach
                                            @foreach ($degreeCourseName as $item)
                                                <option class="" value="{{ $item->course_code }}">
                                                    {{ $item->name }}--{{ $item->course_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">

                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-danger" id="close"data-bs-dismiss="modal"
                                        aria-label="Close">
                                        close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ajaxModel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" class="form-horizontal"
                                action="{{ url('exam-routine-view') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="exam_name" class="col-sm-12 control-label">Exam Name:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="exam_name" name="exam_name">
                                            <option value="" selected>--Select Exam Name--</option>
                                            @foreach ($examname as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-offset-2 col-sm-10 my-2">

                                    <button type="submit" class="btn btn-primary" id="saveBtn">View Routine</button>
                                    <button type="button" class="btn btn-danger" id="close2"data-bs-dismiss="modal"
                                        aria-label="Close">
                                        close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    });
    $('#createNew').click(function() {
        $('#ajaxModel').modal('show');
        $('#modelHeading').html("Create New");
        $('#form').trigger("reset");
        $('#saveBtn').html('Save');
        $('#id').val('');

    });
    $('#createNew2').click(function() {
        $('#ajaxModel2').modal('show');
        $('#modelHeading').html("Create New");
        $('#form').trigger("reset");
        $('#saveBtn').html('Save');
        $('#id').val('');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '#edit', function() {
        var id = $(this).data('id');
        $.get("{{ route('examroutine.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Edit");
            $('#saveBtn').html('Update');
            $('#ajaxModel').modal('show');
            $('#id').val(data.id);
            $('#exam_name').val(data.exam_id);
            $('#datename').val(data.date);
            $('#day').val(data.day);
            $('#first_subject').val(data.first_sub);
            $('#second_subject').val(data.second_sub);

        })
    });

    /*------------------------------------------
    --------------------------------------------
    Delete ndataInfo Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'examroutine/' + id,
                        success: function(data) {
                            window.location = 'examroutine';
                            const Toast = Swal.mixin(toastConfiguration);
                            Toast.fire({
                                icon: "success",
                                title: "Deleted Successfully!!!"
                            });
                        }
                    });
                }
            });
            return false;
        });


    $('#close').click(function() {
        $('#ajaxModel').modal('hide');
    });

    $('#close2').click(function() {
        $('#ajaxModel2').modal('hide');
    });
</script>
<script>
    $('#datename').change(function() {
        let fulldate = $(this).val();
        var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var a = new Date(new Date(fulldate).toLocaleString('en', {
            timeZone: 'Asia/Dacca'
        }));
        $("#day").val(weekday[a.getDay()])
    })
</script>
<script>
    $(document).ready(function() {
        $('#first_subject').select2({
            width: '100%',
            maximumSelectionLength: 10
        });
        $('#second_subject').select2({
            width: '100%',
            maximumSelectionLength: 10
        });
    });
</script>
@endsection
