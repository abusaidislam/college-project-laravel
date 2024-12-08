@php
    $userType = DB::table('users')->where('id', $authID)->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center" id="successMessage">{{ Session::get('massage') }}</h4>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Master Duty Roaster Edit Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
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
                                                                if ($userType->usertype == 7) {
                                                                    $data = DB::table('exam_routines')
                                                                        ->where('exam_id', $examInfo->id)
                                                                        ->where('user_id', $authID)
                                                                        ->get();
                                                                } else {
                                                                    $data = DB::table('exam_dr_routines')
                                                                        ->where('exam_id', $examInfo->id)
                                                                        ->where('user_id', $authID)
                                                                        ->get();
                                                                }

                                                            @endphp
                                                            @foreach ($data as $d)
                                                                <th style="writing-mode: vertical-lr;">{{ $d ? $d->date : '' }}
                                                                </th>
                                                            @endforeach
                                                            <th class="name-col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dataa as $row)
                                                            {{-- @php
                                                                $teacher = DB::table('teachers')
                                                                    ->where('id', $row->name)
                                                                    ->first();
                                                            @endphp --}}
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $row->designation }}</td>
                                                                <td>{{ $row ? $row->name : '' }}</td>
                                                                <td>{{ $row->department }}</td>
                                                                <td>{{ $row->email }}</td>
                                                                <td>{{ $row->mobile }}</td>
                                                                @foreach ($data as $d)
                                                                    <td class="attend-col" name="duty_date">
                                                                        <?php
                                                                        $isChecked = isset($row->duty_date) && json_decode($row->duty_date)->{$d->date} == 1;
                                                                        ?>
                                                                        <input type="checkbox"
                                                                            name="attendance[{{ $row->id }}][{{ $d->date }}]"
                                                                            {{ $isChecked ? 'checked' : '' }}>
                                                                    </td>
                                                                @endforeach
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
                var rowId = $(this).data('row-id');
                var attendanceData = {};

                // Get attendance data for the current row
                <?php foreach ($data as $d): ?>
                var date = '{{ $d->date }}';
                var isChecked = $('input[name="attendance[' + rowId + '][' + date + ']"]').prop('checked');

                // Use the date from $data as the key for attendanceData
                attendanceData[date] = isChecked ? 1 : 0;
                <?php endforeach; ?>
                // Send AJAX request to update the data
                $.ajax({
                    type: 'POST',
                    url: '{{ route('exam_master_duty_roster_editable') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'edit',
                        attendance: attendanceData,
                        rowid: rowId
                    },
                    success: function(response) {
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
