@extends('layouts.hosapp')
@section('title', 'Seat List Information |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Seat List Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="{{ url('/hostel_seat_list_pdf') }}" id=""> Download PDF
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
                                                <th class="text-center">SL No.</th>
                                                <th class="text-center">Building Name</th>
                                                <th class="text-center">Floor Name</th>
                                                <th class="text-center">Total Room</th>
                                                <th class="text-center">Total Seat</th>
                                                <th class="text-center">Fillup Seat</th>
                                                <th class="text-center">Vacant Seat</th>
                                                {{-- <th width="280px">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($Floor as $ndata)
                                                {{-- @dd($Floor); --}}
                                                @php
                                                    $building = DB::table('hostel_buldings')
                                                        ->where('id', $ndata->bulding_id)
                                                        ->orderBy('id', 'asc')
                                                        ->first();

                                                    $roomCount = DB::table('hostel_rooms')
                                                        ->select('room_number')
                                                        ->where('floor_id', $ndata->id)
                                                        ->groupBy('room_number')
                                                        ->get()
                                                        ->count();

                                                    $seatCount = DB::table('hostel_rooms')
                                                        ->where('floor_id', $ndata->id)
                                                        ->count();

                                                    $seat = DB::table('hostel_seat_allotments')
                                                        ->where('floor_id', $ndata->id)
                                                        ->where('status', 0)
                                                        ->count();

                                                @endphp
                                                {{-- @dd($seat); --}}
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $building ? $building->bulding_name : '--' }}</td>
                                                    <td>{{ $ndata->floor_name }}</td>
                                                    <td class="text-center">{{ $roomCount ?: '0' }}</td>
                                                    <td class="text-center">{{ $seatCount ?: '0' }}</td>
                                                    <td class="text-center"
                                                        style="background-color:rgb(136, 217, 90); color:rgb(5, 5, 4); font-size:18px;">
                                                        {{ $seat ?: '0' }}</td>

                                                    <td class="text-center" style="color:red; font-size:18px;">
                                                        @if ($ndata->hostel_id == '15')
                                                            {{ $seatCount * 2 - $seat ?: '0' }}
                                                        @else
                                                            {{ $seatCount - $seat ?: '0' }}
                                                        @endif
                                                    </td>


                                                    {{-- <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </td> --}}
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
                                            <label for="name" class="col-sm-12 control-label">Name Of Bulding :</label>
                                            <select class="form-control" id="bulding_id" name="bulding_id" required>
                                                <option class="" value="0" selected>--Select --</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Floor :</label>
                                            <select class="form-control" id="floor_id" name="floor_id" required>
                                                <option class="" value="0" selected>--Select --</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Room Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="room_number"
                                                    name="room_number" placeholder="Room Number " value=""
                                                    maxlength="60" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Seat Number</label>
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
@endsection
