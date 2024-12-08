<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <style>
        @font-face {
            font-family: "SolaimanLipi";
            src: url("{{ public_path('banglafont/SolaimanLipi.ttf') }}") format('truetype');
        }

        body {
            font-family: "SolaimanLipi", sans-serif;
        }

        .headertext h4 {
            font-size: 22px;
            word-spacing: 5px;
        }

        .textsty {
            border-bottom: 1px dotted black;

        }

        body {
            font-family: "AdorshoLipi", DejaVu Sans;
        }

        .tableColor {
            background-color: #00000047;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
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
        }

        /* Style for table row on hover */
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <div class="row ">
                    <div class="col-md-6 col-sm-8 p-0">
                        <style>
                            .headerimg img {}

                            .headertext h4 {
                                font-size: 22px;
                                word-spacing: 5px;
                            }

                            .textsty {
                                border-bottom: 1px dotted black;

                            }

                            .tableColor {
                                background-color: #00000047;
                            }

                            /* print-styles.css */
                            /* Include any necessary Bootstrap styles here */
                            /* Example Bootstrap styles for tables */
                            .table {
                                width: 100%;
                                max-width: 100%;
                                margin-bottom: 1rem;
                                border-collapse: collapse;
                                background-color: transparent;
                                /* Add background-color if needed */
                            }

                            .table th,
                            .table td {
                                padding: 0.75rem;
                                vertical-align: top;
                                border-top: 1px solid #dee2e6;
                            }

                            /* Add any other custom styles you need */
                        </style>
                        <div id="libInp" class="container pr-3 pl-3" style="border: 1px solid black">
                            <div class="row" style="padding: 20px 10px 0px 10px">
                                <div class="col-md-3 text-right headerimg">
                                    <img src="{{ asset('public/basic/' . $basic->logo) }}" alt="" width="70"
                                        height="70">
                                </div>
                                <div class="col-md-7 d-flex align-items-center headertext">
                                    <h4 class="text-center"><b>সরকারি সা’দাত কলেজ <br> করটিয়া, টাঙ্গাইল।</b>
                                    </h4>

                                </div>
                            </div><br>
                            @php
                                $department = DB::table('departments')
                                    ->where('id', $ndata->department_id)
                                    ->first();
                                $stu_name = DB::table('students')
                                    ->where('id', $ndata->student_name)
                                    ->first();

                                $class = DB::table('studen_classes')
                                    ->where('id', $ndata->class)
                                    ->first();
                                $buldingName = DB::table('hostel_buldings')
                                    ->where('id', $ndata->bulding_id)
                                    ->first();
                                $floorName = DB::table('hostel_floors')
                                    ->where('id', $ndata->floor_id)
                                    ->first();
                                $roomNum = DB::table('hostel_rooms')
                                    ->where('id', $ndata->room_id)
                                    ->first();
                                $bedNum = DB::table('hostel_rooms')
                                    ->where('id', $ndata->bed_id)
                                    ->first();

                            @endphp
                            <div class="row pr-1 pl-1">
                                <div class="col-md-12 text-center">
                                    <h4> <span class="textsty">{{ $department->name }} </span>বিভাগ</h4>
                                    <button type="button" class="btn btn-outline-primary">আদায় রশিদ</button>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-md-7">
                                        <b>রশিদ নং: <span class="textsty">0{{ $ndata->id }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-5 s">
                                        <b>তারিখ: <span class="textsty">{{ $ndata->created_at->format('d/m/Y') }}
                                                ইং</span></b>
                                    </div>


                                    <div class="col-md-7">
                                        <b> ছাত্র/ছাত্রীর নাম: <span class="textsty">{{ $stu_name->name }}</span>
                                        </b>

                                    </div>
                                    <div class="col-md-5 s">
                                        <b>রোল নং: <span class="textsty">{{ $ndata->roll }}</span>
                                        </b>

                                    </div>

                                    <div class="col-md-7">
                                        <b> শ্রেণী/বিভাগ : <span class="textsty">{{ $class->name }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-5 s">
                                        <b>শিক্ষাবর্ষ: <span class="textsty">{{ $ndata->session }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-7 ">
                                        <b>হলের নাম: <span class="textsty">{{ $buldingName->bulding_name }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-5 s">
                                        <b> তলায় নাম: <span class="textsty">{{ $floorName->floor_name }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-7">
                                        <b> কক্ষ নং:<span class="textsty">{{ $roomNum->room_number }}</span>
                                        </b>
                                    </div>
                                    <div class="col-md-5 s">
                                        <b>সিট নং: <span class="textsty">{{ $bedNum->seat_number }}</span>
                                        </b>
                                    </div>

                                </div><br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center tableColor">
                                            <th>ক্রঃ নং</th>
                                            <th>বিবরণ</th>
                                            <th>টাকার পরিমাণ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="height: 200px;">
                                            <td style="width: 11%" class="tableColor">
                                                @foreach ($data as $key => $idata)
                                                    <p>{{ $key + 1 }}</p>
                                                @endforeach
                                            </td>
                                            <td style="width: 50%">
                                                @foreach ($data as $idata)
                                                    <p>{{ $idata->instruction }}</p>
                                                @endforeach
                                            </td>
                                            <td style="width: 21%" class="tableColor">
                                                {{ $ndata->payment_amount }}/-
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tableColor"></td>
                                            <td class="text-right">সর্বমোট =</td>
                                            <td class="tableColor"> {{ $ndata->payment_amount }}/-</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row pl-1">
                                    <div class="col-md-12">
                                        <p>কথায়:
                                            <span>............................................................................................................................</span>
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-right" style="margin: 20px 0px 20px 0px">
                                        <b class="text-right"> আদায়কারীর স্বাক্ষর ও তারিখ
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <p id="libOp"></p>
        <p id="libOb"> </p>
    </div>
</body>

</html>
