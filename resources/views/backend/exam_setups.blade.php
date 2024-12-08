@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Exam Vigilance Team Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Vigilance Team Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                             </li>
                             <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotPdfModel">Export PDF
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
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name And Designation</th>
                                                <th>Department</th>
                                                <th>Exam Name</th>
                                                <th>Duty Date</th>
                                                <th>Bulding</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                {{-- @dd($ndata); --}}
                                                @php
                                                    $examName = DB::table('exam_names')
                                                        ->where('id', '=', $ndata->exam_name)
                                                        ->first();
                                                    $examDate = DB::table('exam_routines')
                                                        ->where('id', '=', $ndata->duty_date)
                                                        ->first();
                                                    $drexamDate = DB::table('exam_dr_routines')
                                                        ->where('id', '=', $ndata->duty_date)
                                                        ->where('user_id', '=', $ndata->user_id)
                                                        ->first();
                                                    $departments = DB::table('departments')
                                                        ->where('id', '=', $ndata->department)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ndata->teacher }}<br>{{ $ndata->designation }}
                                                    </td>
                                                    @if ($ndata->department == '40')
                                                        <td>Department of Degree</td>
                                                    @else
                                                        <td>{{ $departments ? $departments->name : '' }}</td>
                                                    @endif
                                                    <td>{{ $examName ? $examName->title : '' }}</td>
                                                    @if ($userType->usertype == 7)
                                                        <td>{{ $examDate ? $examDate->date : '' }}</td>
                                                    @else
                                                        <td>{{ $drexamDate ? $drexamDate->date : '' }}</td>
                                                    @endif
                                                    <td>{{ $ndata->bulding }}</td>

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
                                action="{{ route('exam_setupplan.store') }}" enctype="multipart/form-data">

                                {!! csrf_field() !!}

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control exam_name" id="exam_name" name="exam_name" required>
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
                                    <select class="js-select2 duty_date" id="duty_date" name="duty_date" required>
                                        <option class="" value="0" selected>--Select --</option>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Department :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control" id="department" name="department" required="">
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($department as $ndepartment)
                                            <option value="{{ $ndepartment->id }}">{{ $ndepartment->name }}</option>
                                        @endforeach
                                        <option value="40">{{ $genarelDepart->name }}
                                        </option>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Teacher :</label>
                                    <div class="col-sm-12">
                                    <select class="js-select2" id="teacher" name="teacher" required="">
                                        <option class="" value="0" selected>--Select --</option>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="designation" class="col-sm-12 control-label">Designation :</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Enter Designation"
                                        name="designation" id="designation" required>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Bulding Name :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control" id="buldingname" name="buldingname" required="">
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($buldingname as $nbuldingname)
                                            <option value="{{ $nbuldingname->building_name }}">
                                                {{ $nbuldingname->building_name }}</option>
                                        @endforeach
                                    </select>

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
            <div class="modal fade" id="pdfModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form"
                                action="{{ url('exam_setups_duty/export-pdf') }}" enctype="multipart/form-data">
                                @csrf()


                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control exam_name" id="exam_name" name="exam_name" required>
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
                                    <select class="form-control duty_date" id="duty_date" name="duty_date" required>
                                        <option class="" value="0" selected>--Select --</option>
                                    </select>
                                </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel"
                                        aria-label="Close"> close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pdfModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form"
                                action="{{ url('master_duty_roster/export-pdf') }}" enctype="multipart/form-data">
                                @csrf()


                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="exam_id" name="exam_id">
                                            <option class="" value="0" selected>--Select --</option>
                                            {{-- @foreach ($examname as $nexamname)
                                                <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel"
                                        aria-label="Close"> close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container">









            </div>
        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        $('#exprotPdfModel').click(function() {
            $('#pdfModel').modal('show');
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
            $.get("{{ route('exam_setupplan.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#exam_name').val(data.exam_name);
                $('#department').val(data.department);
                $('#teacher').val(data.teacher).trigger('change');
                $('#buldingname').val(data.bulding);
                $('#designation').val(data.designation);
                $('#duty_date').val(data.duty_date).trigger('change');
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
                        url: 'exam_setupplan/' + id,
                        success: function(data) {
                            window.location = 'exam_setupplan';
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
    </script>
    <script>
        $(document).ready(function() {
            $('.exam_name').on('change', function() {
                var exam_id = $(this).val();
                if (exam_id) {
                    $.ajax({
                        url: 'exam_Info/' + exam_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $('.duty_date').empty();
                            $('.duty_date').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('.duty_date').append('<option value="' + value.id +
                                    '">' + value.date + '</option>');
                            });
                            $('.duty_date').trigger('change');
                        }

                    });
                }

            });
            $('#department').on('change', function() {
                var depart_id = $(this).val();
                if (depart_id) {
                    $.ajax({
                        url: 'departInfo/' + depart_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $('#teacher').empty();
                            $('#teacher').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                $('#teacher').append('<option value="' + value.name +
                                    '">' + value.name + '</option>');
                            });
                            $('#teacher').trigger('change');
                        }

                    });
                }

            });
            $('#teacher').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
            $('#duty_date').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
