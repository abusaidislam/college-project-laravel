{{-- @if (Auth::user()->role === '7')
@elseif(Auth::user()->role === '10')
@extends('layouts.drexamapp')
@endif --}}
@extends('layouts.examapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Attendence Manage</h2>
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
                                        <thead style="height: -10px">
                                            <tr>
                                                <th rowspan="3">No.</th>
                                                <th rowspan="3">Photo</th>
                                                <th rowspan="3">Student<br>Name</th>
                                                <th rowspan="3">Exam<br>name</th>
                                                <th rowspan="3">Roll<br>No.</th>
                                                <th rowspan="3">Regi.<br>No.</th>
                                                <th colspan="9" style="text-align: center">Signature</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                @foreach ($exam_routine as $item)
                                                    <th>{{ $item->date }}</th>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                @foreach ($couse_name as $item)
                                                    <th>{{ $item->course_code }}</th>
                                                @endforeach

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $student)
                                                <tr>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->roll }}</td>
                                                    <td>{{ $student->roll }}</td>
                                                    <td>{{ $student->registration_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

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
                                action="{{ route('exam_attendence.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Student Name: </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="student_name" name="student_name"
                                            placeholder="Student Name" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>

                                    <select class="form-control" id="exam_name" name="exam_name">
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($examname as $nexamname)
                                            <option value="{{ $nexamname->title }}">{{ $nexamname->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="Roll" class="col-sm-12 control-label">Roll</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="roll" name="roll"
                                            placeholder="Roll" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Registration" class="col-sm-12 control-label">Registration</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="registration" name="registration"
                                            placeholder="Registration" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><strong>Course Name:</strong></label>
                                    <input type="text" class="form-control" placeholder="Enter Message"
                                        id="course_name"name="course_name">
                                </div>

                                <div class="form-group">

                                    <label for="photo" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            placeholder="Enter Photo" value="">


                                    </div>

                                    <div class=" col-sm-offset-2 col-sm-10 my-2">

                                        <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                        <button type="button" class="btn btn-primary"
                                            id="close"data-bs-dismiss="modal" aria-label="Close">
                                            close
                                        </button>
                                    </div>
                            </form>
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
                $.get("{{ route('exam_attendence.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#student_name').val(data.student_name);
                    $('#exam_name').val(data.exam_name);
                    $('#registration.').val(data.registration);
                    $('#roll').val(data.roll);
                    $('#course_name').val(data.course_name);

                })
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
                        url: 'exam_attendence/' + id,
                        success: function(data) {
                            window.location = 'exam_attendence'
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
