@extends('layouts.hosapp')
@section('title', 'Hostel General Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hostel General Information</h2>
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
                                                <th>Photo</th>
                                                <th>Hostel Name</th>
                                                <th>Total Seat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $hostName = DB::table('users')
                                                        ->where('id', $ndata->hostel_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $hostName ? $hostName->name : '' }}</td>
                                                    <td>{{ $ndata->total_seat }}</td>
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
                                        action="{{ route('hostel-general-info.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="hostel_name" class="col-sm-12 control-label">Hostel Name :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="hostel_name" name="hostel_name"required>
                                                <option class="" value="0" selected>--Select --</option>
                                                @foreach ($hostelName as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="total_seat" class="col-sm-12 control-label">Total Seat
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="total_seat" name="total_seat"
                                                    placeholder="Enter Total Seat" value="" maxlength="50"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:1200x1000,
                                                Max-Size:800kb)</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">
                                                <img id="uploaded_image" src="" height="100px" width="100px">
                                                <span class="text-danger">
                                                    @error('photo')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <img id="uploaded_image" src="" height="100px" width="100px"> --}}
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
            $('#uploaded_image').hide();
        });


        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('hostel-general-info.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#hostel_name').val(data.hostel_id);
                $('#total_seat').val(data.total_seat);
                $('#uploaded_image').show();
                $('#uploaded_image').attr('src', 'public/hostel_card/' + data.photo);

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
                        url: 'hostel-general-info/' + id,
                        success: function(data) {
                            window.location = 'hostel-general-info';
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
@endsection
