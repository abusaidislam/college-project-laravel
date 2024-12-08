@extends('layouts.hosapp')
@section('title', 'Hostel Seat Allotment Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hostel Seat Allotment Infromation</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/hostel_seat_allotment_pdf') }}" id="">
                                        Download
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
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Payment Photo</th>
                                                <th>Student Name</th>
                                                <th>Department</th>
                                                <th>Status</th>
                                                <th>Roll</th>
                                                <th>Regi</th>
                                                <th>Session</th>
                                                <th>Bulding Name</th>
                                                <th>Floor Name</th>
                                                <th>Room Number</th>
                                                <th>Seat Number</th>
                                                <th>Payment Amount</th>
                                                <th>Check in Date</th>
                                                <th>Check Out Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                {{-- @dd($ndata); --}}
                                                @php
                                                    $stu_name = DB::table('students')
                                                        ->where('id', $ndata->student_name)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    $depart = DB::table('departments')
                                                        ->where('id', $ndata->department_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    $building = DB::table('hostel_buldings')
                                                        ->where('id', $ndata->bulding_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    $floor = DB::table('hostel_floors')
                                                        ->where('id', $ndata->floor_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    $room = DB::table('hostel_rooms')
                                                        ->where('id', $ndata->room_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    $seat = DB::table('hostel_rooms')
                                                        ->where('id', $ndata->bed_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();

                                                @endphp
                                                {{-- @dd($stu_name); --}}
                                                <tr>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->payment_photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $ndata->student_name }}</td>
                                                    @if ($ndata->department_id == 40)
                                                        <td>Department of General </td>
                                                    @else
                                                        <td>{{ $depart ? $depart->name : '' }} </td>
                                                    @endif
                                                    <td>
                                                        <span class="status-label" data-id="{{ $ndata->id }}"
                                                            data-status="{{ $ndata->status }}"
                                                            style="color: {{ $ndata->status == 0 ? 'green' : 'red' }}">
                                                            {{ $ndata->status == 0 ? 'Active' : 'Inactive' }}
                                                        </span>
                                                        <button class="update-status-btn btn btn-info p-0"
                                                            data-id="{{ $ndata->id }}">Update</button>
                                                    </td>
                                                    <td>{{ $ndata->roll }} </td>
                                                    <td>{{ $ndata->registration }} </td>
                                                    <td>{{ $ndata->session }} </td>
                                                    <td>{{ $building->bulding_name }} </td>
                                                    <td>{{ $floor->floor_name }} </td>
                                                    <td>{{ $room->room_number }} </td>
                                                    <td>{{ $seat->seat_number }} </td>
                                                    <td>{{ $ndata->payment_amount }} </td>
                                                    <td>{{ $ndata->check_in_date }} </td>
                                                    <td>{{ $ndata->check_out_date }} </td>
                                                    <td>
                                                        <a href="{{ url('studentreceipt', $ndata->id) }}"
                                                            class="btn btn-info"><span
                                                                class="glyphicon glyphicon-plus-sign"></span></a>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
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
                    <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('seatallotment.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Department Name :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="department_id"
                                                        name="department_id"required>
                                                        <option class="" value="" selected>--Select --</option>
                                                        @foreach ($department as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                        <option value="40">{{ $genarelDepart->name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- General Deparment user Id 17 this id Department Id 17 mathch so new value 40 fiexd --}}
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Class Name :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="class" name="class" required>
                                                        <option class="" value="" selected>--Select --</option>
                                                        @foreach ($className as $item)
                                                            <option class="" value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                        @foreach ($degreeclassName as $item)
                                                            <option class="" value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Session :</label>
                                                <div class="col-sm-12">
                                                    <select class="js-select2" id="session" name="session">
                                                        <option class="" value="" selected>--Select --</option>

                                                    </select>
                                                    <input type="text" class="form-control" id="studentSession"
                                                        name="studentSession" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Student Name :</label>
                                                <div class="col-sm-12">
                                                    <select id="student_name" name="student_name" class="js-select2"
                                                        style="width: 100%;">
                                                        <option value="">--Select--</option>
                                                    </select>

                                                    <input type="text" class="form-control" id="studentName"
                                                        name="studentName" readonly>
                                                    <input type="hidden" class="form-control" id="stu_name"
                                                        name="stu_name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Roll :</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="roll" name="roll"
                                                        placeholder="Student Roll ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="home_dis" class="col-sm-12 control-label">Registration</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="registration"
                                                        name="registration" placeholder="Enter To Registration">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="mobile_no" class="col-sm-12 control-label">Mobile No.</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="mobile_no"
                                                        name="mobile_no" placeholder="Mobile No." value=""
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 control-label">Name Of Bulding
                                                    :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="bulding_id" name="bulding_id" required>
                                                        <option class="" value="0" selected>--Select --</option>
                                                        @foreach ($bulding as $item)
                                                            <option value="{{ $item->id }}">{{ $item->bulding_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Name Of Floor :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="floor_id" name="floor_id" required>
                                                        <option class="" value="0" selected>--Select --</option>
                                                    </select>
                                                    <input type="text" class="form-control" id="floorName"
                                                        name="floorName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Name Of Room :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="room_id" name="room_id" required>
                                                        <option class="" value="0" selected>--Select --</option>

                                                    </select>
                                                    <input type="text" class="form-control" id="roomName"
                                                        name="roomName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Number Of Seat :</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control bed_id" id="bed_id" name="bed_id">
                                                        <option class="" value="0" selected>--Select --</option>
                                                    </select>
                                                    <input type="text" class="form-control" id="SeatName"
                                                        name="SeatName" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            

                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Check In Date</label>
                                                <div class="col-sm-12">
                                                    <input type="date" class="form-control" id="check_in_date"
                                                        name="check_in_date" placeholder="Enter Check In Date" value=""
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Check Out Date</label>
                                                <div class="col-sm-12">
                                                    <input type="date" class="form-control" id="check_out_date"
                                                        name="check_out_date" placeholder="Enter Check Out Date"
                                                        value="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_amount" class="col-sm-12 control-label">Payment
                                                    Amount</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="payment_amount"
                                                        name="payment_amount" placeholder="Enter Payment Amount"
                                                        value="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Student Photo
                                                    (Dimensions:530x650, Max-Size:200kb)</label>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" id="photo" name="photo"
                                                        placeholder="Enter Photo" value="">

                                                    <span class="text-danger">
                                                        @error('photo')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Payment Photo
                                                    (Dimensions:800x800, Max-Size:400kb)</label>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" id="payment_photo"
                                                        name="payment_photo" placeholder="Enter Photo" value="">
                                                    <span class="text-danger">
                                                        @error('payment_photo')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Status:</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="status" name="status"required>
                                                        <option class="" value="0" selected>Active</option>
                                                        <option class="" value="1">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                </div>
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-danger" id="closemodal" aria-label="Close">
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
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            $('#dform').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
            $('#studentName').hide();
            $('#studentSession').hide();
            $('#floorName').hide();
            $('#roomName').hide();
            $('#SeatName').hide();
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');

            $.get("{{ route('seatallotment.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#department_id').val(data.department_id).trigger('change');
                $('#student_name').val(data.student_name).trigger('change');
                $('#class').val(data.class).trigger('change');
                $('#roll').val(data.roll);
                $('#registration').val(data.registration);
                $('#mobile_no').val(data.mobile_no);
                $('#session').val(data.session).trigger('change');
                $('#studentSession').val(data.session);
                $('#studentName').val(data.student_name);
                $('#floorName').val(data.floor_id);
                $('#SeatName').val(data.bed_id);
                $('#room_id').val(data.room_id).trigger('change');
                $('#bulding_id').val(data.bulding_id).trigger('change');
                $('.floor_id').val(data.floor_id).trigger('change');
                $('.bed_id').val(data.bed_id).trigger('change');
                $('#check_in_date').val(data.check_in_date);
                $('#check_out_date').val(data.check_out_date);
                $('#payment_amount').val(data.payment_amount);
                // $('#details').summernote('code', data.details);
                if (data.room_id) {
                    $.ajax({
                        url: "{{ route('getRoomNumber') }}",
                        type: 'GET',
                        data: {
                            room_id: data.room_id
                        },
                        success: function(response) {
                            $('#roomName').val(response.room_number);
                        },
                        error: function(error) {
                            console.log('Error fetching room number:', error);
                        }
                    });
                }
                if (data.floor_id) {
                    $.ajax({
                        url: "{{ route('getfloorName') }}",
                        type: 'GET',
                        data: {
                            floor_id: data.floor_id
                        },
                        success: function(response) {
                            $('#floorName').val(response.floor_name);
                        },
                        error: function(error) {
                            console.log('Error fetching floor Name:', error);
                        }
                    });
                }
            });
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
                        url: 'seatallotment/' + id,
                        success: function(data) {
                            window.location = 'seatallotment';
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
        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#department_id').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'departmentID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#session').empty();
                            $('#session').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#session').append('<option value="' + value.session +
                                    '">' + value.session + '</option>');
                            });
                            $('#session').trigger('change');
                        }
                    });
                }
            });

            $('#session').on('change', function() {
                var id = $(this).val();

                if (id) {
                    $.ajax({
                        url: 'sessionID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('#class').empty();
                            $('#class').append('<option value="">--Select--</option>');
                            var uniqueValues = new Set();
                            $.each(data, function(key, value) {
                                if (!uniqueValues.has(value.id)) {
                                    uniqueValues.add(value.id);
                                    $('#class').append('<option value="' + value.id +
                                        '">' + value.name + '</option>');
                                }
                            });
                        }
                    });
                }
            });
            $('#class').on('change', function() {
                var id = $(this).val();
                console.log(id);
                if (id) {
                    $.ajax({
                        url: 'classID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#student_name').empty();
                            $('#student_name').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#student_name').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
            $('#student_name').on('change', function() {
                var id = $(this).val();
                // console.log(id);
                if (id) {
                    $.ajax({
                        url: 'studentName/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                var value = data[0];
                                $('#roll').val(value.roll);
                            } else {
                                $('#roll').val('Student Already exists').css('color', 'red');
                            }
                        }

                    });
                }
            });

            // Initialize Select2 for the student_name dropdown
            $('#student_name').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });

        $('#bulding_id').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: 'buldingID/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#floor_id').empty();
                        $('#floor_id').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#floor_id').append('<option value="' + value.id + '">' + value
                                .floor_name + '</option>');
                        });
                    }
                });
            }
        });
        $('#floor_id').on('change', function() {
            var id = $(this).val();
            console.log(id);
            if (id) {
                $.ajax({
                    url: 'roomID/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#room_id').empty();
                        $('#room_id').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#room_id').append('<option value="' + value.id + '">' + value
                                .room_number + '--' + value
                                .seat_number + '</option>');
                        });
                    }
                });
            }
        });
        $('#room_id').on('change', function() {
            var id = $(this).val();
            console.log(id);
            if (id) {
                $.ajax({
                    url: 'roomInfo/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#bed_id').empty();
                        if (data.message) {
                            $('#bed_id').append(
                                '<option value="" style="color: red;">Seat already exists</option>'
                            );

                        } else {
                            // Populate the dropdown with seat options
                            $.each(data, function(key, value) {
                                $('#bed_id').append('<option value="' + value.id + '">' + value
                                    .seat_number + '</option>');
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            }
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#class').on('change', function() {
                var id = $(this).val();
                var depart_id = $("#department_id").val();
                if (id) {
                    $.ajax({
                        url: 'hostel_classInfo/' + id + '/' + depart_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $('#session').empty();
                            $('#session').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                if (value.session) {
                                    $('#session').append('<option  data="' + value
                                        .studentclass + '/' + value.session +
                                        '"value="' + value
                                        .session + '">' + value.session +
                                        '</option>');
                                } else if (value.session_year) {
                                    $('#session').append('<option data="' + value
                                        .class_id + '/' + value.session_year +
                                        '" value="' + value
                                        .session_year + '">' + value.session_year +
                                        '</option>');
                                }
                            });
                            $('#session').trigger('change');
                        }

                    });
                }
            });

            $('#session').change(function() {
                var userid = $(this).find('option:selected').attr('data');
                var depart_id = $("#department_id").val();
                $.ajax({
                    url: 'hostel_sessionInfo',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        userid: userid,
                        depart_id: depart_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#student_name').empty();
                        $('#student_name').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            if (value.name) {
                                $('#student_name').append('<option data="' + value
                                    .studentclass + '/' + value.id +
                                    '" value="' + value
                                    .id + '">' + value.name +
                                    '</option>');
                            } else if (value.student_name) {
                                $('#student_name').append('<option data="' + value
                                    .class_id + '/' + value.id +
                                    '" value="' + value
                                    .id + '">' + value.student_name +
                                    '</option>');
                            }
                        });
                        $('#student_name').trigger('change');
                    }
                });
            });

            $('#student_name').on('change', function() {
                var stu_id = $(this).find('option:selected').attr('data');
                var depart_id = $("#department_id").val();
                $.ajax({
                    url: 'hostel_studentInfo',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        stu_id: stu_id,
                        depart_id: depart_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        if (data.length > 0) {
                            var value = data[0];
                            if (value.roll == null) {
                                $('#roll').val(value.register_roll);
                            } else {
                                $('#roll').val(value.roll);
                            }
                            $('#registration').val(value.registration_no);
                            $('#mobile_no').val(value.mobile_no);
                            $('#blood_group').val(value.blood_group);
                            if (value.name) {
                                $('#stu_name').val(value.name);
                            } else if (value.student_name) {
                                $('#stu_name').val(value.student_name);
                            }
                        } else {
                            $('#roll').val('Student Roll Not Found').css('color', 'red');
                        }

                    }

                });

            });


            $('#student_name').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#session').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#bulding_id').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'buldingID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#floor_id').empty();
                            $('#floor_id').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#floor_id').append('<option value="' + value.id +
                                    '">' + value
                                    .floor_name + '</option>');
                            });
                        }
                    });
                }
            });
            $('#floor_id').on('change', function() {
                var id = $(this).val();
                // console.log(id);
                if (id) {
                    $.ajax({
                        url: 'roomID/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#room_id').empty();
                            $('#room_id').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#room_id').append('<option value="' + value.id +
                                    '">' + value
                                    .room_number + '--' + value
                                    .seat_number + '</option>');
                            });
                        }
                    });
                }
            });
            $('#room_id').on('change', function() {
                var id = $(this).val();
                // console.log(id);
                if (id) {
                    $.ajax({
                        url: 'roomInfo/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#bed_id').empty();
                            if (data.message) {
                                $('#bed_id').append(
                                    '<option value="" style="color: red;">Seat already exists</option>'
                                );

                            } else {
                                // Populate the dropdown with seat options
                                $.each(data, function(key, value) {
                                    $('#bed_id').append('<option value="' + value.id +
                                        '">' + value
                                        .seat_number + '</option>');
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log("Error: " + errorThrown);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.update-status-btn').on('click', function() {
                var btn = $(this);
                var recordId = btn.data('id');
                var currentStatus = btn.siblings('.status-label').data('status');
                var newStatus = currentStatus === 0 ? 1 : 0;
                $.ajax({
                    type: 'POST',
                    url: 'update-hostel-status',
                    data: {
                        id: recordId,
                        status: newStatus
                    },
                    success: function(response) {
                        btn.siblings('.status-label').data('status', newStatus);
                        btn.siblings('.status-label').text(newStatus === 0 ? 'Active' :
                            'Inactive');
                        btn.siblings('.status-label').css('color', newStatus === 0 ? 'green' :
                            'red');
                    },
                    error: function(error) {
                        console.log('Error updating status:', error);
                    }
                });
            });
        });
    </script>
@endsection
