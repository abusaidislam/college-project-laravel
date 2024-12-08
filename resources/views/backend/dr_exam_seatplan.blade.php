@extends('layouts.drexamapp')
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
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel3">Show Seat Card
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
                                                <th>Exam Name Year</th>
                                                <th>Room No</th>
                                                <th>College Name</th>
                                                <th>Subject Name</th>
                                                <th>Roll</th>
                                                <th>Student Per Bench</th>
                                                <th>Total Column</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($seatplandata as $ndata)
                                                @php
                                                    $room_data = DB::table('room_no')
                                                        ->where('id', $ndata->room_num)
                                                        ->first();
                                                    $exam_name = DB::table('exam_names')
                                                        ->where('id', $ndata->exam_year)
                                                        ->first();

                                                @endphp
                                                {{-- @dd($room_data); --}}
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $exam_name->title }}</td>
                                                    <td>{{ $room_data->title }}</td>
                                                    <td>{{ $ndata->collegee_name }}</td>
                                                    <td>{{ $ndata->subject_name }}</td>
                                                    <td>{{ $ndata->roll }}</td>
                                                    <td>{{ $ndata->type }}</td>
                                                    <td>{{ $ndata->total_row }}</td>
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                        {{-- <a href="{{ url('show_exam_seatplan', $ndata->room_num) }}">
                                                            <button type="button" id="showSeatPlan"
                                                                data-id="{{ $ndata->id }}"
                                                                class="btn btn-sm btn-primary"><span
                                                                    class="glyphicon glyphicon-eye-open"></span></button></a> --}}
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
                                        action="{{ route('drexamseatplan.store') }}">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="room_num" class="col-sm-12 control-label">Name Of Room :</label>
                                            @php
                                                $room_numbers = DB::table('seat_plans')
                                                    ->pluck('room_num')
                                                    ->unique()
                                                    ->toArray();
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
                                                name="total_row" value="" required="">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Student Per Bench
                                                :</label>
                                                <div class="col-sm-12">     
                                            <input type="number" readonly class="form-control" id="perBench"
                                                name="perBench" value="{{ $room_details->student_per_bench }}"
                                                required="">

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
                                                    <option data-value="{{ $nexamname->title }}"
                                                        value="{{ $nexamname->id }}">{{ $nexamname->title }}
                                                    </option>
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

                                        <div class="form-group">
                                            <label style="color:rgb(145, 3, 177)" for="college_name"
                                                class="col-sm-12 control-label">College Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control college_name" id="college_name"
                                                    name="college_name" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="color:rgb(145, 3, 177)" for="subject_name"
                                                class="col-sm-12 control-label">Subject Code
                                                Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="subject_name" name="subject_name"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="color:rgb(145, 3, 177)" for="type"
                                                class="col-sm-12 control-label">Type</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="type" name="type" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <p id="stuinfo"></p>
                                        <div class="form-group">
                                            <label style="color:rgb(145, 3, 177)" for="student_name"
                                                class="col-sm-12 control-label">Roll---Student Name
                                            </label>
                                            <div class="col-sm-12">
                                                <select class="form-control student_roll" id="student_name"
                                                    name="student_name" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
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
                                            <label style="color: rgb(23, 41, 234)" for="college_name2"
                                                class="col-sm-12 control-label">Secound College
                                                Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control college_name2" id="college_name2"
                                                    name="college_name2">
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="2nd_div2">
                                            <label style="color: rgb(23, 41, 234)" for="subject_name2"
                                                class="col-sm-12 control-label">Subject Code
                                                Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control " id="subject_name2" name="subject_name2"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="2nd_div3">
                                            <label style="color:rgb(23, 41, 234)" for="type2"
                                                class="col-sm-12 control-label">Type</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="type2" name="type2" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div id="2nd_div4">
                                            <p id="stuinfo2"></p>
                                        </div>

                                        <div class="form-group" id="2nd_div5">
                                            <label style="color: rgb(23, 41, 234)" for="student_name2"
                                                class="col-sm-12 control-label">Roll---Student Name
                                            </label>
                                            <div class="col-sm-12">
                                                <select class="form-control student_roll" id="student_name2"
                                                    name="student_name2" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="2nd_div6">
                                            <label for="starting_roll2" class="col-sm-12 control-label">Starting
                                                Roll</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="starting_roll2"
                                                    name="starting_roll2" placeholder="Enter Starting Roll"
                                                    value="" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group" id="2nd_div7">
                                            <label for="ending_roll2" class="col-sm-12 control-label">Ending Roll</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="ending_roll2"
                                                    name="ending_roll2" placeholder="Enter Ending Roll" value="">
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div1">
                                            <label style="color: rgb(255, 119, 0)" for="college_name3"
                                                class="col-sm-12 control-label">Third College
                                                Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control college_name3" id="college_name3"
                                                    name="college_name3">
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div2">
                                            <label style="color: rgb(255, 119, 0)" for="subject_name3"
                                                class="col-sm-12 control-label">Subject Code
                                                Name</label>
                                                <div class="col-sm-12">
                                                <select class="form-control " id="subject_name3" name="subject_name3"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div3">
                                            <label style="color:rgb(255, 119, 0)" for="type3"
                                                class="col-sm-12 control-label">Type</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="type3" name="type3" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div id="3rd_div4">
                                            <p id="stuinfo3"></p>
                                        </div>
                                        <div class="form-group" id="3rd_div5">
                                            <label style="color: rgb(255, 119, 0)" for="student_name3"
                                                class="col-sm-12 control-label">Roll---Student Name
                                            </label>
                                            <div class="col-sm-12">
                                                <select class="form-control student_roll" id="student_name3"
                                                    name="student_name3" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div6">
                                            <label for="starting_roll3" class="col-sm-12 control-label">Starting
                                                Roll</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="starting_roll3"
                                                    name="starting_roll3" placeholder="Enter Starting Roll"
                                                    value="" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group" id="3rd_div7">
                                            <label for="ending_roll3" class="col-sm-12 control-label">Ending Roll</label>
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
                                        action="{{ url('exam_seatplan_show') }}" enctype="multipart/form-data">
                                        @csrf()


                                        <input type="hidden" name="id" id="id">
                                       
                                        <div class="form-group">
                                             <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        {{-- @unless (in_array($room->id, $room_numbers)) --}}
                                                        <option totalColumn ="{{ $room->total_row }}"
                                                            per-seat-bench="{{ $room->student_per_bench }}"
                                                            data-value="{{ $room->number_bench }}" value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                        {{-- @endunless --}}
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
                                        action="{{ url('exam_seatplan/delete') }}" enctype="multipart/form-data">
                                        @csrf()


                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        {{-- @unless (in_array($room->id, $room_numbers)) --}}
                                                        <option totalColumn ="{{ $room->total_row }}"
                                                            per-seat-bench="{{ $room->student_per_bench }}"
                                                            data-value="{{ $room->number_bench }}" value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                        {{-- @endunless --}}
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
                                        action="{{ url('exam_seat_Card') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                         <label for="name" class="col-sm-12 control-label">Room Number :</label>
                                         <div class="col-sm-12">
                                                 <select class="form-control" id="room_num" name="room_num">
                                                    <option value="0" selected>--Select--</option>
                                                    @foreach ($data as $room)
                                                        {{-- @unless (in_array($room->id, $room_numbers)) --}}
                                                        <option totalColumn ="{{ $room->total_row }}"
                                                            per-seat-bench="{{ $room->student_per_bench }}"
                                                            data-value="{{ $room->number_bench }}" value="{{ $room->id }}">
                                                            {{ $room->title }}
                                                        </option>
                                                        {{-- @endunless --}}
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

            $.get("{{ route('drexamseatplan.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#room_num').val(data.room_num).trigger('change');
                $('#total_row').val(data.total_row);
                $('#exam_id').val(data.exam_year);
                $('.duty_date').val(data.exam_routin_id).trigger('change');
                $('#collegee_name').val(data.collegee_name);
                $('#subject_name').val(data.subject_name);
                $('#type').val(data.student_type);
                $('#perBench').val(data.type);
                $('#roll').val(data.roll);
                $('#starting_roll').val(data.starting_roll).trigger('change');
                $('#ending_roll').val(data.rending_rolloll).trigger('change');
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
                        url: 'drexamseatplan/' + id,
                        success: function(data) {
                            window.location = 'drexamseatplan';
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
                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6, #2nd_div7').hide();
                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6, #3rd_div7').hide();
            } else if (stu_per_bench_no == 2) {
                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6, #2nd_div7').show();
                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6, #3rd_div7').hide();
            } else if (stu_per_bench_no == 3) {
                $('#2nd_div1, #2nd_div2, #2nd_div3, #2nd_div4, #2nd_div5, #2nd_div6, #2nd_div7').show();
                $('#3rd_div1, #3rd_div2, #3rd_div3, #3rd_div4, #3rd_div5, #3rd_div6, #3rd_div7').show();
            }
        });
    </script>
    <script type="text/javascript">
        $('.duty_date').on('change', function() {
            var examdate_id = $(this).val();
            var examinfo = $("#exam_id option:selected").data('value');
            if (examdate_id) {
                $.ajax({
                    url: 'dr_examinfo/' + examdate_id + '/' + examinfo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#college_name').empty();
                        $('#college_name').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#college_name').append('<option value="' + value
                                .collegecode_name + '">' +
                                value
                                .collegecode_name + '</option>');
                        });
                    }
                });
            }
        });
        $('#college_name').on('change', function() {
            var college_name = $(this).val();
            // console.log(college_name);
            if (college_name) {
                $.ajax({
                    url: 'dr_collegeinfo/' + college_name,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#subject_name').empty();
                        $('#subject_name').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#subject_name').append('<option value="' + value
                                .subjectcode_name + '">' +
                                value
                                .subjectcode_name + '</option>');
                        });

                    }
                });
            }
        });
        $('#subject_name').on('change', function() {
            var subject = $(this).val();
            // console.log(subject);
            if (subject) {
                $.ajax({
                    url: 'dr_subject/' + subject,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#type').empty();
                        $('#type').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#type').append('<option value="' + value
                                .type + '">' +
                                value
                                .type + '</option>');
                        });

                    }
                });
            }
        });
        $('#type').on('change', function() {
            var subject_name = $("#subject_name").val();
            var collegeName = $(".college_name").val();
            var type = $(this).val();
            // console.log(subject_name);
            if (subject_name) {
                $.ajax({
                    url: 'dr_subjectinfo/' + subject_name + '/' + collegeName + '/' + type,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var countdata = data.countdata;
                        var drcoundData = data.drcoundData;
                        var total = data.total;

                        $('#student_name').empty();
                        $('#stuinfo').empty();
                        $('#student_name').append('<option value="">--Select--</option>');
                        $('#stuinfo').append('<p style="color: green;">Total Student: ' + drcoundData +
                            ' Total Allocated: ' + countdata + ' Total Remaining: ' +
                            total + '</p>');

                        $.each(data.drpaperInfo, function(key, value) {
                            $('#student_name').append('<option value="' + value.exam_roll +
                                '">' + value.exam_roll + '---' + value.candidate_name +
                                '</option>');
                        });
                    }


                });
            }
        });



        $('.duty_date').on('change', function() {
            var examdate_id = $(this).val();
            var examinfo = $("#exam_id option:selected").data('value');

            if (examdate_id) {
                $.ajax({
                    url: 'dr_examinfo_secound/' + examdate_id + '/' + examinfo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#college_name2').empty();
                        $('#college_name2').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#college_name2').append('<option value="' + value
                                .collegecode_name + '">' +
                                value
                                .collegecode_name + '</option>');
                        });
                        $('#college_name2').trigger('change');
                    }
                });
            }
        });
        $('#college_name2').on('change', function() {
            var college_name = $(this).val();
            // console.log(college_name);
            if (college_name) {
                $.ajax({
                    url: 'dr_collegeinfo_secound/' + college_name,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#subject_name2').empty();
                        $('#subject_name2').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#subject_name2').append('<option value="' + value
                                .subjectcode_name + '">' +
                                value
                                .subjectcode_name + '</option>');
                        });
                        $('#subject_name2').trigger('change');
                    }
                });
            }
        });
        $('#subject_name2').on('change', function() {
            var subject = $(this).val();
            // console.log(subject);
            if (subject) {
                $.ajax({
                    url: 'dr_subjectsecound/' + subject,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#type2').empty();
                        $('#type2').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#type2').append('<option value="' + value
                                .type + '">' +
                                value
                                .type + '</option>');
                        });

                    }
                });
            }
        });
        $('#type2').on('change', function() {
            var subject_name = $("#subject_name2").val();
            var collegeName = $(".college_name2").val();
            var type = $(this).val();
            if (subject_name) {
                $.ajax({
                    url: 'dr_subjectinfoSecound/' + subject_name + '/' + collegeName + '/' + type,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var countdata = data.countdata;
                        var drcoundData = data.drcoundData;
                        var total = data.total;

                        $('#student_name2').empty();
                        $('#stuinfo2').empty();
                        $('#student_name2').append('<option value="">--Select--</option>');
                        $('#stuinfo2').append('<p style="color: green;">Total Student: ' + drcoundData +
                            ' Total Allocated: ' + countdata + ' Total Remaining: ' +
                            total + '</p>');

                        $.each(data.drpaperInfo, function(key, value) {
                            $('#student_name2').append('<option value="' + value.exam_roll +
                                '">' + value.exam_roll + '---' + value.candidate_name +
                                '</option>');
                        });
                    }


                });
            }
        });

        $('.duty_date').on('change', function() {
            var examdate_id = $(this).val();
            var examinfo = $("#exam_id option:selected").data('value');
            console.log(examinfo);
            if (examdate_id) {
                $.ajax({
                    url: 'dr_examinfo_third/' + examdate_id + '/' + examinfo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#college_name3').empty();
                        $('#college_name3').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#college_name3').append('<option value="' + value
                                .collegecode_name + '">' +
                                value
                                .collegecode_name + '</option>');
                        });
                        $('#college_name3').trigger('change');
                    }
                });
            }
        });

        $('#college_name3').on('change', function() {
            var college_name = $(this).val();
            // console.log(college_name);
            if (college_name) {
                $.ajax({
                    url: 'dr_collegeinfo_third/' + college_name,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#subject_name3').empty();
                        $('#subject_name3').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#subject_name3').append('<option value="' + value
                                .subjectcode_name + '">' +
                                value
                                .subjectcode_name + '</option>');
                        });
                        $('#subject_name3').trigger('change');
                    }
                });
            }
        });

        $('#subject_name3').on('change', function() {
            var subject = $(this).val();
            // console.log(subject);
            if (subject) {
                $.ajax({
                    url: 'dr_subjectthird/' + subject,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#type3').empty();
                        $('#type3').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#type3').append('<option value="' + value
                                .type + '">' +
                                value
                                .type + '</option>');
                        });

                    }
                });
            }
        });
        $('#type3').on('change', function() {
            var subject_name = $("#subject_name3").val();
            var collegeName = $(".college_name3").val();
            var type = $(this).val();
            if (subject_name) {
                $.ajax({
                    url: 'dr_subjectinfoThird/' + subject_name + '/' + collegeName + '/' + type,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var countdata = data.countdata;
                        var drcoundData = data.drcoundData;
                        var total = data.total;

                        $('#student_name3').empty();
                        $('#stuinfo3').empty();
                        $('#student_name3').append('<option value="">--Select--</option>');
                        $('#stuinfo3').append('<p style="color: green;">Total Student: ' + drcoundData +
                            ' Total Allocated: ' + countdata + ' Total Remaining: ' +
                            total + '</p>');

                        $.each(data.drpaperInfo, function(key, value) {
                            $('#student_name3').append('<option value="' + value.exam_roll +
                                '">' + value.exam_roll + '---' + value.candidate_name +
                                '</option>');
                        });
                    }


                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.exam_id').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'dr_exam_routine_info/' + id,
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

            $('.student_roll').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
