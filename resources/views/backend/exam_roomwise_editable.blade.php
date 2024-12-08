@extends('layouts.examapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center" id="successMessage">{{ Session::get('massage') }}</h4>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Room Wise Edit Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="title_left text-right" style="padding-right:10px;">
                        {{-- <form action="" method="post" class="text-right"> --}}
                        <div class="" style="margin-left: 165px">
                            <div class="col-sm-9">
                                @php
                                    $dataData = DB::table('exam_routines')
                                        ->where('exam_id', $examInfo->id)
                                        ->where('user_id', $authID)
                                        ->get();
                                @endphp
                                <select class="form-control" id="exam_date" name="exam_date">
                                    <option value="" selected>--Select--</option>
                                    @foreach ($dataData as $item)
                                        <option value="{{ $item->date }}">
                                            {{ $item->date }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <span class="input-group-btn">
                                <a class="btn btn-success createNew2" href="#" id="viewLink">Edit</a>
                            </span> --}}


                        {{-- </form> --}}

                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="container">
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                @csrf
                                                <table id="editable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>

                                                            <th class="name-col">SL</th>
                                                            <th class="name-col">Teacher Name</th>
                                                            <th class="name-col">Designation</th>
                                                            <th class="name-col">Department</th>
                                                            <th class="name-col">Mobile</th>
                                                            <th class="name-col">Email</th>
                                                            @php
                                                                $roomNumber = DB::table('room_no')->get();
                                                            @endphp
                                                            @foreach ($roomNumber as $room)
                                                                <th style="writing-mode: vertical-lr;">{{ $room->title }}
                                                                </th>
                                                            @endforeach
                                                            <th class="name-col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dataa as $row)
                                                            {{-- @dd($row); --}}
                                                            @php
                                                                $roomInfo = DB::table('exam_roomwise_master_duties')
                                                                    ->where('teacher_masterduty_id', $row->id)
                                                                    ->first();
                                                            @endphp
                                                            {{-- @dd($roomInfo); --}}
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $row->designation }}</td>
                                                                <td>{{ $row ? $row->name : '' }}</td>
                                                                <td>{{ $row->department }}</td>
                                                                <td>{{ $row->email }}</td>
                                                                <td>{{ $row->mobile }}</td>
                                                                @foreach ($roomNumber as $room)
                                                                    <td class="attend-col" name="duty_date">
                                                                        @php
                                                                            // $isChecked = isset($roomInfo->room_number) && json_decode($roomInfo->room_number)->{$room->title} == '1';
                                                                            $isChecked = $roomInfo && isset($roomInfo->room_number) && property_exists(json_decode($roomInfo->room_number), $room->title) && json_decode($roomInfo->room_number)->{$room->title} == 1;
                                                                        @endphp

                                                                        <input type="checkbox"
                                                                            name="attendance[{{ $row->id }}][{{ $room->title }}]"
                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                    </td>
                                                                @endforeach

                                                                {{-- @foreach ($data as $d)
                                                                    <td class="attend-col" name="duty_date">
                                                                        php
                                                                        $isChecked = isset($row->duty_date) && json_decode($row->duty_date)->{$d->date} == 1;
                                                                        ?>
                                                                        <input type="checkbox"
                                                                            name="attendance[{{ $row->id }}][{{ $d->date }}]"
                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                    </td>
                                                                @endforeach --}}
                                                                {{-- @endforeach
                                                                @foreach ($data as $d)
                                                                    <td>
                                                                        <input type="checkbox"
                                                                            name="attendance[{{ $row->id }}][{{ $d->date }}]">
                                                                    </td>
                                                                @endforeach --}}
                                                                <td><button class="saveButton"
                                                                        data-row-id="{{ $row->id }}">Save</button>
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
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.saveButton').click(function() {
                var examDate = $("#exam_date").val();
                var rowId = $(this).data('row-id');
                var attendanceData = {};

                // Get attendance data for the current row
                <?php foreach ($roomNumber as $room): ?>
                var title = '{{ $room->title }}';
                var isChecked = $('input[name="attendance[' + rowId + '][' + title + ']"]').prop('checked');

                // Use the date from $data as the key for attendanceData
                attendanceData[title] = isChecked ? examDate : '0';
                <?php endforeach; ?>
                // console.log(examDate);
                // Send AJAX request to update the data
                $.ajax({
                    type: 'POST',
                    url: '{{ route('exam_m_editable') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'edit',
                        attendance: attendanceData,
                        rowid: rowId
                        // examdate: examDate
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.message) {
                            $('#successMessage').text(response.message);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
