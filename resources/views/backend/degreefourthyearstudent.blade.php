@extends('layouts.degreeapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-primary" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                    <span>
                        Or
                    </span>
                    <span class="input-group-btn">
                        <a class="btn btn-success" href="javascript:void(0)" id="createNew1">4th Year Student Import
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Degree Fourth Year Student Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                                <th>Class Year</th>
                                                <th>Session</th>
                                                <th>Roll</th>
                                                <th>Registration No</th>
                                                <th>Register Roll</th>
                                                <th>Mobile No.</th>
                                                <th>Father's Mobile No.</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $item)
                                                {{-- @dd($ndata); --}}
                                                <tr>
                                                    @php
                                                        $ndata = DB::table('degree_first_year_students')
                                                            ->where('session', $item->session_year)
                                                            ->where('registration_no', $item->registration_no)
                                                            ->first();
                                                    @endphp
                                                    @if ($ndata)
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
                                                        <td>{{ $ndata->father_name }}</td>
                                                        <td>{{ $ndata->mather_name }}</td>
                                                        <?php $sclass = DB::table('studen_classes')
                                                            ->where('id', '=', $item->class_id)
                                                            ->get(); ?>
                                                        <td>
                                                            @foreach ($sclass as $nsclass)
                                                                {{ $nsclass->name }}
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $item->class_year }} </td>
                                                        <td>{{ $ndata->session }} </td>
                                                        <td>{{ $item->roll }} </td>
                                                        <td>{{ $item->registration_no }} </td>
                                                        <td>{{ $item->register_rollID }} </td>
                                                        <td>{{ $ndata->mobile_no }} </td>
                                                        <td>{{ $ndata->father_mobile }} </td>
                                                        <td>{{ $ndata->blood_group }}</td>
                                                        <td>{{ $ndata->email }} </td>
                                                        <td>{{ $ndata->home_dis }} </td>
                                                        <td><button type="button" id="edit"
                                                                data-id="{{ $item->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>

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
                                                        <td class="bg-danger text-white">Because This Student</td>
                                                        <td class="bg-danger text-white">No Insert!!!</td>
                                                        <td class="bg-danger text-white">{{ $item->class_year }} </td>
                                                        <td class="bg-danger text-white"></td>
                                                        <td class="bg-danger text-white">{{ $item->roll }} </td>
                                                        <td class="bg-danger text-white">{{ $item->registration_no }} </td>
                                                        <td class="bg-danger text-white">{{ $item->register_rollID }} </td>
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
                                        action="{{ route('degree-fourth-year-students.store') }}"
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
                                            <label for="class_year_session" class="col-sm-12 control-label">Class Year
                                                Session</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="class_year_session"
                                                    name="class_year_session" placeholder="Enter Class Year Session"
                                                    value="{{ old('class_year_session') }}">
                                                @error('class_year_session')
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
                                            <label for="register_roll" class="col-sm-12 control-label">1st Year Register
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
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary" id="closemodal"
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
                                    <form action="{{ url('degree_fourth_year_import') }}" method="POST"
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
                                                <button type="button" class="btn btn-primary" id="closemodal1"
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
            $.get("{{ route('degree-fourth-year-students.index') }}" + '/' + id + '/edit', function(data) {
                console.log(data);
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#studentclass').val(data.class_id).trigger('change');
                $('#student_name').val(data.student_name);
                $('#register_roll').val(data.register_rollID);
                $('#registration_no').val(data.registration_no);
                $('#session').val(data.session_year);
                $('#class_year_session').val(data.class_year);
                $('#roll').val(data.roll);
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
                    url: 'degree-fourth-year-students/' + id,
                    success: function(data) {
                        window.location = 'degree-fourth-year-students'
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

        // $('#close').click(function() {
        //     $('#ajaxModel1').modal('hide');

        // });
    </script>
@endsection
