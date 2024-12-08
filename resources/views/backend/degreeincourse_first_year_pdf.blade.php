<!DOCTYPE html>
<html>
<title>Incourse First Year Result</title>

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
        $studentclass = DB::table('degree_classes')
            ->where('id', $class)
            ->first();

    @endphp
    <center>
        <h2>Government Saadat College <br> Department of Degree<br>
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
            {{-- @dd($item); --}}
            @php
                $studentdata = DB::table('degree_first_year_students')
                    ->where('id', $item->student_id)
                    ->first();

                $max1 = $item->total1st_result;
                $max2 = $item->total2nd_result;
                $max = $max1 > $max2 ? $max1 : $max2;
            @endphp
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->student_class_year }}</td>
                <td>{{ $studentdata ? $studentdata->roll : '' }}</td>
                <td>{{ $studentdata ? $studentdata->registration_no : '' }}</td>
                <td>{{ $max }}
                </td>
            </tr>
        @endforeach

    </table>

</body>

</html>
