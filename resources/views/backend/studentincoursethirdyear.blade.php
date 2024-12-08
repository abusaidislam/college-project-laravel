@extends('layouts.department')
@section('title', 'Student Third Year InCourse Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student Third Year InCourse Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Insert Incourse
                                        Result</a>
                                 </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Incourse Result
                                        PDF
                                    </a>
                                 </span>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Session</th>
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <th>Reg No</th>
                                                <th>Course Code</th>
                                                <th>1st Written<br> Marks</th>
                                                <th>1st Atten<br> Marks</th>
                                                <th>1st Total<br> Marks</th>
                                                <th>2nd Written<br> Marks</th>
                                                <th>2nd Atten<br> Marks</th>
                                                <th>2nd Total<br> Marks</th>
                                                <th>Max Marks</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($StudentIncourse as $item)
                                                @php
                                                    $studentdata = DB::table('student_honours_third_years')
                                                        ->where('id', $item->student_id)
                                                        ->first();
                                                    $max1 = $item->total1st_result;
                                                    $max2 = $item->total2nd_result;
                                                    $max = $max1 > $max2 ? $max1 : $max2;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->student_class_year }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="text-center">{{ $studentdata ? $studentdata->roll : '' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $studentdata ? $studentdata->registration_no : '' }}</td>
                                                    <td class="text-center">{{ $item->course_code }}</td>
                                                    <td class="text-center">{{ $item->written1st_marks }}
                                                    </td>
                                                    <td class="text-center">{{ $item->atten1st_marks }}
                                                    </td>
                                                    <td class="text-center">{{ $item->total1st_result }}
                                                    </td>
                                                    <td class="text-center">{{ $item->written2nd_marks }}
                                                    </td>
                                                    <td class="text-center">{{ $item->atten2nd_marks }}
                                                    </td>
                                                    <td class="text-center">{{ $item->total2nd_result }}
                                                    </td>
                                                    <td class="text-center" style="background: rgb(63, 235, 63)">
                                                        {{ $max }}
                                                    </td>
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $item->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ route('third-year-incourse-mark.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="classId" name="classId">
                                                <option class="" value="0" selected>--Select --</option>
                                                <option value="{{ $studentclass->id }}">{{ $studentclass->name }}</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Incourse Mark</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="incourse_type" name="incourse_type">
                                                <option class="" value="0" selected>--Select --</option>
                                                <option value="1">1st Incourse Mark </option>
                                                <option value="2">2nd Incourse Mark</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Course Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="subject" name="subject" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($Course as $ndepart_value)
                                                        <option value="{{ $ndepart_value->course_code }}">
                                                            {{ $ndepart_value->name }} =>
                                                            {{ $ndepart_value->course_code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_class_year" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="student_class_year" name="student_class_year">
                                                <option class="" value="0" selected>--Select --</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Student List</label>
                                        </div>
                                        <div class="form-group">
                                        </div>

                                        <div class="form-group">

                                            <span id="rep_all"></span>
                                        </div>
                                        @php $currentYear =  date('Y'); @endphp
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-3 control-label"> year</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="year" name="year" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @for ($i = 2000; $i < 2050; $i++)
                                                        <option value="{{ $i }}"
                                                            @if ($currentYear == $i) selected @endif>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="department " class="col-sm-2 control-label">Department</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="department"
                                                    name="department" placeholder="Enter  Year" readonly
                                                    value="{{ $depart_name }}" required="">
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
                                                aria-label="Close"> close </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pdfModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('incourse-third-year-result/export-pdf') }}"
                                        enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="classId" name="classId">
                                                <option value="{{ $studentclass->id }}">{{ $studentclass->name }}
                                                </option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Course Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="subject" name="subject" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($Course as $ndepart_value)
                                                        <option value="{{ $ndepart_value->course_code }}">
                                                            {{ $ndepart_value->name }} =>
                                                            {{ $ndepart_value->course_code }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="classSession" class="col-sm-3 control-label">Session</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="classSession" name="classSession"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($studentsession as $item)
                                                        <option value="{{ $item->session_year }}">
                                                            {{ $item->session_year }}
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="department " class="col-sm-2 control-label">Department</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="department"
                                                    name="department" placeholder="Enter  Year" readonly
                                                    value="{{ $depart_name }}" required="">
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                            <button type="button" class="btn btn-danger" id="closepdfmodel"
                                                aria-label="Close"> close </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Script Local -->
<!-- <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> -->
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

    $('#exprotModel').click(function() {
        $('#pdfModel').modal('show');
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
        $.get("{{ route('third-year-incourse-mark.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Edit");
            $('#saveBtn').html('Update');
            $('#ajaxModel').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#classId').val(data.class_id);
            $('#marks').val(data.marks);
            $('#years').val(data.year);

        })
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#classId').on('change', function() {
        var id = $(this).val();
        $.ajax({
            url: 'student_third_year_session/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#student_class_year').empty();
                $('#student_class_year').append('<option value="">--Select--</option>');
                $.each(data, function(key, value) {
                    if ($('#student_class_year option[value="' + value.session_year + '"]')
                        .length === 0) {
                        $('#student_class_year').append('<option data="' + value
                            .class_id + '/' + value.session_year + '" value="' + value
                            .session_year + '">' + value.session_year + '</option>');
                    }
                });

            }
        });
    });
    $('#student_class_year').change(function() {

        var userid = $(this).find('option:selected').attr('data');
        // console.log(userid);
        $.ajax({
            url: 'getIncourseThird',
            type: 'post',
            data: {
                _token: CSRF_TOKEN,
                userid: userid
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                $("#rep_all").html(response);
            }
        });
    });


    $('#closemodal').click(function() {
        $('#ajaxModel').modal('hide');
    });
    $('#closepdfmodel').click(function() {
        $('#pdfModel').modal('hide');
    });

    $(document).ready(function() {
        $('#classSession').select2({
            placeholder: "--Select--",
            allowClear: true,
            width: '100%'
        });

    });
    $(document).on('keyup', 'input[name="marks[]"]', function() {
        var marks = parseInt($(this).val());
        if (isNaN(marks) || marks < 0 || marks > 15) {
            $(this).addClass('is-invalid');
            $(this).val('');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
</script>
@endsection
