<!DOCTYPE html>
<html>
<title>Room Wise Invigilator List</title>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 0px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    @foreach ($building as $bulding)
        @php
            $buldingName = DB::table('bulding_names')
                ->where('id', $bulding->building_id)
                ->first();
            $examDate = DB::table('exam_routines')
                ->where('date', $bulding->duty_date)
                ->first();
            $examRoomWiseData = DB::table('exam_roomwise_master_duty_rosters')
                ->where('duty_date', $bulding->duty_date)
                ->where('building_id', $bulding->building_id)
                ->orderBy('room_id', 'asc')
                ->get();
            $Collegelogo = DB::table('basics')->first();

        @endphp
        {{-- @dd($examDate); --}}

        <p style="padding-left:50px; "><img src="{{ asset('public/upload/collegelogo.jpeg') }}" alt=""
                width="100" height="100">
        </p>
        <center>
            <h2 style="margin-top: -120px;">Government Saadat College<br>Karatia, Tangail</h2>
            @php
                $examName = DB::table('exam_names')
                    ->where('id', $data->first()->exam_id)
                    ->first();
            @endphp
            <p style="font-size: 16px; font-weight:bold; margin-top:-10px;">{{ $examName->title }}<br>Room Wise
                Invigilator
                List<br>{{ $buldingName->building_name }}
            </p>
        </center>

        <p style="padding-left: 530px; margin-top:-30px;">Data: {{ $examDate ? $examDate->date : '' }}</p>
        <table id="customers">
            <tr>
                <th>Room No</th>
                <th>Name And Designation</th>
                <th>Department</th>
                <th>Signature</th>

            </tr>
            @foreach ($examRoomWiseData as $index => $item)
                @php
                    $roomNum = DB::table('room_no')
                        ->where('id', '=', $item->room_id)
                        ->first();
                    $examMasterData = DB::table('exam_master_duty_rosters')
                        ->where('id', '=', $item->teacher_masterduty_id)
                        ->first();
                @endphp

                @if ($index == 0 || $item->room_id != $examRoomWiseData[$index - 1]->room_id)
                    <tr>
                        <td style="text-align: center"
                            rowspan="{{ $examRoomWiseData->where('room_id', $item->room_id)->count() }}">
                            {{ $roomNum->title }}
                        </td>
                        <td>{{ $examMasterData ? $examMasterData->name : '' }}<br>
                            {{ $examMasterData ? $examMasterData->designation : '' }}</td>
                        <td>{{ $examMasterData ? $examMasterData->name : '' }}</td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $examMasterData ? $examMasterData->name : '' }}<br>
                            {{ $examMasterData ? $examMasterData->designation : '' }}</td>
                        <td>{{ $examMasterData ? $examMasterData->name : '' }}</td>
                        <td></td>
                    </tr>
                @endif
            @endforeach

        </table> <br><br>
    @endforeach
</body>


</html>
