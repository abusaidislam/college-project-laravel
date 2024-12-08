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

    <center>
        <h2>Government Saadat College</h2>
        <p>InCourse Result</p>
    </center>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Reg No</th>
            <th>Year</th>
            <th>Class</th>
            <th>Result</th>
        </tr>
        @foreach ($data as $item)
            {{-- @dd($item); --}}
            @php
                $studentdata = DB::table('students')
                    ->where('id', $item->student_id)
                    ->first();
                $studentclass = DB::table('studen_classes')
                    ->where('id', $item->class_id)
                    ->first();
                
                $max1 = $item->total1st_result;
                $max2 = $item->total2nd_result;
                $max = $max1 > $max2 ? $max1 : $max2;
            @endphp
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $studentdata->roll }}</td>
                <td>{{ $studentdata->registration_no }}</td>
                <td>{{ $item->years }}</td>
                <td>{{ $studentclass->name }}</td>
                <td>{{ $max }}
                </td>
            </tr>
        @endforeach
    </table>

</body>

</html>
