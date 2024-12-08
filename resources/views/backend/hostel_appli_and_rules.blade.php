@extends('layouts.hosapp')
@section('title', 'Hostel Application & Rules Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hostel Application & Rules Information</h2>
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
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @if (pathinfo($ndata->photo, PATHINFO_EXTENSION) === 'pdf')
                                                        <td>
                                                            <object
                                                                data="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                                type="application/pdf" width="80" height="80">

                                                            </object>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <img src="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                                alt="" width="80" height="80">
                                                        </td>
                                                    @endif
                                                    <td>{{ $ndata->title }}</td>
                                                    <td>
                                                        {{ $ndata->type === 1 ? 'Application From' : 'Rules & Regulations' }}
                                                    </td>

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
                                        action="{{ route('hostel-application-rules.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="hostel_name" class="col-sm-12 control-label">Hostel Name :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="hostel_name" name="hostel_name"required>
                                                {{-- <option class="" value="0">--Select --</option> --}}
                                                @foreach ($hostelName as $item)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type" class="col-sm-12 control-label">Content Type :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="type" name="type"required>
                                                <option class="" value="0" selected>--Select --</option>
                                                <option value="1">Application From</option>
                                                <option value="2">Rules & Regulations</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-sm-12 control-label">Title
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Enter Title " value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-3 control-label">Photo</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">
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

        });


        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('hostel-application-rules.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#hostel_id').val(data.hostel_name);
                $('#type').val(data.type);
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
                        url: 'hostel-application-rules/' + id,
                        success: function(data) {
                            window.location = 'hostel-application-rules';
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
