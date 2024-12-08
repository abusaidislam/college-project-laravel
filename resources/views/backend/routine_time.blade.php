@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Exam Routine Time Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Routine Time Information</h2>
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
                                                <th>Exma Name</th>
                                                <th>Morning<br>Start Time</th>
                                                <th>Morning<br>End Time</th>
                                                <th>Afternoon<br>Start Time</th>
                                                <th>Afternoon<br>End Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                @php
                                                    $examName = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_name)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $examName ? $examName->title : '' }} </td>
                                                    <td>{{ $ndata->time_1 }} </td>
                                                    <td>{{ $ndata->time_2 }}</td>
                                                    <td>{{ $ndata->time_3 }}</td>
                                                    <td>{{ $ndata->time_4 }}</td>
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
                                action="{{ route('routinetime.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="exam_name" class="col-sm-12 control-label">Exam Name:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="exam_name" name="exam_name">
                                            <option value="" selected>--Select Exam Name--</option>
                                            @foreach ($examname as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="time1" class="col-sm-12 control-label">Morning Start Time</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="time1" name="time1"
                                            placeholder="Morning Start Time" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="time2" class="col-sm-12 control-label">Morning End Time</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="time2" name="time2"
                                            placeholder="Morning End Time" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-12 control-label">Afternoon Start Time</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="time3" name="time3"
                                            placeholder="Start Time" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-12 control-label">Afternoon End Time</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="time4" name="time4"
                                            placeholder="End Time" value="" required="">
                                    </div>
                                </div>


                                <div class=" col-sm-offset-2 col-sm-10 my-2">

                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-danger" id="close"data-bs-dismiss="modal"
                                        aria-label="Close">
                                        close
                                    </button>
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
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('routinetime.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#exam_name').val(data.exam_name);
                $('#time1').val(data.time_1);
                $('#time2').val(data.time_2);
                $('#time3').val(data.time_3);
                $('#time4').val(data.time_4);
            })
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
                        url: 'routinetime/' + id,
                        success: function(data) {
                            window.location = 'routinetime';
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
