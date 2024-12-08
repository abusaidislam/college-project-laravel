@extends('layouts.hosapp')
@section('title', 'Hostel Head Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hostel Head Information</h2>
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
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $ndata->hostel_name }}</td>
                                                    <td>{{ $ndata->title }}</td>
                                                    @if ($ndata->dept_name == '40')
                                                        <td>Department of General</td>
                                                    @else
                                                        <td>{{ $ndata->dept_name }}</td>
                                                    @endif
                                                    <td>{{ $ndata->designation }}</td>
                                                    <td>{{ $ndata->mobile }}</td>
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
                                        action="{{ route('hostel-head-info.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="dept_name" class="col-sm-12 control-label">Department Name :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="dept_name" name="dept_name"required>
                                                <option class="" value="" selected>--Select --</option>
                                                @foreach ($department as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                                <option value="40">{{ $genarelDepart->name }}
                                                </option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hostel_name" class="col-sm-12 control-label">Hostel Name :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="hostel_name" name="hostel_name"required>
                                                <option class="" value="" selected>--Select --</option>
                                                @foreach ($hostelName as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title" class="col-sm-12 control-label">Hostel Head Name
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Enter Hostel Head Name " value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Designation
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation" placeholder="Enter Designation " value=""
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class="col-sm-12 control-label">Mobile Number
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    placeholder="Enter Mobile Number " value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:530x650, Max-Size:200kb)</label>
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
            $.get("{{ route('hostel-head-info.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#hostel_name').val(data.hostel_name);
                $('#dept_name').val(data.dept_name);
                $('#designation').val(data.designation);
                $('#mobile').val(data.mobile);
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
                        url: 'hostel-head-info/' + id,
                        success: function(data) {
                            window.location = 'hostel-head-info';
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
