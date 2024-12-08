@extends('layouts.app')
@section('title', 'Libration War Manage |')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Libration War Manage</h2>
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
                                                    <th>No.</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list">
                                                @foreach ($data as $ndata)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $ndata->title }}</td>
                                                        <td><img src="{{ asset('public/Bangabandhu/' . $ndata->image) }} "
                                                                alt="" width="80" height="80"> </td>
                                                        <td>{!! $ndata->description !!} </td>
                                                        <td><button type="button" id="edit"
                                                                data-id="{{ $ndata->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>
                                                            <button type="button" id="delete"
                                                                data-id="{{ $ndata->id }}"
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
                                            action="{{ route('bangabandhumanage.store') }}" enctype="multipart/form-data">
                                            @csrf()
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-12 control-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Title" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-12 control-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="summernote" placeholder="Enter description" id="description"name="description"></textarea>
                                                </div>
                                            </div>
                                            <div id="click2edit"></div>
                                            <div class="form-group">
                                                <label for="image" class="col-sm-12 control-label">Image</label>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        placeholder="Enter Photo" value="">
                                                    <input type="hidden" name="hidden_image" id="hidden_image">
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
            $.get("{{ route('bangabandhumanage.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.title);
                $('#description').summernote('code', data.description);
                $('#image').val(data.image);
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
                        url: 'bangabandhumanage/' + id,
                        success: function(data) {
                            window.location = 'bangabandhumanage';
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
