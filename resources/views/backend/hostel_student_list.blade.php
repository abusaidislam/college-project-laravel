@extends('layouts.hosapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="{{ url('/hostel_student_list_pdf') }}" id=""> Download
                            PDF
                        </a>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student Information</h2>
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
                                                <th>Student Name</th>
                                                <th>Department</th>
                                                <th>Roll</th>
                                                <th>Session</th>
                                                <th>Bulding Name</th>
                                                <th>Floor Name</th>
                                                <th>Room Number</th>
                                                <th>Seat Number</th>
                                                <th>Payment Amount</th>
                                                <th>Chack in Date</th>
                                                <th>Chack Out Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($hostelStudent as $ndata)
                                                @php
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
                                                    $stu_name = DB::table('students')
                                                        ->where('id', $ndata->id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                            alt="" width="80" height="80"></td>
                                                    <td>{{ $stu_name ? $stu_name->name : '' }}</td>
                                                    <td>{{ $depart ? $depart->name : '' }}</td>
                                                    <td>{{ $ndata->roll }}</td>
                                                    <td>{{ $ndata->session }}</td>
                                                    <td>{{ $building ? $building->bulding_name : '' }}</td>
                                                    <td>{{ $floor ? $floor->floor_name : '' }}</td>
                                                    <td>{{ $room ? $room->room_number : '' }}</td>
                                                    <td>{{ $seat ? $seat->seat_number : '' }}</td>
                                                    <td>{{ $ndata->payment_amount }}</td>
                                                    <td>{{ $ndata->check_in_date }}</td>
                                                    <td>{{ $ndata->check_out_date }}</td>
                                                    <td>
                                                        <a href="{{ url('studentreceipt', $ndata->id) }}"
                                                            class="btn btn-info"><span
                                                                class="glyphicon glyphicon-plus-sign"></span></a>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                        <a href="{{ url('studentreceiptdow', $ndata->id) }}">dow</a>
                                                    </td>
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
                                        action="{{ route('hostel-room-number.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="bulding_id" class="col-sm-12 control-label">Name Of
                                                Building:</label>
                                            <select class="form-control" id="bulding_id" name="bulding_id" required>
                                                <option value="0" selected>--Select--</option>
                                                {{-- @foreach ($buldingName as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bulding_name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="floor_id" class="col-sm-12 control-label">Name Of Floor:</label>

                                            <select class="form-control" id="floor_id" name="floor_id" required>
                                                <option class="" value="0" selected>--Select --</option>

                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="room_number" class="col-sm-12 control-label">Room Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="room_number"
                                                    name="room_number" placeholder="Room Number " value=""
                                                    maxlength="60" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seat_number" class="col-sm-12 control-label">Seat Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="seat_number"
                                                    name="seat_number" placeholder="Seat Number " value=""
                                                    maxlength="60" required="">
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary " id="close"
                                                data-bs-dismiss="modal" aria-label="Close">Close</button>
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
            $.get("{{ route('hostel-room-number.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#bulding_id').val(data.bulding_id);
                $('#floor_id').val(data.floor_id);
                $('#room_number').val(data.room_number);
                $('#seat_number').val(data.seat_number);


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
                    url: 'hostel-room-number/' + id,
                    success: function(data) {
                        window.location = 'hostel-room-number'
                    }

                });
            }
            return false;


        });


        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
    <script type="text/javascript">
        $('#bulding_id').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: 'buldingInfo/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#floor_id').empty();
                        $.each(data, function(key, value) {
                            $('#floor_id').append('<option value="' + value.id + '">' + value
                                .floor_name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
