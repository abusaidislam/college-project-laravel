@extends('layouts.degreeapp')
@section('title', 'Degree First Year Student Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Degree First Year Student Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            OR &nbsp;
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew1">1st Year Student Import</a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-info" href="javascript:void(0)" id="createNew2">ID Card</a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-info" href="javascript:void(0)" id="createNew3">Student Promote</a>
                                </span>
                            </li>
                            <li>
                                <div class="input-group">
                                    <form action="" method="post">
                                        <div class="input-group">
                                            <select class="form-control" id="studentclass" name="studentclass">
                                                <option value="" selected>--Select Session--</option>
                                                @foreach ($session as $item)
                                                    <option value="{{ $item->session }}">
                                                        {{ $item->session }}
                                                    </option>
                                                @endforeach
                                            </select>
                                       
                                            <span class="input-group-btn">
                                                <a class="btn btn-success createNew2" href="#" id="viewLink">Edit</a>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
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
                                                <th>Class Name</th>
                                                <th>Roll</th>
                                                <th>Regi No.</th>
                                                <th>Session</th>
                                                <th>Register Roll</th>
                                                <th>Father's Name</th>
                                                <th>Mather's Name</th>
                                                <th>Mobile No.</th>
                                                <th>Father's Mobile No.</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $className = DB::table('degree_classes')
                                                        ->where('id', '=', $ndata->studentclass)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        @if ($ndata->photo)
                                                            <img src="{{ asset('public/student/' . $ndata->photo) }}"
                                                                alt="" width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('public/student/default_img.jpg') }}"
                                                                alt="" width="80" height="80">
                                                        @endif
                                                    </td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $className->name }} </td>
                                                    <td>{{ $ndata->roll }} </td>
                                                    <td>{{ $ndata->registration_no }} </td>
                                                    <td>{{ $ndata->session }} </td>
                                                    <td>{{ $ndata->register_roll }} </td>
                                                    <td>{{ $ndata->father_name }}</td>
                                                    <td>{{ $ndata->mather_name }}</td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->father_mobile }} </td>
                                                    <td>{{ $ndata->blood_group }}</td>
                                                    <td>{{ $ndata->email }} </td>
                                                    <td>{{ $ndata->home_dis }} </td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <a href="{{ url('degree_firstyear_idcard', $ndata->id) }}"
                                                            class="btn btn-sm" style="background: rgb(125, 255, 4)">ID
                                                            Card</a>
                                                        <a href="{{ url('degree_firstyear_studycertificate', $ndata->id) }}"
                                                            class="btn btn-sm" style="background: rgb(4, 238, 255)">Study
                                                            Certificate</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('degree-first-year-sudetnts.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="studentclass" name="studentclass">
                                                    <option class="" value="" selected>--Select--</option>
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }} "selected>
                                                            {{ $nstudentclass->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('studentclass')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Student Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Student Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="father_name" class="col-sm-12 control-label">Father's Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="father_name"
                                                    name="father_name" placeholder="Enter Father's Name"
                                                    value="{{ old('father_name') }}">
                                                @error('father_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mather_name" class="col-sm-12 control-label">Mather's Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mather_name"
                                                    name="mather_name" placeholder="Enter Mather's Name"
                                                    value="{{ old('mather_name') }}">
                                                @error('mather_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter mail" value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="register_roll" class="col-sm-12 control-label">Register
                                                Roll</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="register_roll"
                                                    name="register_roll" placeholder="Enter Register Roll"
                                                    value="{{ old('register_roll') }}">
                                                @error('register_roll')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="mobile_no"
                                                    name="mobile_no" placeholder="Enter Mobile No."
                                                    value="{{ old('mobile_no') }}">
                                                @error('mobile_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="father_mobile" class="col-sm-12 control-label">Father's Mobile
                                                No.</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="father_mobile"
                                                    name="father_mobile" placeholder="Enter Father's Mobile No."
                                                    value="{{ old('father_mobile') }}">
                                                @error('father_mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-2 control-label">Session</label>
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
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <label for="blood_group" class="col-sm-12 control-label">Blood Group</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="blood_group" id="blood_group">
                                                    <option value="O+">O positive</option>
                                                    <option value="O-">O negative</option>
                                                    <option value="A+">A positive</option>
                                                    <option value="A-">A negative</option>
                                                    <option value="B+">B positive</option>
                                                    <option value="B-">B negative</option>
                                                    <option value="AB+">AB positive</option>
                                                    <option value="AB-">AB negative</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="home_dis"
                                                    name="home_dis" placeholder="Enter Home District"
                                                    value="{{ old('home_dis') }}">
                                                @error('home_dis')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-3 control-label">Photo</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo">
                                                @error('photo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
                    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('degree_first_year_import') }}" method="POST"
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
                                    <form action="{{ url('degree_first_year_idcard') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control" id="studentsession" name="studentsession">
                                                    <option value="" selected>--Select Session--</option>
                                                    @foreach ($session as $item)
                                                        <option value="{{ $item->session }}">
                                                            {{ $item->session }}
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
                    <div class="modal fade" id="ajaxModel3" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('degree_firstyear_student_promote') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12 mb-4">
                                                <select class="form-control" id="studentsession2" name="studentsession2">
                                                    <option value="" selected>--Select Session--</option>
                                                    @foreach ($session as $item)
                                                        <option value="{{ $item->session }}">
                                                            {{ $item->session }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary" type="submit">Export</button>
                                                <button type="button" class="btn btn-danger" id="closemodal3"
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
            $.get("{{ route('degree-first-year-sudetnts.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#studentclass').val(data.studentclass).trigger('change');
                $('#father_name').val(data.father_name);
                $('#mather_name').val(data.mather_name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#mobile_no').val(data.mobile_no);
                $('#father_mobile').val(data.father_mobile);
                $('#blood_group').val(data.blood_group);
                $('#home_dis').val(data.home_dis);
                $('#register_roll').val(data.register_roll);
                $('#session').val(data.session);
                $('#roll').val(data.roll);
                $('#registration_no').val(data.registration_no);
                $('#photo').val(data.photo);
            })
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
                    url: 'degree-first-year-sudetnts/' + id,
                    success: function(data) {
                        window.location = 'degree-first-year-sudetnts'
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
        $('#createNew2').click(function() {
            $('#ajaxModel2').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });
        $('#createNew3').click(function() {
            $('#ajaxModel3').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });
        $('#closemodal1').click(function() {
            $('#ajaxModel1').modal('hide');
        });
        $('#closemodal2').click(function() {
            $('#ajaxModel2').modal('hide');
        });
        $('#closemodal3').click(function() {
            $('#ajaxModel3').modal('hide');
        });

    </script>
   
    <script type="text/javascript">
        $(document).ready(function() {
            $('#studentclass').on('change', function() {
                var selectedSession = $(this).val(); // Get the selected session value

                // Build the URL based on the selected session
                var url = "{{ route('degree_firstyear_editable', ['session' => ':session']) }}";
                url = url.replace(':session', selectedSession);

                // Update the href attribute of the "View" link
                $('#viewLink').attr('href', url);
            });

            $('#studentclass').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#studentsession').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#studentsession2').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
