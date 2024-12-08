@extends('layouts.degreeapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Student Result Fourth Year</h2>
                        <ul class="nav navbar-right panel_toolbox">

                            <li>
                                <div class="col-sm-12">

                                    <a class="btn btn-primary " href="javascript:void(0)" id="createNew"> Submit Result </a>
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-12">

                                    <a class="btn btn-success " href="javascript:void(0)" id="exprotModel">Merit List PDF
                                    </a>
                                </div>
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
                                                {{-- <th>Class Of Year</th> --}}
                                                {{-- <th>Class Year</th> --}}
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <th>Reg No</th>
                                                @foreach ($Course as $v)
                                                    {{-- <th>{{ $v->course_code }}({{$v->name}})</th> --}}
                                                    <th>{{ $v->course_code }}</th>
                                                @endforeach
                                                <th>Download(PDF,Excel)</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list">

                                            @foreach ($Student as $ndata)
                                                @php
                                                    $studentclassList = DB::table('degree_student_results')
                                                        ->where('student_id', $ndata->id)
                                                        ->where('class_id', $ndata->class_id)
                                                        ->orderby('subject', 'asc')
                                                        ->get();
                                                    $studentClassYear = DB::table('degree_student_results')
                                                        ->where('student_id', $ndata->id)
                                                        ->where('class_id', $ndata->class_id)
                                                        ->orderby('subject', 'asc')
                                                        ->first();
                                                    $studentClassName = DB::table('degree_classes')
                                                        ->where('id', $ndata->class_id)
                                                        ->first();
                                                @endphp

                                                <tr>
                                                    <td>{{ $loop->index }}</td>
                                                    <td>{{ $studentClassYear ? $studentClassYear->years : '' }}</td>
                                                    {{-- <td>{{ $studentClassName ? $studentClassName->name : '' }}</td> --}}
                                                    {{-- <td>{{ $studentClassYear ? $studentClassYear->student_class_year : '' }}</td> --}}
                                                    <td>{{ $ndata ? $ndata->student_name : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->roll : '' }}</td>
                                                    <td>{{ $ndata ? $ndata->registration_no : '' }}</td>

                                                    @foreach ($Course as $v)
                                                        @php
                                                            $found = $studentclassList->firstWhere('subject', $v->id);
                                                            $marks = $found ? $found->written_mark : '';
                                                        @endphp
                                                        <td>
                                                            {{ $marks }}
                                                        </td>
                                                    @endforeach
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>

                                                        <a target="_blank"
                                                            href="{{ url('degree-fourth-year-marksheet', $ndata->registration_no) }}"
                                                            class="btn btn-sm btn-primary">Download</a>
                                                        <a target="_blank"
                                                            href="{{ url('degree-consolidated-result', $ndata->registration_no) }}"
                                                            class="btn btn-sm btn-danger">Consolidated Result</a>
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
                                        action="{{ route('degree-fourth-year-result.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Class Name</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="classId" name="classId">
                                                <option class="" value="0" selected>--Select --</option>
                                                <option value="{{ $studentclass->id }}">{{ $studentclass->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_class_year" class="col-sm-12 control-label">Student Class
                                                Year</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="student_class_year" name="student_class_year">
                                                <option class="" value="0" selected>--Select --</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Subject</label>
                                            <div class="form-group">

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
                                            <label for="mobile_no" class="col-sm-12 control-label">Student List</label>
                                        </div>
                                        <div class="form-group">

                                        </div>

                                        <div class="form-group">

                                            <span id="rep_all"></span>
                                        </div>
                                        @php $currentYear =  date('Y'); @endphp
                                        {{-- <div class="col-sm-12"> --}}
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-3 control-label"> year</label>
                                            <div class="form-group">
                                                <select class="form-control" id="year" name="year" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @for ($i = 2000; $i < 2050; $i++)
                                                        <option value="{{ $i }}"
                                                            @if ($currentYear == $i) selected @endif>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            {{-- </div>                      --}}
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
                    <div class="modal fade" id="pdfModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('degree-fourth-year-merit-list/export-pdf') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Class Name</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="classId" name="classId">
                                                <option value="{{ $studentclass->id }}">{{ $studentclass->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Session" class="col-sm-12 control-label">Session</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="Session" name="Session">
                                                <option class="" value="0" selected>--Select --</option>
                                                @foreach ($StudentSession as $datainfo)
                                                    <option value="{{ $datainfo->session_year }}">
                                                        {{ $datainfo->session_year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                            <button type="button" class="btn btn-primary" id="closemodal1"
                                                aria-label="Close"> close </button>
                                        </div>
                                    </form>
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
                            $.get("{{ route('degree-fourth-year-result.index') }}" + '/' + id + '/edit', function(data) {
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
                                url: 'degree_fourth_year/' + id,
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);
                                    $('#student_session_year').empty();
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
                            $.ajax({
                                url: 'getUserbyDegreeFourth',
                                type: 'post',
                                data: {
                                    _token: CSRF_TOKEN,
                                    userid: userid
                                },
                                dataType: 'json',
                                success: function(response) {
                                    console.log(response);
                                    $("#rep_all").html(response);
                                }
                            });
                        });


                        $('#closemodal').click(function() {
                            $('#ajaxModel').modal('hide');
                        });
                        $('#closemodal1').click(function() {
                            $('#pdfModel').modal('hide');
                        });
                    </script>
                @endsection
