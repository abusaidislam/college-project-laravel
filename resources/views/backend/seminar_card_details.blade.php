@extends('layouts.department')
@section('content')
    {{-- <div class="right_col" role="main"> --}}
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");

            * {
                --dark: #393939;
                --red: #d12229;
                --reda: #ff6030;
            }

            body {
                margin: 0;
                font-family: Roboto, Arial, Helvetica, sans-serif;
                position: relative;
            }

            .credit {
                position: absolute;
                top: 15px;
                right: 10px;
                border-radius: 10px;
                padding: 10px;
                background-color: rgb(248, 92, 113);
                cursor: pointer;
                z-index: 2;
                overflow: hidden;
            }

            .credit a {
                text-decoration: none;
                color: #eee;
                padding: 10px;
            }

            .credit:after {
                box-sizing: border-box;
                content: "";
                border: 8px solid;
                border-color: transparent transparent transparent #eee;
                width: 8px;
                height: 8px;
                position: absolute;
                right: 1px;
                top: 50%;
                transform: translateY(-50%);
                transition: all 0.5s;
            }

            .credit:hover::after {
                right: -3px;
            }

            .test {
                background-color: #1769ff;
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: -100%;
                transition: .5s ease-in-out;
                z-index: -1;
            }

            .credit:hover .test {
                left: 0;
            }

            .business2 {
                display: flex;
                align-items: center;
                min-height: 100vh;
                justify-content: center;

            }

            .business2 .front {
                /* background-color: var(--dark); */
                width: 270px;
                height: 410px;
                margin: 20px;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
                background-image: url('{{ asset('public/library_card/bk11.jpg') }}');
                background-size: cover;
                background-position: center;

            }



            .business2 .back {
                width: 270px;
                height: 410px;
                margin: 20px;
                border-radius: 10px;
                overflow: hidden;
                position: relative;
                background-image: url('{{ asset('public/library_card/backbk11.jpg') }}');
                background-size: cover;
                background-position: center;

            }


            .business2 h1,
            .business2 h2,
            .business2 p {
                margin: 0;
                color: #000000;
            }

            .business2 .red {
                height: 31%;
                background-color: var(--red);
            }

            .business2 .head {
                display: flex;
                justify-content: center;
                padding: 30px 0;

            }

            .business2 .head img {
                width: 40px;
            }

            .business2 .head>div {
                text-align: center;
                margin: 0 5px;
                text-transform: uppercase;
            }

            .business2 .head>div p {
                font-size: 0.8rem;
                font-weight: 600;
            }

            .business2 .avatars {
                position: absolute;
                width: 33%;
                left: 50%;
                top: 82px;
                transform: translate(-50%);
                text-align: center;
            }

            .business2 .avatersname {
                position: absolute;
                width: 100%;
                top: 175px;
                text-align: center;
                padding: 0 10px;
            }

            .business2 .img {
                background-color: #000000;
                /* padding: 5px; */
                box-sizing: border-box;
                border-radius: 5px;
                border: 3px solid black;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .business2 .img img {
                width: 100%;
                /* padding: 5px 0; */
            }

            .business2 .avatars p:nth-of-type(1) {
                text-transform: uppercase;
                font-weight: 900;
            }

            .business2 .infos {
                position: absolute;
                bottom: 6%;
                left: 7%;
                /* border: 1px solid black; */
                width: 86%;
                padding: 3px;

            }

            .business2 .infos>div {
                display: flex;
                margin: 5px;
            }

            .business2 .infos>div p {
                font-size: 0.8rem;
                /* margin: 1px 0; */
                font-weight: 500;
            }

            /* back*/
            .business2 .back .top {
                width: 100%;
                box-sizing: border-box;
                height: 64%;
                filter: contrast(160%);
                position: relative;
            }

            .business2 .back .top::after {
                content: "";
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 10;
            }

            .business2 .back .top {
                position: relative;
            }

            .business2 .back .top div img {
                width: 40px;
                margin: 10px;
            }

            .business2 .back .top div {
                position: absolute;
                display: flex;
                flex-direction: column;
                align-items: center;
                top: 10%;
                left: 2%;
                z-index: 11;
                filter: contrast(80%);
                /* text-transform: uppercase; */
                padding: 20px;
                text-align: justify
            }

            .webicon {
                background-color: var(--dark);
                border-radius: 50%;
                width: 70%;
                padding: 20px 0;
                position: absolute;
                top: calc(70% - 40px);
                left: 15%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .webicon div {
                background-color: var(--red);
                border-radius: 50%;
                padding: 5px 4px 2px 5px;
            }

            .business2 .back>p {
                text-align: center;
                margin-top: 15%;
                color: white;
            }

            .back .date {
                margin-left: 40px;
                font-weight: 600;
            }

            .back .sing {
                margin-top: 15px;
                text-align: right;
                margin-right: 10px;
            }
        </style>
        <div class="">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <span class="input-group-btn" style="margin-top:-100px; margin-left:10px">
                            <a class="btn btn-success" href="javascript:void(0)" id="download"><i class="fa fa-download"
                                    style="font-size:18px"> Download</i></a>
                        </span><br>
                    </div>
                </div>
                <div class="row">
                </div><br><br><br>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content sssss">
                            {{-- @foreach ($ndata as $ndata) --}}
                            <div class="business2" style="margin-top: -70px; margin-bottom:-90px">
                                <div class="front">
                                    <div class="golsap">
                                        <div class="head">
                                            <img src="{{ asset('public/library_card/' . $basic->photo) }}" alt=""
                                                srcset="" width="70" height="40">
                                            <div>
                                                <h2><strong>Govt. Saadat College</strong></h2>
                                                <p>Karatia, Tangail</p>
                                            </div>
                                        </div>
                                        <div class="avatars">
                                            <div class="img">
                                                <img src="{{ asset('public/library_card/' . $ndata->photo) }}"
                                                    alt="" width="60px" height="80px">
                                            </div>

                                        </div>
                                        <div class="avatersname">
                                            <p>{{ $ndata->student_name }}</p>
                                            <p> <span style="border-bottom: 2px solid black">SEMINAR ID CARD</span></p>
                                        </div>
                                        <div class="infos">
                                            <div>
                                                @php
                                                    $info = DB::table('students')
                                                        ->where('id', $ndata->student_name)
                                                        ->first();
                                                    $dept = DB::table('departments')
                                                        ->where('id', $ndata->department_id)
                                                        ->first();
                                                    $classinfo = DB::table('studen_classes')
                                                        ->where('id', $ndata->class)
                                                        ->first();
                                                    $degreeClass = DB::table('degree_classes')
                                                        ->where('id', $ndata->class)
                                                        ->first();
                                                @endphp
                                                <div>
                                                    <p> Card No : {{ $ndata->card_no }}</p>
                                                    <p> Roll : {{ $ndata->roll }}</p>
                                                    <p> Regi : {{ $ndata->registration }}</p>
                                                    <p>Dept : {{ $dept->name }}</p>
                                                    <p>Class : {{ $classinfo ? $classinfo->name : '' }}
                                                    </p>
                                                    <p>Session : {{ $ndata->session }}</p>
                                                    <p>Blood Group : {{ $ndata->blood_group }} </p>
                                                    <p>Mobile No : {{ $ndata->mobile_no }}</p>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <!-- back -->
                                <div class="back">
                                    <div class="top">

                                        <div>
                                            <h4 style="border-bottom: 2px solid black">Terms & Conditions</h4><br>
                                            @foreach ($data as $idata)
                                                <p>{{ $idata->instruction }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <?php
                                    $startDate = new DateTime($ndata->date);
                                    $endDate = $startDate->modify('+1 year');
                                    ?>
                                    <div class="date">
                                        <p>
                                            {!! DNS1D::getBarcodeHTML(" $ndata->registration","PHARMA",1)!!}
                                            Create Date : {{ $ndata ? $ndata->date : '' }} <br>
                                            Expire Date : {{ $endDate ? $endDate->format('Y-m-d') : '' }}
                                        </p>
                                    </div>
                                    <div class="sing">
                                        <p>
                                            <img src="{{ asset('public/library_card/' . $basic->signature) }}"
                                                alt="" srcset="" width="135" height="25"><br>
                                            Signature Head of The Dept.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        <script>
            document.getElementById('download').addEventListener('click', function() {
                // Options for PDF generation
                var options = {
                    margin: 5,
                    filename: 'seminar_card.pdf',
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
                var element = document.querySelector('.sssss');

                // Generate PDF
                html2pdf(element, options);
            });
        </script>
    @endsection
