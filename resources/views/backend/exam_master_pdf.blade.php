<!DOCTYPE html>
<html>
<title>Master Duty Roaster</title>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8px;
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
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #customers .name-col {
            text-align: center
        }
    </style>
</head>

<body>
    @php

        $Collegelogo = DB::table('basics')->first();

    @endphp
    <p style="padding-left:50px; "><img src="{{ asset('public/upload/collegelogo.jpeg') }}" alt="" width="100"
            height="100">
    </p>
    <center>
        <h2 style="margin-top: -120px;">Government Saadat College<br>Karatia, Tangail-1903</h2>
        @php
            $examName = DB::table('exam_names')
                ->where('id', $data->first()->exam_id)
                ->first();
        @endphp
        <p>{{ $examName->title }} <br>Master Duty Roaster</p>
    </center>
    <hr>
    {{-- @php
        $dataa = DB::table('exam_routines')->get();
    @endphp --}}
    @php
        $dataa = DB::table('exam_routines')
            ->where('exam_id', $examInfo->id)
            ->where('user_id', $authID)
            ->get();
    @endphp

    <table id="customers">
        <tr>
            <th class="name-col">SL.</th>
            <th class="name-col">Teacher Name</th>
            <th class="name-col">Department /
                Designation
            </th>
            <th class="name-col">Email / Mobile</th>
            @foreach ($dataa as $d)
                <th style="writing-mode: vertical-lr;" class="name-col">{{ $d->date }}</th>
            @endforeach
        </tr>
        @foreach ($data as $row)
            <tr>
                <td class="name-col">{{ $loop->iteration }}</td>
                <td>{{ $row ? $row->name : '' }}</td>
                <td>{{ $row->department }} ,<br>{{ $row->designation }}</td>
                <td>{{ $row->email }}, <br>{{ $row->mobile }}</td>
                @foreach ($dataa as $d)
                    <td class="attend-col name-col" name="duty_date">
                        <?php
                        $isChecked = isset($row->duty_date) && json_decode($row->duty_date)->{$d->date} == 1;
                        ?>
                        <input type="checkbox" name="attendance[{{ $row->id }}][{{ $d->date }}]"
                            {{ $isChecked ? 'checked' : '' }}>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>


</html>
