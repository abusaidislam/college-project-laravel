@php
    $userType = DB::table('users')
        ->where('id', $authID)
        ->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Room Wise Exam Duty Roaster Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Room Wise Exam Duty Roaster Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                             </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="javascript:void(0)" id="exprotModel">Export PDF
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
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Teacher Name </th>
                                                <th>Designation</th>
                                                <th>Department</th>
                                                <th>Duty Date</th>
                                                <th>Room Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomWiseDataRoster as $ndata)
                                                @php
                                                    $MasterInfo = DB::table('exam_master_duty_rosters')
                                                        ->where('id', $ndata->teacher_masterduty_id)
                                                        ->where('user_id', $authID)
                                                        ->first();
                                                    $roomNum = DB::table('room_no')
                                                        ->where('id', '=', $ndata->room_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ isset($MasterInfo->name) ? $MasterInfo->name : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($MasterInfo->designation) ? $MasterInfo->designation : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($MasterInfo->department) ? $MasterInfo->department : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $ndata ? $ndata->duty_date : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $roomNum ? $roomNum->title : '' }}
                                                    </td>
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
                                action="{{ route('room-wise-master-duty.store') }}">
                                @csrf()

                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control exam_id" id="exam_id" name="exam_id">
                                            <option class="" value="0" selected>--Select --</option>
                                            @foreach ($examname as $nexamname)
                                                <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="duty_date" class="col-sm-12 control-label">Duty Date :</label>
                                    <div class="col-sm-12">
                                        <select class="js-select2 duty_date" id="duty_date" name="duty_date" required>
                                            <option class="" value="0" selected>--Select --</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-12 control-label">Teacher Name :</label>
                                    <div class="col-sm-12">
                                        <select id="teacher_name" name="teacher_name" class="js-select2"
                                            style="width: 100%;">
                                            <option class="" value="0" selected>--Select --</option>
                                        </select>

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
                                    <label for="building" class="col-sm-12 control-label">Name Of Building :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="building" name="building">
                                            <option class="" value="0" selected>--Select --</option>
                                            @foreach ($building_name as $item)
                                                <option value="{{ $item->id }}">{{ $item->building_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="room_num" class="col-sm-12 control-label">Room Number:</label>
                                    <div class="col-sm-12">
                                        <select class="js-select2 room_num" id="room_num" name="room_num" required>
                                            <option class="" value="0" selected>--Select --</option>

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
            <div class="modal fade" id="pdfModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form"
                                action="{{ url('exam_roomwise/export-pdf') }}" enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control exam_id" id="exam_name" name="exam_name" required>
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($examname as $nexamname)
                                            <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="duty_date" class="col-sm-12 control-label">Duty Date :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control duty_date" id="duty_date" name="duty_date" required>
                                        <option class="" value="0" selected>--Select --</option>

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
                $.get("{{ route('room-wise-master-duty.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#exam_id').val(data.exam_id).trigger('change');
                    $('#teacher_name').val(data.teacher_masterduty_id).trigger('change');
                    $('.duty_date').val(data.duty_date).trigger('change');
                    $('#building').val(data.building_id).trigger('change');
                    $('#room_num').val(data.room_id).trigger('change');

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
                        url: 'room-wise-master-duty/' + id,
                        success: function(data) {
                            window.location = 'room-wise-master-duty';
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
                    var url = "{{ route('exam_roomwise_editable', ['title' => ':title']) }}";
                    url = url.replace(':title', selectedExam);
                    $('#viewLink').attr('href', url);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.exam_id').on('change', function() {
                    var id = $(this).val();
                    if (id) {
                        $.ajax({
                            url: 'exam_id/' + id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // console.log(data);
                                $('.duty_date').empty();
                                $('.duty_date').append('<option value="">--Select--</option>');
                                $.each(data, function(key, value) {
                                    $('.duty_date').append('<option value="' + value.date +
                                        '">' + value.date + '</option>');
                                });
                                $('.duty_date').trigger('change');
                            }

                        });
                    }

                });
                $('#duty_date').on('change', function() {
                    var date = $(this).val();
                    var examData = $("#exam_id").val();
                    // console.log(examData);
                    if (date) {
                        $.ajax({
                            url: 'exam_date/' + date + '/' + examData,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // console.log(data);
                                $('#teacher_name').empty();
                                $('#teacher_name').append('<option value="">--Select--</option>');
                                $.each(data, function(key, value) {
                                    $('#teacher_name').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                });
                                $('#teacher_name').trigger('change');
                            }

                        });
                    }

                });
                $('#teacher_name').on('change', function() {
                    var teacher_masterid = $(this).val();
                    // console.log(teacher_name);
                    if (teacher_masterid) {
                        $.ajax({
                            url: 'teacherMasterInfo/' + teacher_masterid,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                if (data.length > 0) {
                                    var value = data[0];
                                    $('#designation').val(value.designation);
                                    $('#department').val(value.department);
                                    // $('#email').val(value.email);
                                    // $('#mobile').val(value.mobile);
                                } else {
                                    $('#designation').val('Designation Not Found').css('color',
                                        'red');
                                }

                            }

                        });
                    }

                });

                $('#building').on('change', function() {
                    var id = $(this).val();
                    if (id) {
                        $.ajax({
                            url: 'building_id/' + id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
                                $('#room_num').empty();
                                $('#room_num').append('<option value="">--Select--</option>');
                                $.each(data, function(key, value) {
                                    $('#room_num').append('<option value="' + value.id +
                                        '">' + value.title + '</option>');
                                });
                                $('#room_num').trigger('change');
                            }

                        });
                    }

                });
                $('#teacher_name').select2({
                    placeholder: "--Select--",
                    allowClear: true,
                    width: '100%'
                });
                $('#room_num').select2({
                    placeholder: "--Select--",
                    allowClear: true,
                    width: '100%'
                });
                $('#duty_date').select2({
                    placeholder: "--Select--",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endsection
