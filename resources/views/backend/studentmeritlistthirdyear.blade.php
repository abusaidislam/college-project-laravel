@extends('layouts.department') @section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Student Third Year Merti Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->


                            <li>
                                <div class="col-sm-12">

                                    <a class="btn btn-primary " href="javascript:void(0)" id="createNew">Insert Merit Result
                                    </a>
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Export PDF
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
                                                <th>Session</th>
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <th>Regi No</th>
                                                @foreach ($Course as $v)
                                                    <th>{{ $v->course_code }}</th>
                                                @endforeach
                                                <th>Total Marks</th>
                                                <th>Atten Marks</th>
                                                <th>Merit Postion</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list">

                                            @foreach ($StudentMeritList as $item)
                                                @php
                                                    $studentdata = DB::table('student_honours_third_years')
                                                        ->where('depart_id', $item->depart_id)
                                                        ->where('id', $item->student_id)
                                                        ->first();
                                                    $studentclassList = DB::table('student_results')
                                                        ->where('depart_id', $depart_id)
                                                        ->where('student_id', $item->student_id)
                                                        ->where('class_id', $item->class_id)
                                                        ->orderby('subject', 'asc')
                                                        ->get();

                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->index }}</td>
                                                    <td>{{ $item->student_class_year }}
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $studentdata ? $studentdata->roll : '' }}</td>
                                                    <td>{{ $studentdata ? $studentdata->registration_no : '' }}</td>

                                                    @foreach ($Course as $v)
                                                        @php
                                                            $found = $studentclassList->firstWhere('subject', $v->id);
                                                            $marks = $found ? $found->written_mark : '';
                                                        @endphp
                                                        <td>
                                                            {{ $marks }}
                                                        </td>
                                                    @endforeach
                                                    <td>{{ $item->total_result }}
                                                    </td>
                                                    <td>{{ $item->atten_mark }}
                                                    </td>
                                                    <td>{{ $item->merit_marks }}
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
                                        action="{{ route('third-year-merit-list.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
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
                                        </div>
                                        <div class="form-group">
                                            <label for="department " class="col-sm-2 control-label">Department</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="department" name="department"
                                                    placeholder="Enter  Year" readonly value="{{ $depart_name }}"
                                                    required="">
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
                    <div class="modal fade" id="pdfModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('third-year-merit-list/export-pdf') }}"
                                        enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
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
                                            <label for="session" class="col-sm-3 control-label">Session</label>
                                            <div class="form-group">
                                                <select class="form-control" id="session" name="session" required>
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
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="department"
                                                    name="department" placeholder="Enter  Year" readonly
                                                    value="{{ $depart_name }}" required="">
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                            <button type="button" class="btn btn-primary" id="closepdfmodel"
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
                            $.get("{{ route('third-year-merit-list.index') }}" + '/' + id + '/edit', function(data) {
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
                                    $('#student_session_year').empty();
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

                            $.ajax({
                                url: 'studentthirdmerit',
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


                        $('#closemodal').click(function() {
                            $('#ajaxModel').modal('hide');
                        });
                        $('#closepdfmodel').click(function() {
                            $('#pdfModel').modal('hide');
                        });
                        $(document).ready(function() {
                            $('#session').select2({
                                placeholder: "--Select--",
                                allowClear: true,
                                width: '100%'
                            });

                        });
                    </script>
                @endsection
