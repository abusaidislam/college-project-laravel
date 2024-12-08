@extends('layouts.department')
@section('title', 'Mission and Vision Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mission and Vision Information</h2>
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
                                                <th>No.</th>
                                                <th>Title</th>
                                                <th>Photo</th>
                                                <th>Description</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">

                                            <tr id="row_list{{ $ndata->id }}">
                                                <td>1</td>
                                                <td>{{ $ndata->vision_title }}</td>
                                                @if ($ndata->vision_images === 'department/images/default.jpg')
                                                    <td> <img
                                                            src="{{ asset('public/department/images/' . $ndata->vision_images) }}"
                                                            alt="" width="80" height="80"></td>
                                                @else
                                                    <td> <img
                                                            src="{{ asset('public/department/images/' . $ndata->vision_images) }}"
                                                            alt="" width="80" height="80"></td>
                                                @endif

                                                <td>{!! $ndata->vision_details !!} </td>

                                                <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                        class="btn btn-sm btn-info">Edit</button>


                                                </td>

                                            </tr>

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
                                        action="{{ route('mission-vision.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Title" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-sm-12 control-label">Description</label>
                                            <div class="col-sm-12">
                                            <textarea class="summernote" placeholder="Enter Description" id="description"name="description"></textarea>
                                        </div>
                                        </div>



                                        <div id="click2edit"></div>



                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo (Dimensions:700x600,
                                                Max-Size:800kb)</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">
                                                <span class="text-danger">
                                                    @error('photo')
                                                        {{ $message }}
                                                    @enderror
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
            $.get("{{ route('mission-vision.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.vision_title);
                $('#description').summernote('code', data.vision_details);

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
                    url: 'mission-vision/' + id,
                    success: function(data) {
                        window.location = 'mission-vision'
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
