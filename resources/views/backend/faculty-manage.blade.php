@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Faculty Manage</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
                                                    <th>Faculty Name</th>
                                                    <th width="280px" align="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list">
                                                @foreach ($data as $basic)
                                                    <tr id="row_list{{ $basic->id }}">
                                                        <td>{{ $basic->id }}</td>
                                                        <td>{{ $basic->name }}</td>
                                                        <td>
                                                            <button type="button" id="edit"
                                                                data-id="{{ $basic->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>

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
                                            action="{{ route('faculty.store') }}" enctype="multipart/form-data">
                                            @csrf()
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-4 control-label">Faculty
                                                    Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter Faculty Name" value="" maxlength="50"
                                                        required="">
                                                </div>
                                            </div>
                                            <div class=" col-sm-offset-2 col-sm-10 my-2">
                                                <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                                <button type="button" class="btn btn-primary" id="close"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
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

        /*   Click to Edit Button
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('faculty.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);

            });
        });
        $('#close').click(function() {
            $('#ajaxModel').modal('hide');
        });

        $('body').on('click', '#delete', function() {

            var id = $(this).data("id");
            var name = $(this).data("name");
            confirm("Are You sure want to delete !" + name);

            $.ajax({
                type: "DELETE",
                url: 'usermanage/' + id,
                success: function(data) {
                    window.location = 'usermanage'
                }

            });
        });
    </script>
@endsection
