@extends('layouts.department') 
@section('title', 'Student Result First Year Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student Result First Year</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Insert Result</a>
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
                                                <th>Year of exam</th>
                                                <th>Session</th>
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <th>Reg No</th>
                                                @foreach ($Course as $v)
                                                    {{-- <th>{{ $v->course_code }}({{$v->name}})</th> --}}
                                                    <th>{{ $v->course_code }}</th>
                                                @endforeach
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list">

                                            @foreach ($Student as $ndata)
                                                @php
                                                    $studentclassList = DB::table('student_results')
                                                        ->where('depart_id', $depart_id)
                                                        ->where('student_id', $ndata->id)
                                                        ->where('class_id', $ndata->studentclass)
                                                        ->orderby('subject', 'asc')
                                                        ->get();
                                                    $studentClassYear = DB::table('student_results')
                                                        ->where('depart_id', $depart_id)
                                                        ->where('student_id', $ndata->id)
                                                        ->where('class_id', $ndata->studentclass)
                                                        ->orderby('subject', 'asc')
                                                        ->first();
                                                    $studentClassName = DB::table('studen_classes')
                                                        ->where('id', $ndata->class_id)
                                                        ->first();
                                                @endphp

                                                <tr>
                                                    <td>{{ $loop->index }}</td>
                                                    <td>{{ $studentClassYear ? $studentClassYear->years : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->session : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->name : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->roll : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->registration_no : '' }}</td>

                                                    @foreach ($Course as $v)
                                                        @php
                                                            $found = $studentclassList->firstWhere('subject', $v->id);
                                                            $marks = $found ? $found->marks : '';
                                                        @endphp
                                                        <td>
                                                            {{ $marks }}
                                                        </td>
                                                    @endforeach
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <a target="_blank"
                                                            href="{{ url('mark-sheet-download', $ndata->registration_no) }}"
                                                            class="btn btn-sm btn-primary">View Result</a>
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
                                        action="{{ route('students-result-first-year.store') }}"
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
                                            <label for="student_class_year" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                            <select class="form-control student_class_year" id="student_class_year"
                                                name="student_class_year">
                                                <option class="" value="0" selected>--Select --</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Subject</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="subject" name="subject" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($Course as $ndepart_value)
                                                        <option value="{{ $ndepart_value->id }}">
                                                            {{ $ndepart_value->name }} =>
                                                            {{ $ndepart_value->course_code }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sub_written_mark" class="col-sm-12 control-label">Subject Exam
                                                Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="sub_written_mark"
                                                    name="sub_written_mark" placeholder="Enter Subject Exam Number"
                                                    value="80" required="">
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
                                            <button type="button" class="btn btn-primary" id="closemodal"
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
        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('students-result-first-year.index') }}" + '/' + id + '/edit', function(data) {
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
            // console.log(id);
            $.ajax({
                url: 'student_year_session/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#student_class_year').empty();
                    $.each(data, function(key, value) {
                        if ($('#student_class_year option[value="' + value.session + '"]')
                            .length === 0) {
                            $('#student_class_year').append('<option data="' + value
                                .studentclass + '/' + value.session + '" value="' + value
                                .session + '">' + value.session + '</option>');
                        }
                    });
                }
            });
        });
        $('#student_class_year').change(function() {
            var userid = $(this).find('option:selected').attr('data');
            // console.log(userid);
            $.ajax({
                url: 'getUserbyid',
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    userid: userid
                },
                dataType: 'json',
                success: function(response) {
                    $("#rep_all").html(response);
                }
            });
        });


        $(document).ready(function() {

            // Fetch all records
            $('#but_fetchall').click(function() {

                // AJAX GET request
                $.ajax({
                    url: 'getUsers',
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        createRows(response);

                    }
                });
            });

            // $('.student_class_year').select2({
            //     placeholder: "--Select--",
            //     allowClear: true,
            //     width: '100%'
            // });


        });

        // Create table rows
        function createRows(response) {

            var len = 0;
            $('#empTable tbody').empty(); // Empty <tbody>
            if (response['data'] != null) {
                len = response['data'].length;
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var sid = response['data'][i].id;
                    var roll = response['data'][i].roll;
                    var name = response['data'][i].name;
                    var tr_str = "<tr>" +
                        "<td align='center'>" + (i + 1) + "</td>" +
                        "<td align='center'> <input type='text' class='form-control' id='name' name='sname[]' readonly  value=" +
                        name + "  required=''></td> " +
                        "<input type='hidden' name='sid[]' value=" + sid +
                        " ><td align='center'><input type='text' class='form-control' id='marks' name='marks[]' placeholder='Enter Marks ' value='' required=''></td></tr>";

                    $("#empTable tbody").append(tr_str);
                }

            } else {
                var tr_str = "<tr>" +
                    "<td align='center' colspan='4'>No record found.</td>" +
                    "</tr>";

                $("#empTable tbody").append(tr_str);
            }
        }

        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection
