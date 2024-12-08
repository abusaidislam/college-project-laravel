@extends('layouts.department')
@section('title', 'Honours Fourth Year Student Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Honours Fourth Year Student</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                            </li>
                            OR &nbsp;
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew1">4th Year Student Import
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-info" href="javascript:void(0)" id="createNew2">ID Card</a>
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
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Father's Name</th>
                                                <th>Mather's Name</th>
                                                <th>Class Name</th>
                                                <th>Session</th>
                                                <th>Roll</th>
                                                <th>Registration No</th>
                                                <th>Mobile No.</th>
                                                <th>Father's Mobile No.</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $item)
                                                {{-- @dd($item); --}}
                                                <tr>
                                                    @php
                                                        $ndata = DB::table('students')
                                                            ->where('session', $item->session_year)
                                                            ->where('registration_no', $item->registration_no)
                                                            ->first();
                                                        $sclass = DB::table('studen_classes')
                                                            ->where('id', '=', $item->class_id)
                                                            ->first();
                                                    @endphp
                                                    @if ($ndata)
                                                        <td><img src="{{ asset('public/student/' . $ndata->photo) }}"
                                                                alt="" width="80" height="80"> </td>
                                                        <td>{{ $ndata->name }}</td>
                                                        <td>{{ $ndata->father_name }}</td>
                                                        <td>{{ $ndata->mather_name }}</td>
                                                        <td>
                                                            {{ $sclass ? $sclass->name : '' }}
                                                        </td>
                                                        <td>{{ $ndata->session }} </td>
                                                        <td>{{ $item->roll }} </td>
                                                        <td>{{ $item->registration_no }} </td>
                                                        <td>{{ $ndata->mobile_no }} </td>
                                                        <td>{{ $ndata->father_mobile }} </td>
                                                        <td>{{ $ndata->blood_group }}</td>
                                                        <td>{{ $ndata->email }} </td>
                                                        <td>{{ $ndata->home_dis }} </td>
                                                        <td><button type="button" id="edit"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>
                                                                <button type="button" id="delete"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                            <a href="{{ url('four_year_student_idcard', $item->id) }}"
                                                                class="btn btn-sm" style="background: rgb(125, 255, 4)">ID
                                                                Card</a>
                                                            <a href="{{ url('honors_fourthyear_studycertificate', $item->id) }}"
                                                                class="btn btn-sm"
                                                                style="background: rgb(4, 238, 255)">Study
                                                                Certificate</a>
                                                            <button type="button" id="edit2"
                                                                data-id="{{ $item->id }}" class="btn btn-sm"
                                                                style="background: rgb(0, 255, 195)">CGPA Add</button>
                                                            <a href="{{ url('honors_testimonial', $item->id) }}"
                                                                class="btn btn-sm"
                                                                style="background: rgb(4, 192, 255)">Testimonial</a>
                                                            {{-- <button type="button" id="delete"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger">Delete</button> --}}
                                                        </td>
                                                    @else
                                                        {{-- <td style="color: red; text-align:center">
                                                            Roll:{{ $item->roll }},
                                                            Regi:{{ $item->registration_no }}
                                                            Register Roll:{{ $item->register_rollID }}
                                                            Session:{{ $item->session }}
                                                            Class Year:{{ $item->class_year }}
                                                            No student data found Because This Student Honours 1st Year No
                                                            Insert!!!</td> --}}
                                                        <td class="bg-danger text-white"></td>
                                                        <td class="bg-danger text-white">{{ $item->student_name }}</td>
                                                        <td class="bg-danger text-white">No data found</td>
                                                        <td class="bg-danger text-white">Because This Student no Insert!!!
                                                        </td>
                                                        <td class="bg-danger text-white">{{ $sclass ? $sclass->name : '' }}
                                                        </td>
                                                        <td class="bg-danger text-white">{{ $item->session_year }}</td>
                                                        <td class="bg-danger text-white">{{ $item->roll }} </td>
                                                        <td class="bg-danger text-white">{{ $item->registration_no }} </td>
                                                        <td class="bg-danger text-white"></td>
                                                        <td class="bg-danger text-white"></td>
                                                        <td class="bg-danger text-white"></td>
                                                        <td class="bg-danger text-white"> </td>
                                                        <td class="bg-danger text-white"> </td>
                                                        <td><button type="button" id="edit"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>

                                                            <button type="button" id="delete"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                            <a href="{{ url('four_year_student_idcard', $item->id) }}"
                                                                class="btn btn-sm" style="background: rgb(125, 255, 4)">ID
                                                                Card</a>
                                                            <a href="{{ url('honors_fourthyear_studycertificate', $item->id) }}"
                                                                class="btn btn-sm"
                                                                style="background: rgb(4, 238, 255)">Study
                                                                Certificate</a>
                                                            <button type="button" id="edit2"
                                                                data-id="{{ $item->id }}" class="btn btn-sm"
                                                                style="background: rgb(0, 255, 195)">CGPA Add</button>
                                                            <a href="{{ url('honors_testimonial', $item->id) }}"
                                                                class="btn btn-sm"
                                                                style="background: rgb(4, 192, 255)">Testimonial</a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                        action="{{ route('honours-fourth-year-students.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="studentclass" name="studentclass">
                                                    <option class="" value="" selected>--Select--</option>
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }}">
                                                            {{ $nstudentclass->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('studentclass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_name" class="col-sm-12 control-label">Student Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="student_name"
                                                    name="student_name" placeholder="Enter Student Name"
                                                    value="{{ old('student_name') }}">
                                                @error('student_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="session" name="session"
                                                    placeholder="Enter Session" value="{{ old('session') }}">
                                                @error('session')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-2 control-label">Roll</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="roll" name="roll"
                                                    placeholder="Enter Roll" value="{{ old('roll') }}">
                                                @error('roll')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="registration_no" class="col-sm-12 control-label">Registration
                                                No</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="registration_no"
                                                    name="registration_no" placeholder="Enter Registration No"
                                                    value="{{ old('registration_no') }}">
                                                @error('registration_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
                                                aria-label="Close">
                                                close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ajaxModelcgpa2" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('honours-fourth-year-students.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id2">
                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="studentclass2" name="studentclass"
                                                    @readonly(true)>
                                                    {{-- <option class="" value="" selected>--Select--</option> --}}
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }}" selected>
                                                            {{ $nstudentclass->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('studentclass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_name" class="col-sm-12 control-label">Student Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="student_name2"
                                                    name="student_name" placeholder="Enter Student Name"
                                                    value="{{ old('student_name') }}" readonly>
                                                @error('student_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="session2" name="session"
                                                    placeholder="Enter Session" value="{{ old('session') }}" readonly>
                                                @error('session')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-2 control-label">Roll</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="roll2" name="roll"
                                                    placeholder="Enter Roll" value="{{ old('roll') }}" readonly>
                                                @error('roll')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="registration_no" class="col-sm-12 control-label">Registration
                                                No</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="registration_no2"
                                                    name="registration_no" placeholder="Enter Registration No"
                                                    value="{{ old('registration_no') }}" readonly>
                                                @error('registration_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="final_cgpa" class="col-sm-12 control-label">Final CGPA</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="final_cgpa2"
                                                    name="final_cgpa" placeholder="Enter Final CGPA"
                                                    value="{{ old('final_cgpa') }}">
                                                @error('final_cgpa')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="held_year" class="col-sm-12 control-label">Held Year</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="held_year2"
                                                    name="held_year" placeholder="Enter Held Year"
                                                    value="{{ old('held_year') }}">
                                                @error('held_year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Select Gender</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="gender2" name="gender">
                                                    <option class="" value="" selected>--Select--</option>
                                                    <option class="" value="Male">Male</option>
                                                    <option class="" value="Female">Female</option>

                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn2">Update</button>
                                            <button type="button" class="btn btn-danger" id="closemodalcgpa2"
                                                aria-label="Close">
                                                close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('fourth_student_import') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="file" class="col-sm-12 control-label">Excel File
                                                Import</label>
                                            <div class="col-sm-12 mb-4">
                                                <input type="file" class="form-control" id="file" name="file"
                                                    placeholder="Enter Excel File">

                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                                <button type="button" class="btn btn-danger" id="closemodal1"
                                                    aria-label="Close">
                                                    close
                                                </button>

                                            </div>

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
                                    <form action="{{ url('honours_four_year_idcard') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control" id="studentsession" name="studentsession">
                                                    <option value="" selected>--Select Session--</option>
                                                    @foreach ($session as $item)
                                                        <option value="{{ $item->session_year }}">
                                                            {{ $item->session_year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary" type="submit">Export</button>
                                                <button type="button" class="btn btn-danger" id="closemodal2"
                                                    aria-label="Close">
                                                    close
                                                </button>
                                            </div>
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
            console.log(id);
            $.get("{{ route('honours-fourth-year-students.index') }}" + '/' + id + '/edit', function(data) {
                console.log(data);
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#studentclass').val(data.class_id);
                $('#student_name').val(data.student_name);
                $('#registration_no').val(data.registration_no);
                $('#session').val(data.session_year);
                $('#roll').val(data.roll);
            })
        });

        $('body').on('click', '#edit2', function() {
            var id = $(this).data('id');
            // console.log(id);
            $.get("{{ route('honours-fourth-year-students.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn2').html('Update');
                $('#ajaxModelcgpa2').modal('show');
                $('#id2').val(data.id);
                $('#studentclass2').val(data.class_id).trigger('change');
                $('#student_name2').val(data.student_name);
                $('#registration_no2').val(data.registration_no);
                $('#session2').val(data.session_year);
                $('#roll2').val(data.roll);
                $('#final_cgpa2').val(data.final_cgpa);
                $('#held_year2').val(data.held_year);
                $('#gender2').val(data.gender);

            });
        });
        /*------------------------------------------
                   --------------------------------------------
                   Delete ndataInfo Code
                   --------------------------------------------
                   --------------------------------------------*/
        $('body').on('click', '#delete', function() {

            var id = $(this).data("id");
            if (confirm("Are You sure want to delete This!")) {
                $.ajax({
                    type: "DELETE",
                    url: 'honours-fourth-year-students/' + id,
                    success: function(data) {
                        window.location = 'honours-fourth-year-students'
                    }

                });
            }
            return false;
        });
        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        $('#createNew1').click(function() {
            $('#ajaxModel1').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });
        $('#closemodal1').click(function() {
            $('#ajaxModel1').modal('hide');
        });

        $('#createNew2').click(function() {
            $('#ajaxModel2').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });

        $('#closemodal2').click(function() {
            $('#ajaxModel2').modal('hide');
        });
        $('#closemodalcgpa2').click(function() {
            $('#ajaxModelcgpa2').modal('hide');
        });

        $('#studentsession').select2({
            placeholder: "--Select--",
            allowClear: true,
            width: '100%'
        });
    </script>
@endsection
