<!DOCTYPE html>
<html>

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
    @endphp
    <center>
        <h2>Government Saadat College <br>{{ $department->name ?? '' }}<br>
            <span style="border-bottom:2px solid black">Merit List</span>
        </h2>
    </center>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Class</th>
            <th>Session</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Reg No</th>
            <th>Total Result</th>
            <th>Atten Marks</th>
            <th>Merit Marks</th>
        </tr>
        @foreach ($data as $item)
            @php
                $studentdata = DB::table('students')
                    ->where('depart_id', $item->depart_id)
                    ->where('id', $item->student_id)
                    ->first();
                $studentclass = DB::table('studen_classes')
                    ->where('id', $item->class_id)
                    ->first();
            @endphp
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $studentclass ? $studentclass->name : '' }}</td>
                <td>{{ $item->student_class_year }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $studentdata ? $studentdata->roll : '' }}</td>
                <td>{{ $studentdata ? $studentdata->registration_no : '' }}</td>
                <td>{{ $item->total_result }}</td>
                <td>{{ $item->atten_mark }}</td>
                <td>{{ $item->merit_marks }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
