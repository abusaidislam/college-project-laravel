<!DOCTYPE html>
<html>
<title>Vigilance Team
</title>

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
        {{-- @dd($bulding); --}}
        @php
            $buldingName = DB::table('bulding_names')
                ->where('building_name', $bulding->bulding)
                ->first();
            $examDate = DB::table('exam_routines')
                ->where('id', $bulding->duty_date)
                ->first();
            $drexamDate = DB::table('exam_dr_routines')
                ->where('id', '=', $bulding->duty_date)
                ->first();
            $all = DB::table('examsetups')
                ->where('duty_date', $bulding->duty_date)
                ->where('bulding', $bulding->bulding)
                ->get();
            $Collegelogo = DB::table('basics')->first();

        @endphp
        {{-- <img src="" alt=""> --}}
        <p style="padding-left:50px; "><img src="{{ asset('public/upload/collegelogo.jpeg') }}" alt=""
                width="100" height="100">
        </p>
        <center>
            <h2 style="margin-top: -120px;">Government Saadat College<br>Karatia, Tangail</h2>
            @php
                $examName = DB::table('exam_names')
                    ->where('id', $data->first()->exam_name)
                    ->first();
            @endphp
            <p style="font-size: 16px; font-weight:bold; margin-top:-10px;">{{ $examName->title }}<br>Vigilance Team
                <br>{{ $buldingName->building_name }}
            </p>
        </center>

        <p style="padding-left: 530px; margin-top:-30px;">
            @if ($userType->usertype == 7)
                Data: {{ $examDate ? $examDate->date : '' }}
            @else
                Data: {{ $drexamDate ? $drexamDate->date : '' }}
            @endif

        </p>
        <table id="customers">
            <tr>
                <th>SL.</th>
                <th>Name And Designation</th>
                <th>Department</th>
                <th>Signature</th>

            </tr>
            @foreach ($all as $all)
                @php

                    $examDate = DB::table('exam_routines')
                        ->where('id', '=', $all->duty_date)
                        ->first();
                    $departments = DB::table('departments')
                        ->where('id', '=', $all->department)
                        ->first();

                @endphp
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $all ? $all->teacher : '' }}<br>
                        {{ $all ? $all->designation : '' }}</td>
                    @if ($all->department == '40')
                        <td style="text-align: center">Department of Degree</td>
                    @else
                        <td style="text-align: center">{{ $departments ? $departments->name : '' }}</td>
                    @endif
                    <td></td>

                </tr>
            @endforeach
        </table> <br><br>
    @endforeach
</body>


</html>
