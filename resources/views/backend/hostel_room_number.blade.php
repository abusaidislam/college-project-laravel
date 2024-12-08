@extends('layouts.hosapp')
@section('title', 'Room Number Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Room Number Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
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
                                                <th>SL No.</th>
                                                <th>Bulding Name</th>
                                                <th>Floor Name</th>
                                                <th>Room Number</th>
                                                <th>Seat Number</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $bulding = DB::table('hostel_buldings')
                                                        ->where('id', $ndata->bulding_id)
                                                        ->first();
                                                    $floor = DB::table('hostel_floors')
                                                        ->where('id', $ndata->floor_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $bulding ? $bulding->bulding_name : '' }}</td>
                                                    <td>{{ $floor ? $floor->floor_name : '' }}</td>
                                                    <td>{{ $ndata->room_number }}</td>
                                                    <td>{{ $ndata->seat_number }}</td>

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
                                                <div class="col-sm-12">
                                            <select class="form-control" id="bulding_id" name="bulding_id" required>
                                                <option value=" " selected>--Select--</option>
                                                @foreach ($buldingName as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bulding_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="floor_id" class="col-sm-12 control-label">Name Of Floor:</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="floor_id" name="floor_id" required>
                                                <option class="" value=" " selected>--Select --</option>

                                            </select>

                                        </div>
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
                                            <button type="button" class="btn btn-danger " id="close"
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
                $('#floor_id').val(data.floor_id).trigger('change');
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
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'hostel-room-number/' + id,
                        success: function(data) {
                            window.location = 'hostel-room-number';
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
