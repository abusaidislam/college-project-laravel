<!DOCTYPE html>
<html>
<title>Duty Roaster</title>

<head>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .main {
            padding: 30px;
        }

        .degi {
            font-size: 14px;
            text-align: center;

        }

        .degi p {
            /* background: red; */
            display: inline;
            margin-right: 40px;
        }

        .footer {
            font-size: 14px;
            text-align: center;

        }

        .left {
            display: inline-flex;
            margin-right: 100px;
        }

        .right {
            display: inline-flex;
        }

        .left p {

            width: 300px;
            font-weight: bold
        }

        .right p {
            /* display: inline; */
            width: 300px;
            font-weight: bold
        }



        #customers {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
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
    </style>
</head>

<body>
    <div class="main">

        @foreach ($data as $ndata)
            @php

                $Collegelogo = DB::table('basics')->first();

            @endphp
            <p style="padding-left:50px; "><img src="{{ asset('public/upload/collegelogo.jpeg') }}" alt=""
                    width="100" height="100">
            </p>
            <center>

                @php
                    $examName = DB::table('exam_names')
                        ->where('id', $data->first()->exam_id)
                        ->first();
                @endphp
                <h3 style="margin-top: -80px;">{{ $examName->title }} <br>Government Saadat
                    College,
                    Karatia, Tangail
                </h3>
                <p>Duty Roaster</p> <br>
            </center>
            <div class="degi">
                <p>Name: {{ $ndata->name }}</p>
                <p>Designation: {{ $ndata->designation }}</p>
                <p>Department: {{ $ndata->department }}</p>
            </div><br>
            <table id="customers">
                <tr style="text-align: center">
                    <td class="name-col">Exam Date</td>
                    <td class="name-col">Attendance Time</td>
                    <td class="name-col">Exam Start Time</td>
                </tr>
                <tr>
                    <td>
                        @if ($ndata->duty_date)
                            @php
                                $decodedData = json_decode($ndata->duty_date, true);
                            @endphp

                            @foreach ($decodedData as $date => $value)
                                @if ($value == 1)
                                    {{ $date }},
                                @endif
                            @endforeach
                        @else
                            No duty
                        @endif
                    </td>
                    <td style="text-align: center">{{ $first_time ?? '' }}</td>
                    <td style="text-align: center">{{ $end_time ?? '' }}</td>
                </tr>
            </table>
            <p>"Note: Respectful examiners are requested to be present on time for the proper conduct of the
                examination."</p><br><br>
            <div class="footer">
                <div class="left">
                    <p>Principal <br> Government Saadat College<br> Karatia, Tangail</p>
                </div>
                <div class="right">
                    <p>Convener <br> {{ $examName->title }}<br> Government Saadat College, Karatia, Tangail</p>
                </div>
            </div><br><br>
        @endforeach
    </div>

</body>


</html>
