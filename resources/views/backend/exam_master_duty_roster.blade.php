@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Master Duty Roaster Manage |')
@section('content')
        <style>
            th {
                background-color: #001f3f;
                color: #fff;
                padding: 0.5em 1em;

            }

            td {
                border-top: 1px solid #eee;
                padding: 0.5em 1em;
            }

            input {
                cursor: pointer;
            }

            .name-col {
                text-align: left;
            }
        </style>
        {{-- <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                    <span class="input-group-btn">
                        <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Export PDF
                        </a>
                    </span>
                </div>
                <div class="title_left text-right" style="padding-right:10px;">
                    <form action="" method="post" class="text-right">
                        <div class="" style="margin-left: 165px">
                            <div class="col-sm-9">
                                <select class="form-control" id="examName" name="examName">
                                    <option value="" selected>--Select Exam Name--</option>
                                    @foreach ($examname as $item)
                                        <option value="{{ $item->title }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <span class="input-group-btn">
                            <a class="btn btn-success createNew2" href="#" id="viewLink">Edit</a>
                        </span>


                    </form>

                </div>

            </div> --}}


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Master Duty Roaster Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Export PDF
                                    </a>
                                 </span>
                            </li>
                            <li>
                                <div class="input-group">
                                    <form action="" method="post">
                                        <div class="input-group">
                                            <select class="form-control" id="examName" name="examName">
                                                <option value="" selected>--Select Session--</option>
                                                    @foreach ($examname as $item)
                                                    <option value="{{ $item->title }}">
                                                        {{ $item->title }}
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
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Teacher Name</th>
                                                <th>Designation</th>
                                                <th>Department</th>
                                                <th>Eamil</th>
                                                <th>Mobile</th>
                                                {{-- @php
                                                    $data = DB::table('exam_routines')->get();
                                                @endphp
                                                @foreach ($data as $d)
                                                    <th style="writing-mode: vertical-lr;">{{ $d->date }}</th>
                                                @endforeach --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataa as $ndata)
                                                @php
                                                    $examName = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_id)
                                                        ->first();
                                                @endphp
                                                <tr class="student">
                                                    <td class="name-col" name="name">
                                                        {{ isset($examName->title) ? $examName->title : '' }}</td>
                                                    <td class="name-col" name="name">
                                                        {{ isset($ndata->name) ? $ndata->name : '' }}</td>
                                                    <td class="name-col" name="designation">
                                                        {{ isset($ndata->designation) ? $ndata->designation : '' }}</td>
                                                    <td class="name-col" name="department">
                                                        {{ isset($ndata->department) ? $ndata->department : '' }}</td>
                                                    <td class="name-col" name="email">
                                                        {{ isset($ndata->email) ? $ndata->email : '' }} </td>
                                                    <td class="name-col" name="mobile">
                                                        {{ isset($ndata->mobile) ? $ndata->mobile : '' }} </td>
                                                    {{-- @foreach ($data as $d)
                                                        <td class="attend-col" name="duty_date">
                                                            <php
                                                            $isChecked = isset($ndata->duty_date) && json_decode($ndata->duty_date)->{$d->date} == 1;
                                                            ?>
                                                            <input type="checkbox"
                                                                name="attendance[{{ $ndata->id }}][{{ $d->date }}]"
                                                                {{ $isChecked ? 'checked' : '' }}>
                                                        </td>
                                                    @endforeach --}}
                                                    <td>

                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- 
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="name-col">Teacher Name</th>
                                                <th class="name-col">Designation</th>
                                                <th class="name-col">Department</th>
                                                <th class="name-col">Mobile</th>
                                                @php
                                                    $data = DB::table('exam_routines')->get();
                                                @endphp
                                                @foreach ($data as $d)
                                                    <th style="writing-mode: vertical-lr;">{{ $d->date }}</th>
                                                @endforeach

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataa as $ndata)
                                               
                                                <tr class="student">
                                                    <td class="name-col" name="name">
                                                        {{ isset($ndata->name) ? $ndata->name : '' }}</td>
                                                    <td class="name-col" name="designation">
                                                        {{ isset($ndata->designation) ? $ndata->designation : '' }}</td>
                                                    <td class="name-col" name="department">
                                                        {{ isset($ndata->department) ? $ndata->department : '' }}</td>
                                                    <td class="name-col" name="mobile">
                                                        0175842154</td>
                                                    @foreach ($data as $d)
                                                        <td class="attend-col" name="duty_date">
                                                            @php
                                                            $isChecked = isset($ndata->duty_date) && json_decode($ndata->duty_date)->{$d->date} == 1;
                                                           @endphp
                                                            <input type="checkbox"
                                                                name="attendance[{{ $ndata->id }}][{{ $d->date }}]"
                                                                {{ $isChecked ? 'checked' : '' }}>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}


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
                                        action="{{ route('master-duty-roaster.store') }}">
                                        @csrf()
        
                                        <input type="hidden" name="id" id="id">
        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="exam_id" name="exam_id">
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($examname as $nexamname)
                                                        <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Teacher Name :</label>
                                            <div class="col-sm-12">
                                                <select id="teacher_name" name="teacher_name" class="js-select2"
                                                    style="width: 100%;">
                                                    <option value="">--Select--</option>
                                                    @foreach ($Teacher_name as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                    @foreach ($degreeTeacher as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
        
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span style="color:red">OR</span>
                                            <label for="name" class="col-sm-12 control-label">Teacher Name: </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Teacher Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Designation: </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation" name="designation"
                                                    placeholder="Designation" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="department" class="col-sm-12 control-label">Department:</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="department" name="department"
                                                    placeholder="Department Name" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label">Email Address:</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email Address" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class="col-sm-12 control-label">Mobile:</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    placeholder="Mobile Number" required="" value="{{ old('mobile') }}">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                    <div class="modal fade" id="pdfModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('master_duty_roster/export-pdf') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="exam_id" name="exam_id">
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($examname as $nexamname)
                                                        <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                                    @endforeach
                                                </select>
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
                $.get("{{ route('master-duty-roaster.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#exam_id').val(data.exam_id);
                    $('#teacher_name').val(data.name).trigger('change');
                    $('#designation.').val(data.designation).trigger('change');
                    $('#department').val(data.department).trigger('change');
                    $('#email').val(data.email).trigger('change');
                    $('#duty_date').val(data.duty_date);

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
                            url: 'master-duty-roaster/' + id,
                            success: function(data) {
                                window.location = 'master-duty-roaster';
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
            $('#closepdfmodel').click(function() {
                $('#pdfModel').modal('hide');
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#examName').on('change', function() {
                    var selectedExam = $(this).val();
                    var url = "{{ route('exam_name_editable', ['title' => ':title']) }}";
                    url = url.replace(':title', selectedExam);
                    $('#viewLink').attr('href', url);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $('#teacher_name').on('change', function() {
                    var teacher_name = $(this).val();
                    // console.log(teacher_name);
                    if (teacher_name) {
                        $.ajax({
                            url: 'teacherInfo/' + teacher_name,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                if (data.teacherall.length > 0) {
                                    var value = data.teacherall[0];
                                    if (value.designation == 1) {
                                        $('#designation').val('Professor');
                                    } else if (value.designation == 2) {
                                        $('#designation').val('Associate Professor');
                                    } else if (value.designation == 3) {
                                        $('#designation').val('Assistant Professor');
                                    } else if (value.designation == 4) {
                                        $('#designation').val('Lecturer');
                                    } else {
                                        $('#designation').val(value.designation);
                                    }
                                    $('#department').val(value.department);
                                    $('#email').val(value.email);
                                    $('#mobile').val(value.mobile_no);
                                } else {

                                }

                                if (data.degreeteacherall.length > 0) {
                                    var value = data.degreeteacherall[0];
                                    if (value.designation == 1) {
                                        $('#designation').val('Professor');
                                    } else if (value.designation == 2) {
                                        $('#designation').val('Associate Professor');
                                    } else if (value.designation == 3) {
                                        $('#designation').val('Assistant Professor');
                                    } else if (value.designation == 4) {
                                        $('#designation').val('Lecturer');
                                    } else {
                                        // Handle other cases if needed
                                    }
                                    $('#department').val('Department of Degree');
                                    $('#email').val(value.email);
                                    $('#mobile').val(value.mobile_no);
                                } else {
                                    // $('#designation').val('Designation Not Found').css('color',
                                    //     'red');
                                }
                            }

                        });
                    }

                });
                $('#teacher_name').select2({
                    placeholder: "--Select--",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endsection
