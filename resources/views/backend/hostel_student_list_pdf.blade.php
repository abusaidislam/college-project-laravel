t
<!DOCTYPE html>
<html>

<head>
    <title>Hostel Seat Allotment List Report</title>
    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            font-size: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 2px;
            text-align: left;
        }

        /* Style for table header (thead) */
        thead {
            background-color: #f2f2f2;
        }

        /* Style for table header cells (th) */
        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Style for table row on hover */
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; border-bottom: solid black;">Hostel Seat Allotment List Report</h1>
    <div class="card-box table-responsive">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Payment Photo</th>
                    <th>Student Name</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Session</th>
                    <th>Roll</th>
                    <th>Regi</th>
                    <th>Mobile</th>
                    <th>Bulding Name</th>
                    <th>Floor Name</th>
                    <th>Room Number</th>
                    <th>Seat Number</th>
                    <th>Chack in Date</th>
                    <th>Chack Out Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="list">

                @foreach ($hostelStudent as $ndata)
                    {{-- @dd($ndata); --}}
                    @php
                        $depart = DB::table('departments')
                            ->where('id', $ndata->department_id)
                            ->orderBy('id', 'asc')
                            ->first();
                        $departclass = DB::table('studen_classes')
                            ->where('id', $ndata->class)
                            ->orderBy('id', 'asc')
                            ->first();
                        $degclass = DB::table('degree_classes')
                            ->where('id', $ndata->class)
                            ->orderBy('id', 'asc')
                            ->first();
                        $building = DB::table('hostel_buldings')
                            ->where('id', $ndata->bulding_id)
                            ->orderBy('id', 'asc')
                            ->first();
                        $floor = DB::table('hostel_floors')
                            ->where('id', $ndata->floor_id)
                            ->orderBy('id', 'asc')
                            ->first();
                        $room = DB::table('hostel_rooms')
                            ->where('id', $ndata->room_id)
                            ->orderBy('id', 'asc')
                            ->first();
                        $seat = DB::table('hostel_rooms')
                            ->where('id', $ndata->bed_id)
                            ->orderBy('id', 'asc')
                            ->first();

                    @endphp
                    <tr>
                        <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }} " alt="" width="50"
                                height="50"> </td>
                        <td><img src="{{ asset('public/hostel_card/' . $ndata->payment_photo) }} " alt=""
                                width="50" height="50"> </td>
                        <td>{{ $ndata->student_name }}</td>
                        @if ($ndata->department_id == 40)
                            <td>Department of General </td>
                            <td>{{ $degclass ? $degclass->name : '' }} </td>
                        @else
                            <td>{{ $depart->name }} </td>
                            <td>{{ $departclass ? $departclass->name : '' }} </td>
                        @endif
                        <td>{{ $ndata->session }} </td>
                        <td>{{ $ndata->roll }} </td>
                        <td>{{ $ndata->registration }} </td>
                        <td>{{ $ndata->mobile_no }} </td>
                        <td>{{ $building->bulding_name }} </td>
                        <td>{{ $floor->floor_name }} </td>
                        <td>{{ $room->room_number }} </td>
                        <td>{{ $seat->seat_number }} </td>
                        <td>{{ $ndata->check_in_date }} </td>
                        <td>{{ $ndata->check_out_date }} </td>
                        <td>{{ $ndata->status == 0 ? 'Active' : 'Inactive' }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
