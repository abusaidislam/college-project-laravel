@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Duty Roaster Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Duty Roaster Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success " href="javascript:void(0)" id="exprotModel">Export PDF
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="javascript:void(0)" id="exprotModel1"> Single Date SMS Send
                                    </a>
                                </span>
                            </li>
                            OR &nbsp;
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel2">All Date SMS Send
                                    </a>
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
                                        class="table table-striped table-bordered dt-responsive wrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Exam Name</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Duty Date</th>
                                                <th>Send Sms</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                @php
                                                    $examName = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $examName ? $examName->title : '' }}</td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->department }}</td>
                                                    <td>{{ $ndata->designation }}</td>
                                                    <td>{{ $ndata->email }}</td>
                                                    <td>{{ $ndata->mobile }}</td>
                                                    <td>
                                                        @if ($ndata->duty_date)
                                                            @php
                                                                $decodedData = json_decode($ndata->duty_date, true);
                                                            @endphp

                                                            @foreach ($decodedData as $date => $value)
                                                                @if ($value == 1)
                                                                    {{ $date }},
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            No duty
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-primary " href="javascript:void(0)"
                                                                id="exprotModel3">Send
                                                            </a>
                                                        </span>
                                                        {{-- <a href="{{ url('sendsms', $ndata->id) }}" class="btn btn-info">
                                                            Send
                                                        </a> --}}
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
            {{-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" class="form-horizontal"
                                action="{{ route('examdutyroaster.store') }}">
                                @csrf()

                                <input type="hidden" name="id" id="id">

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
                                    <label for="name" class="col-sm-12 control-label">Professor Name: </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Professor Name" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="designation" class="col-sm-12 control-label">Designation: </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="designation" name="designation"
                                            placeholder="Designation" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="department" class="col-sm-12 control-label">Department:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="department" name="department"
                                            placeholder="Department Name" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-12 control-label">Email Address:</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="department" name="email"
                                            placeholder="Email Address" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duty_date" class="col-sm-12 control-label">Duty Date:</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="duty_date" name="duty_date"
                                            placeholder="Duty Date" value="" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duty_time" class="col-sm-12 control-label">Duty Time:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="duty_time" name="duty_time"
                                            placeholder="Duty Time" value="" required="">
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">

                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-primary" id="close"data-bs-dismiss="modal"
                                        aria-label="Close">
                                        close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="modal fade" id="pdfModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" action="{{ url('duty_roster/export-pdf') }}"
                                enctype="multipart/form-data">
                                @csrf()


                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="exam_id" name="exam_id">
                                            <option class="" value="0" selected>--Select --</option>
                                            @foreach ($examname as $nexamname)
                                                <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="first_time" class="col-sm-12 control-label">First Time :</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" name="first_time" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end_time" class="col-sm-12 control-label">End Time :</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" name="end_time" required>
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel" aria-label="Close">
                                        close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sendModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" action="{{ url('duty_roaster/sms_send') }}"
                                enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="examid" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="examid" name="examid">
                                            <option class="" value="0" selected>--Select --</option>
                                            @foreach ($examname as $nexamname)
                                                <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duty_date" class="col-sm-12 control-label">Duty Date :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="duty_date" name="duty_date">
                                            <option class="" value="0" selected>--Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="duty_time" class="col-sm-12 control-label">Duty Time :</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" name="duty_time" required>
                                    </div>
                                </div>
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Send</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel1"
                                        aria-label="Close">
                                        close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sendModel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form"
                                action="{{ url('duty_roaster/all_sms_send') }}" enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="examId" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="examId" name="examId">
                                            <option class="" value="0" selected>--Select --</option>
                                            @foreach ($examname as $nexamname)
                                                <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="duty_time" class="col-sm-12 control-label">Duty Time :</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" name="duty_time" required>
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Send</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel2"
                                        aria-label="Close">
                                        close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="sendModel3" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form"
                                action="{{ url('sendsms') }}" enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="duty_time" class="col-sm-12 control-label">Duty Time :</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" name="duty_time" required>
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Send</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel3"
                                        aria-label="Close">
                                        close </button>
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
            $('#exprotModel').click(function() {
                $('#pdfModel').modal('show');
                $('#modelHeading').html("Create New");
                $('#form').trigger("reset");
                $('#saveBtn').html('Save');
                $('#id').val('');
            });
            $('#exprotModel1').click(function() {
                $('#sendModel').modal('show');
                $('#modelHeading').html("Create New");
                $('#form').trigger("reset");
                $('#saveBtn').html('Save');
                $('#id').val('');
            });
            $('#exprotModel2').click(function() {
                $('#sendModel2').modal('show');
                $('#modelHeading').html("Create New");
                $('#form').trigger("reset");
                $('#saveBtn').html('Save');
                $('#id').val('');
            });
            $('#exprotModel3').click(function() {
                $('#sendModel3').modal('show');
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
                $.get("{{ route('examdutyroaster.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#exam_name').val(data.exam_name);
                    $('#name').val(data.name);
                    $('#designation.').val(data.designation);
                    $('#department').val(data.department);
                    $('#email').val(data.email);
                    $('#duty_date').val(data.duty_date);
                    $('#duty_time').val(data.duty_time);

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
                        url: 'examdutyroaster/' + id,
                        success: function(data) {
                            window.location = 'examdutyroaster';
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
            $('#closepdfmodel').click(function() {
                $('#pdfModel').modal('hide');
            });
            $('#closepdfmodel1').click(function() {
                $('#sendModel').modal('hide');
            });
            $('#closepdfmodel2').click(function() {
                $('#sendModel2').modal('hide');
            });
            $('#closepdfmodel3').click(function() {
                $('#sendModel3').modal('hide');
            });

            $('#examid').on('change', function() {
                var id = $(this).val();
                // console.log(id);
                if (id) {
                    $.ajax({
                        url: 'duty_examinfo/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#duty_date').empty();
                            $('#duty_date').append('<option value="">--Select--</option>');
                            if (data.examdrDate.length > 0) {
                                $.each(data.examdrDate, function(key, value) {
                                    $('#duty_date').append('<option value="' + value.date + '">' +
                                        value.date + '</option>');
                                });
                            }
                            if (data.examDate.length > 0) {
                                $.each(data.examDate, function(key, value) {
                                    $('#duty_date').append('<option value="' + value.date + '">' +
                                        value.date + '</option>');
                                });
                            }

                        }
                    });
                }
            });
        </script>
    @endsection
