<!DOCTYPE html>
<html>

<head>
    <title>Hostel Seat List Report</title>
    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            font-size: 12px;
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
            text-align: center
        }

        /* Style for table row on hover */
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; border-bottom: solid black;">Hostel Seat List Report</h1>
    <div class="card-box table-responsive">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Building Name</th>
                    <th>Floor Name</th>
                    <th>Total Room</th>
                    <th>Total Seat</th>
                    <th>Fillup Seat</th>
                    <th>Vacant Seat</th>
                </tr>
            </thead>
            <tbody id="list">
                @foreach ($Floor as $ndata)
                    @php
                        $building = DB::table('hostel_buldings')
                            ->where('id', $ndata->bulding_id)
                            ->orderBy('id', 'asc')
                            ->first();

                        $roomCount = DB::table('hostel_rooms')
                            ->select('room_number')
                            ->where('floor_id', $ndata->id)
                            ->groupBy('room_number')
                            ->get()
                            ->count();

                        $seatCount = DB::table('hostel_rooms')
                            ->where('floor_id', $ndata->id)
                            ->count();

                        $seat = DB::table('hostel_seat_allotments')
                            ->where('floor_id', $ndata->id)
                            ->count();

                    @endphp
                    {{-- @dd($seatCount); --}}
                    <tr id="row_list{{ $ndata->id }}">
                        <td>{{ $ndata->id }}</td>
                        <td>{{ $building ? $building->bulding_name : '--' }}</td>
                        <td>{{ $ndata->floor_name }}</td>
                        <td style="text-align:center">{{ $roomCount ?: '0' }}</td>
                        <td style="text-align:center">{{ $seatCount ?: '0' }}</td>
                        <td
                            style="background-color:rgb(136, 217, 90); color:rgb(5, 5, 4); font-size:18px; text-align:center">
                            {{ $seat ?: '0' }}</td>

                        <td style="color:red; font-size:18px; text-align:center">
                            @if ($ndata->hostel_id == '15')
                                {{ $seatCount * 2 - $seat ?: '0' }}
                            @else
                                {{ $seatCount - $seat ?: '0' }}
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
