@extends('layouts.drexamapp')
@section('title', 'Exam Routing Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Routing Information</h2>
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
                                        class="table table-striped table-bordered dt-responsive" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Exam Name</th>
                                                <th>Date/Day <br>Time</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                @php
                                                    $examinfo = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $examinfo ? $examinfo->title : '' }}</td>
                                                    <td>{{ $ndata->date }}<br>{{ $ndata->day }}<br>{{ $ndata->exam_time }}
                                                    </td>
                                                    <td>{{ $ndata->course_name }}</td>
                                                    <td>{{ $ndata->course_code }}</td>

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
                                action="{{ route('dr_exam_routine.store') }}" enctype="multipart/form-data">
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
                                    <label for="date" class="col-sm-12 control-label">Exam Date:</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="datename" name="date"
                                            placeholder="Date" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Roll" class="col-sm-12 control-label">Exam Day:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="day" name="day"
                                            placeholder="Day" value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exam_time" class="col-sm-12 control-label">Exam Time:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="exam_time" name="exam_time"
                                            placeholder="Enter Exam Time" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_name" class="col-sm-12 control-label">Course Name:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="course_name" name="course_name" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="course_code" class="col-sm-12 control-label">Course Code</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="course_code" name="course_code" rows="5"></textarea>
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
                $.get("{{ route('dr_exam_routine.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#datename').val(data.date);
                    $('#day').val(data.day);
                    $('#exam_name').val(data.exam_id);
                    $('#exam_time').val(data.exam_time);
                    $('#course_name').val(data.course_name);
                    $('#course_code').val(data.course_code);


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
                        url: 'dr_exam_routine/' + id,
                        success: function(data) {
                            window.location = 'dr_exam_routine';
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
        <script>
            $('#datename').change(function() {
                let fulldate = $(this).val();
                var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                var a = new Date(new Date(fulldate).toLocaleString('en', {
                    timeZone: 'Asia/Dacca'
                }));
                $("#day").val(weekday[a.getDay()])
            })
        </script>
    @endsection
