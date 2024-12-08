@extends('layouts.hosapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                    </span>
                </div>
            </div>
            <div class="row">
                <div id="libBtnWrap">
                    <span class="input-group-btn" style="margin-top:-100px;">
                        <a class="btn btn-success" href="javascript:void(0)" id="download">Download</a>
                    </span><br>
                </div>

            </div>
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
                                </style>
                                <div class="container pr-3 pl-3 studentrecipt" style="border: 1px solid black;">
                                    <div class="row" style="padding: 20px 0px 0px 10px">
                                        <div class="col-md-3 text-right headerimg">
                                            <img src="{{ asset('public/basic/' . $basic->logo) }}" alt=""
                                                width="100" height="80">
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center headertext">
                                            <h4 class="text-center"><b>সরকারি সা’দাত কলেজ <br> করটিয়া, টাঙ্গাইল।</b>
                                            </h4>

                                        </div>
                                    </div>
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

                                            <h4> <span class="textsty"> {{ $buldingName->bulding_name }} </span></h4>

                                            <button type="button" class="btn btn-outline-primary">আদায় রশিদ</button>
                                        </div>
                                        {{-- <div class="col-md-12 text-center">
                                            @if ($ndata->department_id == 40)
                                                <h4> <span class="textsty"> Department of General </span></h4>
                                            @else
                                                <h4> <span class="textsty"> {{ $department->name }}</span></h4>
                                            @endif
                                            <button type="button" class="btn btn-outline-primary">আদায় রশিদ</button>
                                        </div> --}}
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
                                                <b> ছাত্র/ছাত্রীর নাম: <span
                                                        class="textsty">{{ $ndata->student_name }}</span>
                                                </b>

                                            </div>
                                            <div class="col-md-5 s">
                                                <b>রোল নং: <span class="textsty">{{ $ndata->roll }}</span>
                                                </b>

                                            </div>

                                            <div class="col-md-7 ">
                                                @if ($ndata->department_id == 40)
                                                    <b>বিভাগ: <span class="textsty">Department of General</span>
                                                    </b>
                                                @else
                                                    <b>বিভাগ: <span class="textsty">{{ $department->name }}</span>
                                                    </b>
                                                @endif
                                            </div>
                                            <div class="col-md-5 s">
                                                <b>শিক্ষাবর্ষ: <span class="textsty">{{ $ndata->session }}</span>
                                                </b>
                                            </div>

                                            <div class="col-md-7">
                                                <b> শ্রেণী : <span class="textsty">{{ $class->name }}</span>
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
                                                            <p>{{ $idata->recipt_note }}</p>
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
            </div>
        </div>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script> --}}

        <script>
            document.getElementById('download').addEventListener('click', function() {
                // Options for PDF generation
                var options = {
                    margin: 30,
                    filename: 'hostel_student_receipt.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };

                // Element to be converted to PDF
                var element = document.querySelector('.studentrecipt');

                // Generate PDF
                html2pdf(element, options);
            });
        </script>
    @endsection
