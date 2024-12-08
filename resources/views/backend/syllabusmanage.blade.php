.
@extends('layouts.department')
@section('title', 'Syllabus Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Syllabus Manage</h2>
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
                                                <th>Title</th>
                                                <th>Session</th>
                                                <th>Year</th>
                                                <th>Publish Date</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->title }}</td>
                                                    <td>{{ $ndata->session }}</td>
                                                    <td> <?php $class = DB::table('studen_classes')
                                                        ->where('id', '=', $ndata->year)
                                                        ->get(); ?> @foreach ($class as $nclass)
                                                            {{ $nclass->name }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $ndata->publish_date }}</td>
                                                    <td class="text-center"><a href="{{ $ndata->details }}"><span
                                                                class="glyphicon glyphicon-download"></span> </a> </td>


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
                                        action="{{ url('department-syllabusereate') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Title" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="year" name="year">
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }}">{{ $nstudentclass->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="session" name="session"
                                                    placeholder="Session" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Publish Date</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="publish_date"
                                                    name="publish_date" placeholder="Publish Date" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="photo" class="col-sm-12 control-label">Description</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="description"
                                                    name="photo" placeholder="Enter Description" value="">


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
            $.get("{{ url('syllabusedit') }}" + '/' + id, function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#session').val(data.session);
                $('#year').val(data.year);
                $('#publish_date').val(data.publish_date);
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
                        url: 'academicmanage/' + id,
                        success: function(data) {
                            window.location = 'academicmanage';
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



        $('#atype').change(function() {
            var value = $(this).find('option:selected').val();

            if (value == 1) {



                var output = '';


                output +=
                    "<div class='form-group'><label for='name' class='col-sm-12 control-label'>Title</label><div class='col-sm-12'><input type='text' class='form-control' id='title' name='title' placeholder='Title' value=''  required=''></div> </div><div class='form-group'><label for='photo' class='col-sm-12 control-label'>Description</label><div class='col-sm-12'><input type='file' class='form-control' id='description' name='photo' placeholder='Enter Description' value=''  ></div></div>";
                $('#academic').html(output);





            } else {
                var output = '';
                $('#academic').html(output);
            }
        });





        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
@endsection
