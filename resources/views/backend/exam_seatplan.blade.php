@extends('layouts.examapp')
@section('title', 'Seat Plan Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Seat Plan Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Show Seat Plan
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-danger" href="javascript:void(0)" id="exprotModel2">Delete Seat Plan
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-dark " href="javascript:void(0)" id="exprotModel3">Show Seat Card
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
                                                <th>SL No.</th>
                                                <th>Exam Name</th>
                                                <th>Room No</th>
                                                <th>Department Name</th>
                                                <th>Class Name</th>
                                                <th>Roll</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($seatplandata as $ndata)
                                                @php
                                                    $exam_data = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_id)
                                                        ->first();
                                                    $room_data = DB::table('room_no')
                                                        ->where('id', $ndata->room_num)
                                                        ->first();
                                                    $depart_data = DB::table('departments')
                                                        ->where('id', $ndata->depart_id)
                                                        ->first();
                                                    $class_data = DB::table('studen_classes')
                                                        ->where('id', $ndata->class_id)
                                                        ->first();
                                                @endphp
                                                {{-- @dd($room_data); --}}
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $exam_data ? $exam_data->title : '' }}</td>
                                                    <td>{{ $room_data->title }}</td>
                                                    @if ($ndata->depart_id == 40)
                                                        <td>Department of Degree</td>
                                                    @else
                                                        <td>{{ $depart_data ? $depart_data->name : '' }}</td>
                                                    @endif
                                                    <td>{{ $class_data ? $class_data->name : '' }}</td>
                                                    <td>{{ $ndata->roll }}</td>
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
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
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('exam_seatplan.store') }}">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">

                                        @php $currentYear =  date('Y'); @endphp

                                        <div class="form-group">
                                            <label for="room_num" class="col-sm-12 control-label">Name Of Room :</label>
                                            @php
                                                $room_numbers = DB::table('seat_plans')->pluck('room_num')->unique()->toArray();
                                            @endphp
                                            {{-- @dd($room_numbers); --}}
                                            <div class="col-sm-12">
                                            <select class="form-control" id="room_num" name="room_num">
                                                <option value="0" selected>--Select--</option>
                                                @foreach ($data as $room)
                                                    {{-- @unless (in_array($room->id, $room_numbers)) --}}
                                                    <option totalColumn ="{{ $room->total_row }}"
                                                        per-seat-bench="{{ $room->student_per_bench }}"
                                                        data-value="{{ $room->number_bench }}"
                                                        value="{{ $room->id }}">{{ $room->title }}
                                                    </option>
                                                    {{-- @endunless --}}
                                                @endforeach
                                            </select>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="total_row" class="col-sm-12 control-label">Total Cloumn :</label>
                                            <div class="col-sm-12">
                                            <input type="number" readonly class="form-control" id="total_row"
                                                name="total_row" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Student Per Bench
                                                :</label>
                                            <div class="col-sm-12">
                                            <input type="number" readonly class="form-control" id="perBench"
                                                name="perBench" value="{{ $room_details->student_per_bench }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ending_roll" class="col-sm-12 control-label">Total Seat</label>
                                            <div class="col-sm-12">
                                            <input type="number" class="form-control" id="total_seat" readonly
                                                name="total_seat" placeholder="Total Seat" value="" required="">

                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control exam_id" id="exam_id" name="exam_id">
                                                <option class="" value="0" selected>--Select --</option>
                                                @foreach ($examname as $nexamname)
                                                    <option value="{{ $nexamname->id }}">{{ $nexamname->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="duty_date" class="col-sm-12 control-label">Exam Date :</label>
                                            <div class="col-sm-12">
                                            <select class="js-select2 duty_date" id="duty_date" name="duty_date"
                                                required>
                                                <option class="" value="0" selected>--Select --</option>

                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="depart_id" class="col-sm-12 control-label"
                                                style="color:rgb(145, 3, 177)"><strong>First Department
                                                    Name:</strong></label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="depart_id" name="depart_id">
                                                <option class="" value="0" selected>--Select--</option>
                                                @foreach ($depart_info as $depart)
                                                    <option data-valuegg="{{ $depart->name }}"
                                                        value="{{ $depart->id }}">
                                                        {{ $depart->name }}</option>
                                                @endforeach

                                                <option data-valuegg="{{ $degree_info->name }}" value="40">
                                                    {{ $degree_info->name }}</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="class_id" class="col-sm-12 control-label"
                                                style="color:rgb(145, 3, 177)"><strong>Class Name:</strong></label>
                                                <div class="col-sm-12">
                                            <select class="form-control" id="class_id" name="class_id">
                                                <option class="" value="0" selected>--Select--</option>

                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="session" class="col-sm-12 control-label"
                                                style="color:rgb(145, 3, 177)"><strong>Session:</strong></label>
                                                <div class="col-sm-12">
                                            <select class="form-control" id="session" name="session">
                                                <option class="" value="0" selected>--Select--</option>

                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Student List :</label>
                                            <div class="col-sm-12">
                                            <select id="roll"
                                                class="form-control student @error('roll') is-invalid @enderror"
                                                name="roll" required>
                                                <option value="0" selected>--Select--</option>
                                            </select>

                                            @error('roll')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="starting_roll" class="col-sm-12 control-label">Starting
                                                Roll</label>
                                                <div class="col-sm-12">
                                            <input type="number" class="form-control" id="starting_roll1"
                                                name="starting_roll" placeholder="Enter Starting Roll" value=""
                                                maxlength="50">

                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ending_roll" class="col-sm-12 control-label">Ending Roll</label>
                                            <div class="col-sm-12">
                                            <input type="number" class="form-control" id="ending_roll1"
                                                name="ending_roll" placeholder="Enter Ending Roll" value="">

                                        </div>
                                        </div>
                                        <div class="form-group" id="2nd_div1">
                                            <label for="depart_id" class="col-sm-12 control-label"
                                                style="color: rgb(255, 119, 0)"><strong>Second Department
                                                    Name:</strong></label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="depart_id2" name="depart_id2">
                                                <option class="" value="0" selected>--Select--</option>
                                                @foreach ($depart_info as $depart)
                                                    <option data-value3="{{ $depart->name }}"
                                                        value="{{ $depart->id }}">
                                                        {{ $depart->name }}</option>
                                                @endforeach
                                                <option data-valuegg="{{ $degree_info->name }}" value="40">
                                                    {{ $degree_info->name }}</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="2nd_div2">
                                            <label for="class_id2" class="col-sm-12 control-label"
                                                style="color: rgb(255, 119, 0)"><strong>Class Name
                                                    Name:</strong></label>
                                            <div class="col-sm-12">        
                                            <select class="form-control" id="class_id2" name="class_id2">
                                                <option class="" value="0" selected>--Select--</option>

                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="2nd_div3">
                                            <label for="session2" class="col-sm-12 control-label"
                                                style="color:rgb(255, 119, 0)"><strong>Session:</strong></label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="session2" name="session2">
                                                <option class="" value="0" selected>--Select--</option>

                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="2nd_div4">
                                            <label for="name" class="col-sm-12 control-label">Student List :</label>
                                            <div class="col-sm-12">
                                            <select id="roll2"
                                                class="form-control student @error('roll2') is-invalid @enderror"
                                                name="roll">
                                                <option value="0" selected>--Select--</option>
                                            </select>

                                            @error('roll2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                             </div>
                                        </div>

                                        <div class="form-group" id="2nd_div5">
                                            <label for="starting_roll" class="col-sm-12 control-label">Starting
                                                Roll</label>
                                            <div class="col-sm-12">
                                            <input type="number" class="form-control" id="starting_roll2"
                                                name="starting_roll2" placeholder="Enter Starting Roll" value=""
                                                maxlength="50">
                                             </div>
                                        </div>
                                        <div class="form-group" id="2nd_div6">
                                            <label for="ending_roll" class="col-sm-12 control-label">Ending Roll</label>
                                            <div class="col-sm-12">
                                            <input type="number" class="form-control" id="ending_roll2"
                                                name="ending_roll2" placeholder="Enter Ending Roll" value="">

                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div1">
                                            <label for="depart_id" class="col-sm-12 control-label"
                                                style="color: rgb(23, 41, 234)"><strong>Third Department
                                                    Name:</strong></label>
                                                <div class="col-sm-12">
                                                 <select class="form-control" id="depart_id3" name="depart_id3">
                                                <option class="" value="0" selected>--Select--</option>
                                                @foreach ($depart_info as $depart)
                                                    <option value="{{ $depart->id }}">
                                                        {{ $depart->name }}</option>
                                                @endforeach
                                                <option data-valuegg="{{ $degree_info->name }}" value="40">
                                                    {{ $degree_info->name }}</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="3rd_div2">
                                            <label for="class_id3" class="col-sm-12 control-label"
                                                style="color: rgb(23, 41, 234)"><strong>Class
                                                    Name:</strong></label>
                                            <div class="col-sm-12">
                                            <select class="form-control" id="class_id3" name="class_id3">
                                                <option class="" value="0" selected>--Select--</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="3rd_div3">
                                            <label for="session3" class="col-sm-12 control-label"
                                                style="color:rgb(23, 41, 234)"><strong>Session:</strong></label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="session3" name="session3">
                                                <option class="" value="0" selected>--Select--</option>

                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group" id="3rd_div4">
                                            <label for="name" class="col-sm-12 control-label">Student List :</label>
                                            <div class="col-sm-12">
                                            <select id="roll3"
                                                class="form-control student @error('roll3') is-invalid @enderror"
                                                name="roll">
                                                <option value="0" selected>--Select--</option>
                                            </select>
                                            @error('roll3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="form-group" id="3rd_div5">
                                            <label for="starting_roll" class="col-sm-12 control-label">Starting
                                                Roll</label>
                                             <div class="col-sm-12">
                                                <input type="number" class="form-control" id="starting_roll3"
                                                    name="starting_roll3" placeholder="Enter Starting Roll" value=""
                                                    maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div6">
                                            <label for="ending_roll" class="col-sm-12 control-label">Ending Roll</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="ending_roll3"
                                                    name="ending_roll3" placeholder="Enter Ending Roll" value="">
                                            </div>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
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
                                        action="{{ url('department/exam_seatplan') }}" enctype="multipart/form-data">
                                        @csrf()


                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                             <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        <option value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control exam_id" id="exam_name" name="exam_name"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($examname as $nexamname)
                                                        <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="duty_date" class="col-sm-12 control-label">Exam Date :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control duty_date" id="duty_date" name="duty_date"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                             </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                                            <button type="button" class="btn btn-danger" id="closepdfmodel"
                                                aria-label="Close"> close </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pdfModel2" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('department/exam_seatplan/delete') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                                <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        <option value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control exam_id" id="exam_name" name="exam_name"
                                                required>
                                                <option class="" value="0" selected>--Select --</option>
                                                @foreach ($examname as $nexamname)
                                                    <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="duty_date" class="col-sm-12 control-label">Exam Date :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control duty_date" id="duty_date" name="duty_date"
                                                required>
                                                <option class="" value="0" selected>--Select --</option>

                                            </select>

                                        </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">delete</button>
                                            <button type="button" class="btn btn-danger" id="closepdfmodel2"
                                                aria-label="Close"> close </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="pdfModel3" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('department/exam_seat_Card') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        <option value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control exam_id" id="exam_name" name="exam_name"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($examname as $nexamname)
                                                        <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="duty_date" class="col-sm-12 control-label">Exam Date :</label>
                                            <div class="col-sm-12">
                                            <select class="form-control duty_date" id="duty_date" name="duty_date"
                                                required>
                                                <option class="" value="0" selected>--Select --</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                                            <button type="button" class="btn btn-danger" id="closepdfmodel3"
                                                aria-label="Close"> close </button>
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
                            $('#dform').trigger("reset");
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
                        $('#exprotModel2').click(function() {
                            $('#pdfModel2').modal('show');
                            $('#modelHeading').html("Create New");
                            $('#form').trigger("reset");
                            $('#saveBtn').html('Save');
                            $('#id').val('');
                        });
                        $('#exprotModel3').click(function() {
                            $('#pdfModel3').modal('show');
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

                            $.get("{{ route('examcommittee.index') }}" + '/' + id + '/edit', function(data) {
                                $('#ajaxModel').modal('show');
                                $('#modelHeading').html("Edit");
                                $('#saveBtn').html('Update');
                                $('#id').val(data.id);
                                $('#room_num').val(data.room_num);
                                $('#roll').val(data.roll);
                                $('#total_row').val(data.total_row);
                                $('#perBench').val(data.perBench);
                                $('#starting_roll').val(data.starting_roll);
                                $('#ending_roll').val(data.ending_roll);
                                $('#year').val(data.year);

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
                                        url: 'examcommittee/' + id,
                                        success: function(data) {
                                            window.location = 'examcommittee';
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
                        $('#closemodal').click(function() {
                            $('#ajaxModel').modal('hide');
                        });
                        $('#closepdfmodel').click(function() {
                            $('#pdfModel').modal('hide');
                        });

                        $('#closepdfmodel2').click(function() {
                            $('#pdfModel2').modal('hide');
                        });
                        $('#closepdfmodel3').click(function() {
                            $('#pdfModel3').modal('hide');
                        });
                    </script>
                    <script type='text/javascript'>
                        function calculateEndingRoll(perBench, startingRoll, endingRollId) {
                            var bench_no = parseFloat($('#room_num option:selected').attr('data-value'));
                            var total = bench_no * perBench;
                            var divi = total / perBench;
                            var starting_roll = parseFloat(startingRoll);
                            var ending_roll = starting_roll + divi - 1;
                            $("#" + endingRollId).val(ending_roll);
                        }

                        $(document).ready(function() {
                            $('#perBench, #starting_roll1').on('change keyup', function(e) {
                                var perBench = parseFloat($('#perBench').val());
                                calculateEndingRoll(perBench, $('#starting_roll1').val(), 'ending_roll1');
                            });

                            $('#perBench, #starting_roll2').on('change keyup', function(e) {
                                var perBench = parseFloat($('#perBench').val());
                                calculateEndingRoll(perBench, $('#starting_roll2').val(), 'ending_roll2');
                            });

                            $('#perBench, #starting_roll3').on('change keyup', function(e) {
                                var perBench = parseFloat($('#perBench').val());
                                calculateEndingRoll(perBench, $('#starting_roll3').val(), 'ending_roll3');
                            });
                        });
                    </script>


                    <script type='text/javascript'>
                        $(document).ready(function() {
                            function calculateSeats() {
                                var stu_per_bench_no = parseFloat($('#room_num option:selected').attr('per-seat-bench'));
                                var total_seat = parseFloat($('#room_num option:selected').attr('data-value'));
                                var total_column = parseFloat($('#room_num option:selected').attr('totalColumn'));
                                $('#perBench').val(stu_per_bench_no);
                                $('#total_row').val(total_column);
                                $('#total_seat').val(stu_per_bench_no * total_seat);
                            }
                            calculateSeats();
                            $('#room_num').on('change', function() {
                                calculateSeats();
                            });
                        });
                    </script>

                    <script type='text/javascript'>
                        $('#room_num').on('change', function() {
                            var stu_per_bench_no = parseFloat($('#room_num option:selected').attr('per-seat-bench'));
                            if (stu_per_bench_no == 1) {
                                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6').hide();
                                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6').hide();
                            } else if (stu_per_bench_no == 2) {
                                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6').show();
                                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6').hide();
                            } else if (stu_per_bench_no == 3) {
                                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6').show();
                                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6').show();
                            }
                        });
                    </script>
                    <script type="text/javascript">
                        $('#depart_id').on('change', function() {
                            var id = $(this).val();
                            // console.log(id);
                            if (id) {
                                $.ajax({
                                    url: 'departmetn_id/' + id,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#class_id').empty();
                                        $('#class_id').append('<option value="">--Select--</option>');
                                        if (data.class_info.length > 0) {
                                            $.each(data.class_info, function(key, value) {
                                                $('#class_id').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }

                                        if (data.degreeClass.length > 0) {
                                            $.each(data.degreeClass, function(key, value) {
                                                $('#class_id').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }
                                    }
                                });
                            }
                        });
                        $('#class_id').on('change', function() {
                            var id = $(this).val();
                            var depart_id = $("#depart_id").val();
                            if (id) {
                                var url = 'class_id/' + id + '/' + depart_id;
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#session').empty();
                                        $('#session').append('<option value="">--Select--</option>');
                                        if (data.sessions.length > 0) {
                                            $.each(data.sessions, function(key, value) {
                                                if (value.session) {
                                                    $('#session').append('<option data="' + value.studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }
                                        if (data.degreeSession.length > 0) {
                                            $.each(data.degreeSession, function(key, value) {
                                                if (value.session) {
                                                    $('#session').append('<option data="' + value.studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }

                                        // $('#session').trigger('change');
                                    }

                                });
                            }
                        });
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $('#session').change(function() {
                            var userid = $(this).find('option:selected').attr('data');
                            var depart_id = $("#depart_id").val();
                            $.ajax({
                                url: 'session_data',
                                type: 'post',
                                data: {
                                    _token: CSRF_TOKEN,
                                    userid: userid,
                                    depart_id: depart_id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('#roll').empty();
                                    $('#roll').append('<option value="">--Select--</option>');
                                    if (data.student.length > 0) {
                                        $.each(data.student, function(key, value) {
                                            if (value.name) {
                                                $('#roll').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }
                                    if (data.degreeStudent.length > 0) {
                                        $.each(data.degreeStudent, function(key, value) {
                                            if (value.name) {
                                                $('#roll').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }

                                    // $('#roll').trigger('change');
                                }

                            });
                        });


                        $('#depart_id2').on('change', function() {
                            var id = $(this).val();
                            // console.log(id);
                            if (id) {
                                $.ajax({
                                    url: 'departmetn_id/' + id,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#class_id2').empty();
                                        $('#class_id2').append('<option value="">--Select--</option>');
                                        if (data.class_info.length > 0) {
                                            $.each(data.class_info, function(key, value) {
                                                $('#class_id2').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }

                                        if (data.degreeClass.length > 0) {
                                            $.each(data.degreeClass, function(key, value) {
                                                $('#class_id2').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }
                                    }
                                });
                            }
                        });
                        $('#class_id2').on('click', function() {
                            var id = $(this).val();
                            var depart_id = $("#depart_id2").val();
                            if (id) {
                                var url = 'class_id/' + id + '/' + depart_id;
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#session2').empty();
                                        $('#session2').append('<option value="">--Select--</option>');
                                        if (data.sessions.length > 0) {
                                            $.each(data.sessions, function(key, value) {
                                                if (value.session) {
                                                    $('#session2').append('<option data="' + value
                                                        .studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session2').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }
                                        if (data.degreeSession.length > 0) {
                                            $.each(data.degreeSession, function(key, value) {
                                                if (value.session) {
                                                    $('#session2').append('<option data="' + value
                                                        .studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session2').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }

                                        // $('#session2').trigger('change');
                                    }
                                });
                            }
                        });
                        $('#session2').change(function() {
                            var userid = $(this).find('option:selected').attr('data');
                            var depart_id = $("#depart_id2").val();
                            $.ajax({
                                url: 'session_data',
                                type: 'post',
                                data: {
                                    _token: CSRF_TOKEN,
                                    userid: userid,
                                    depart_id: depart_id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('#roll2').empty();
                                    $('#roll2').append('<option value="">--Select--</option>');
                                    if (data.student.length > 0) {
                                        $.each(data.student, function(key, value) {
                                            if (value.name) {
                                                $('#roll2').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll2').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }
                                    if (data.degreeStudent.length > 0) {
                                        $.each(data.degreeStudent, function(key, value) {
                                            if (value.name) {
                                                $('#roll2').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll2').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }

                                    // $('#roll2').trigger('change');
                                }
                            });
                        });
                        $('#depart_id3').on('change', function() {
                            var id = $(this).val();
                            // console.log(id);
                            if (id) {
                                $.ajax({
                                    url: 'departmetn_id/' + id,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#class_id3').empty();
                                        $('#class_id3').append('<option value="">--Select--</option>');
                                        if (data.class_info.length > 0) {
                                            $.each(data.class_info, function(key, value) {
                                                $('#class_id3').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }

                                        if (data.degreeClass.length > 0) {
                                            $.each(data.degreeClass, function(key, value) {
                                                $('#class_id3').append('<option value="' + value.id + '">' +
                                                    value.name + '</option>');
                                            });
                                        }
                                    }
                                });
                            }
                        });
                        $('#class_id3').on('click', function() {
                            var id = $(this).val();
                            var depart_id = $("#depart_id3").val();
                            if (id) {
                                var url = 'class_id/' + id + '/' + depart_id;
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#session3').empty();
                                        $('#session3').append('<option value="">--Select--</option>');
                                        if (data.sessions.length > 0) {
                                            $.each(data.sessions, function(key, value) {
                                                if (value.session) {
                                                    $('#session3').append('<option data="' + value
                                                        .studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session3').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }
                                        if (data.degreeSession.length > 0) {
                                            $.each(data.degreeSession, function(key, value) {
                                                if (value.session) {
                                                    $('#session3').append('<option data="' + value
                                                        .studentclass +
                                                        '/' + value.session +
                                                        '" value="' + value.session + '">' + value.session +
                                                        '</option>');
                                                } else if (value.session_year) {
                                                    $('#session3').append('<option data="' + value.class_id +
                                                        '/' + value.session_year +
                                                        '" value="' + value.session_year + '">' + value
                                                        .session_year +
                                                        '</option>');
                                                }
                                            });
                                        }

                                        // $('#session3').trigger('change');
                                    }
                                });
                            }
                        });
                        $('#session3').change(function() {
                            var userid = $(this).find('option:selected').attr('data');
                            var depart_id = $("#depart_id3").val();
                            $.ajax({
                                url: 'session_data',
                                type: 'post',
                                data: {
                                    _token: CSRF_TOKEN,
                                    userid: userid,
                                    depart_id: depart_id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('#roll3').empty();
                                    $('#roll3').append('<option value="">--Select--</option>');
                                    if (data.student.length > 0) {
                                        $.each(data.student, function(key, value) {
                                            if (value.name) {
                                                $('#roll3').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll3').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }
                                    if (data.degreeStudent.length > 0) {
                                        $.each(data.degreeStudent, function(key, value) {
                                            if (value.name) {
                                                $('#roll3').append('<option value="' + value.roll + '">' + value
                                                    .name + '--' + value.roll + '</option>');
                                            } else if (value.student_name) {
                                                $('#roll3').append('<option value="' + value.roll + '">' + value
                                                    .student_name + '--' + value.roll + '</option>');
                                            }
                                        });
                                    }

                                    // $('#roll3').trigger('change');
                                }
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('.exam_id').on('change', function() {
                                var id = $(this).val();
                                if (id) {
                                    $.ajax({
                                        url: 'exam_routin/' + id,
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

                            $('#duty_date').select2({
                                placeholder: "--Select--",
                                allowClear: true,
                                width: '100%'
                            });
                            $('.student').select2({
                                placeholder: "--Select--",
                                allowClear: true,
                                width: '100%'
                            });
                        });
                    </script>
                @endsection
