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
        <p>Merit List</p>
    </center>

    <table id="customers">
        <tr>
            <th>SL</th>
            <th>Class Name</th>
            <th>Name</th>
            <th>Session</th>
            <th>Roll No</th>
            <th>Reg No</th>
            @php
                $course = DB::table('degree_courses')
                    ->where('class_id', 4)
                    ->get();
            @endphp
            @foreach ($course as $v)
                <th>{{ $v->course_code }}</th>
            @endforeach
            <th>Total Mark</th>
        </tr>
        @foreach ($data as $item)
            @php
                $ClassName = DB::table('degree_classes')
                    ->where('id', $item->class_id)
                    ->first();
            @endphp
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $ClassName->name }}</td>
                <td>{{ $item->student_name }}</td>
                <td>{{ $item->session_year }}</td>
                <td>{{ $item->roll }}</td>
                <td>{{ $item->registration_no }}</td>
                @php
                    $totalMarks = 0;
                @endphp
                @foreach ($course as $v)
                    @php
                        $found = DB::table('degree_student_results')
                            ->where('student_id', $item->id)
                            ->where('subject', $v->id)
                            ->first();
                        $marks = $found ? $found->written_mark : 0;
                        $totalMarks += $marks;
                    @endphp
                    <td>
                        {{ $marks }}
                    </td>
                @endforeach

                <td>{{ $totalMarks }}</td>
            </tr>
        @endforeach

    </table>

</body>

</html>
