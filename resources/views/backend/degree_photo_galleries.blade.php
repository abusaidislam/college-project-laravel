@extends('layouts.degreeapp')
@section('title', 'Photo Gallery Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Photo Gallery Manage</h2>
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
                                        class="table table-striped table-bordered dt-responsive nowrap p-0"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>SL No.</th>
                                                <th class="text-center">Photo</th>
                                                <th class="text-center">Note</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                            <tr>
                                                <td>{{ $ndata->id }}</td>

                                                <td class="text-center"> <a
                                                        href="{{ asset('public/Photo_gallery/' . $ndata->photo) }}"><img
                                                            src="{{ asset('public/Photo_gallery/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80">

                                                    </a></td>
                                                <td class="text-center">{!! $ndata->note !!}</td>
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
                                        action="{{ route('degree_photo_galleries.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:1000x600, Max-Size:800kb):</label>
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
                                            <label for="name" class="col-sm-12 control-label">Note</label>
                                            <div class="col-sm-12">
                                                <textarea class="summernote form-control" id="note" name="note"
                                                    placeholder="note" value=""></textarea>
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
            $.get("{{ route('degree_photo_galleries.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#note').summernote('code', data.note);
                $('#photo').val(data.photo);
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
                        url: 'degree_photo_galleries/' + id,
                        success: function(data) {
                            window.location = 'degree_photo_galleries';
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