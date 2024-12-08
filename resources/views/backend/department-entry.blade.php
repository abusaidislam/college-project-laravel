@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Department Manage</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
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
                                                    <th>Department Name </th>
                                                    <th>Department Code </th>
                                                    <th>Email / Login Id</th>
                                                    <th> Faculty </th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list">
                                                @foreach ($data as $ndata)
                                                    <tr id="row_list{{ $ndata->id }}">
                                                        <td> {{ $loop->iteration }} </td>
                                                        <td> {{ $ndata->name }} </td>
                                                        <td> {{ $ndata->code }} </td>
                                                        <td> {{ $ndata->email }} </td>
                                                        <?php $faculty = DB::table('faculties')
                                                            ->where('id', $ndata->faculty)
                                                            ->get(); ?>
                                                        <td>
                                                            @foreach ($faculty as $nfaculty)
                                                                {{ $nfaculty->name }}
                                                            @endforeach
                                                        </td>

                                                        <td class="text-center">
                                                            <button type="button" id="edit"
                                                                data-id="{{ $ndata->id }}"
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
                                    action="{{ route('department-entry.store') }}" enctype="multipart/form-data">
                                    @csrf()

                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Department Name </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Department Name" value="" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Department Code </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="code" name="code"
                                                placeholder="Department Code" value="" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Email / Login Id </label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Id" value="" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Password </label>
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Faculty </label>
                                        <div class="col-sm-12">
                                            <select name="faculty" id="faculty" class="form-control">
                                                <option value="">Select Faculty </option>

                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}"> {{ $faculty->name }} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class=" col-sm-offset-2 col-sm-10 my-2">
                                        <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                        <button type="button" class="btn btn-primary" id="close"
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
            $('#form').trigger("reset");
        });


        /*   Click to Edit Button
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('department-entry.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $("#email").val(data.email);
                $("#password").val(data.text_password);
                $("#code").val(data.code);
                $("#faculty").val(data.faculty);
            });
        });

        $('#close').click(function() {
            $('#ajaxModel').modal('hide');
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
                    url: 'department-entry/' + id,
                    success: function(data) {
                        window.location = 'department-entry';
                    }

                });
            }
            return false;
        });
    </script>
@endsection
