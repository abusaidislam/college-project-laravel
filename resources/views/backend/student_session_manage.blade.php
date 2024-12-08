@extends('layouts.department')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="{{ url('student-promote') }}" id=""> Student Promote
                        </a>
                    </span>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Class Information</h2>
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
                                            <tr class="text-center">
                                                <th>Student Name</th>
                                                <th>Session</th>
                                                <th>Class Name</th>
                                                <th>Class Year</th>
                                                <th>Department</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                {{-- @dd ($ndata); --}}
                                                @php
                                                    $studentName = DB::table('students')
                                                        ->where('id', $ndata->stu_id)
                                                        ->first();

                                                    $className = DB::table('studen_classes')
                                                        ->where('id', $ndata->class_name)
                                                        ->first();
                                                    // $depart = DB::table('studen_classes')
                                                    //     ->where('depart_id', $ndata->depart_id)
                                                    //     ->first();
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $studentName->name }}</td>
                                                    <td>{{ $ndata->session_year }}</td>
                                                    <td>{{ $className->name }}</td>
                                                    <td>{{ $ndata->class_year }}</td>
                                                    {{-- <td>{{ $depart->department }}</td> --}}
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
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
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('department-class.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Student Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="studentclass" name="studentclass">
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }}">
                                                            {{ $nstudentclass->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Session</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="session" name="session"
                                                    placeholder="Enter Session" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Class Year</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="session" name="session"
                                                    placeholder="Enter Session" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="studentclass" name="studentclass">
                                                    @foreach ($studentclass as $nstudentclass)
                                                        <option value="{{ $nstudentclass->id }}">
                                                            {{ $nstudentclass->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary" id="closemodal"
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
    </div>

    <script type="text/javascript">
        function hello() {
            alert('ok');
        }


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

            $.get("{{ route('department-class.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);

                $('#department').val(data.department);

            });
        });





        /*------------------------------------------
                   --------------------------------------------
                   Delete ndataInfo Code
                   --------------------------------------------
                   --------------------------------------------*/
        $('body').on('click', '#delete', function() {

            var id = $(this).data("id");
            var depart_id = $(this).data("depart_id");

            if (confirm("Are You sure want to delete This!")) {
                $.ajax({
                    type: "DELETE",
                    url: 'department-class/' + id,
                    success: function(data) {
                        window.location = 'department-class'
                    }

                });
            }
            return false;

        });

        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection
