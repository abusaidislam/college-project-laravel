<!DOCTYPE html>
<html>
<title>Incourse Master Final Year Result</title>

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
    @php
        $department = DB::table('departments')
            ->where('id', $depart_id)
            ->first();
        $studentclass = DB::table('studen_classes')
            ->where('id', $class)
            ->first();
    @endphp

    <center>
        <h2>Government Saadat College <br>{{ $department->name ?? '' }}<br>
            <span style="border-bottom:2px solid black">InCourse Result</span>
            <br><span style="font-size: 16px">Class Name: {{ $studentclass ? $studentclass->name : '' }}</span> ||
            <span style="font-size: 16px"> Course Code: {{ $subject ?? '' }}</span>
        </h2>
    </center>


    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Session</th>
            <th>Roll No</th>
            <th>Reg No</th>
            <th>Result</th>
        </tr>
        @foreach ($data as $item)
            @php
                $studentdata = DB::table('student_honours_secound_years')
                    ->where('id', $item->student_id)
                    ->where('depart_id', $item->depart_id)
                    ->first();

                $max1 = $item->total1st_result;
                $max2 = $item->total2nd_result;
                $max = $max1 > $max2 ? $max1 : $max2;
            @endphp
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td style="text-align: center">{{ $item->student_class_year }}</td>
                <td style="text-align: center">{{ $studentdata ? $studentdata->roll : '' }}</td>
                <td style="text-align: center">{{ $studentdata ? $studentdata->registration_no : '' }}</td>
                <td style="text-align: center">{{ $max }}
                </td>
            </tr>
        @endforeach

    </table>

</body>

</html>
