<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Taprom' rel='stylesheet'>
    {{-- <link href="https://fonts.cdnfonts.com/css/braves-factor" rel="stylesheet"> --}}
    <link href="//db.onlinewebfonts.com/c/2bfff68f61ed87f31072e43aa92486c4?family=Newborough" rel="stylesheet"
        type="text/css" />
    {{-- <link href="https://fonts.cdnfonts.com/css/shutter-braille-free-version" rel="stylesheet"> --}}


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 22.7.0" />
    <title></title>
    <style>
        .containers {
            background-image: url({{ asset('public/upload/image_border.png') }});
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* margin-top: 0px; */
            /* background-margin: auto; */
            /* ইমেজের উচ্চতা এবং প্রস্থ কমানোর জন্য প্রপার্টি ব্যবহার করুন */
        }

        .jolshap {
            background-image: url({{ asset('public/upload/imagelogo1.png') }});
            background-repeat: no-repeat;
            background-size: 40% 40%;
            /* margin-top: 420px;
            margin-left: 420px; */
            /* background-margin: auto; */
            /* ইমেজের উচ্চতা এবং প্রস্থ কমানোর জন্য প্রপার্টি ব্যবহার করুন */
        }
    </style>

</head>

<body class="" style="font-family:'Times New Roman'; font-size:12pt; width:940px; margin:auto; border:">
    <div class="containers p-4">
        <div class="">
            <div class="mt-5" style="    background: #b5a3a312; padding: 10px; border: 12px red;">
                {{-- <div class="mt-4"> --}}
                <div class="row mt-5">

                    <div class="col-md-12" style="margin-left: 20px">
                        <center>
                            <h2>
                                Government Saadat College
                            </h2>
                            <h3>
                                Karatia, Tangail-1903
                            </h3>
                        </center>

                    </div>

                </div>

                <div class="row mt-1 p-3 ">
                    <div class="col-md-4">
                        <p class="">
                            <span style="font-family:Arial; font-size:10.5pt">NUMC 11- </span>
                            <span
                                style="font-family:Arial; font-size:10.5pt; letter-spacing:7.1pt; -aw-import:spaces">&#xa0;</span>
                            <span style="font-family:Arial; font-size:10.5pt">0 3 3 5 5 8 4 </span>
                            <span style="font-family:Arial; font-size:10.5pt; -aw-import:spaces">&#xa0;</span>
                        </p>
                        <p class="mb-0">

                            <span style="font-family:'Courier New'; font-size:14pt">Roll
                                No.&#xa0;&#xa0;:{{ $studentInfos->roll }}
                            </span>
                        </p>
                        <p class="mb-0">
                            <span
                                style="font-family:'Courier New'; font-size:14pt">Regn.No.&#xa0;&#xa0;:{{ $studentInfos->registration_no }}
                            </span>
                        </p>
                        <p class="mb-0">
                            <span style="font-family:'Courier New'; font-size:14pt">Session
                                &#xa0;&#xa0;:{{ $studentInfos->session }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <span>
                            <img src="{{ asset('public\upload\imagelogo1.png') }}" width="150" height="130"
                                alt="" />
                        </span>

                    </div>
                    <div class="col-md-4">
                        <p class="m-0">
                            <span style="font-size:8.5pt">Total Marks </span>
                            <span style="font-size:8.5pt; letter-spacing:13.3pt; -aw-import:spaces">&#xa0;</span>
                            <span style="font-size:8.5pt">2000</span>
                        </p>
                        <p class="m-0">
                            <span style="font-size:9pt">First Class </span>
                            <span style="font-size:9pt; letter-spacing:20.8pt; -aw-import:spaces">&#xa0;</span>
                            <span style="font-size:9pt; letter-spacing:0.05pt">60%</span>
                            <span style="font-size:9pt"> &amp; above </span>
                        </p>
                        <p class="m-0">
                            <span style="font-size:9pt">Second Class </span>
                            <span style="font-size:9pt; letter-spacing:0.05pt">45%</span>
                            <span style="font-size:9pt"> &amp; above but less than </span>
                            <span style="font-size:9pt; letter-spacing:0.05pt">60%</span>
                        </p>
                        <p class="m-0">
                            <span style="font-size:9pt;">Third Class </span>
                            <span style="font-size:9pt; letter-spacing:0.05pt">36%</span>
                            <span style="font-size:9pt"> &amp; above </span>
                            <span style="font-size:9pt; letter-spacing:0.05pt">but</span>
                            <span style="font-size:9pt"> less than 45% </span>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                            <span style="font-family:Arial; font-size:19.5pt; letter-spacing:0.05pt">Marks</span>
                            <span style="font-family:Arial; font-size:19.5pt"></span>
                            <span style="font-family:Arial; font-size:19.5pt; letter-spacing:0.1pt">Certificate</span>
                            <span style="font-family:Arial; font-size:19.5pt; -aw-import:spaces">&#xa0;&#xa0;&#xa0;
                            </span>
                        </p>
                        <p class="mb-0">
                            <span style="font-family:Arial; font-size:17.5pt">B.A. </span>
                            {{-- <span style="font-family:Arial; font-size:17.5pt; "></span> --}}
                            {{-- <span style="font-family:Arial; font-size:17.5pt">Honours Examination, {{ $studentyears->years }} </span> --}}
                            <span style="font-family:Arial; font-size:17.5pt">Honours Examination, 2023 </span>
                        </p>
                        <p>
                            <span style="font-family:Arial; font-size:15.5pt">Subject: {{ $studentInfos->department }}
                            </span>
                        </p>
                    </div>
                </div>


                <div class="row mt-3 p-2">
                    <div class="col-md-3 ">
                        <p class="">
                            <span style="font-size:16pt">Name</span>
                        </p>
                        <p>
                            <span style="font-size:16pt">Name of the College</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size: 14pt" class="mb-0">
                            :<span style="font-family:'Brush Script MT', cursive, sans-serif; font-size:20pt">
                                {{ $studentInfos->name }}</span>
                        </p>
                        <p style="font-size: 14pt">
                            :<span style="font-family:'Brush Script MT', cursive, sans-serif; font-size:20pt">
                                Government Saadat
                                College</span>
                        </p>
                    </div>
                </div>

                <p
                    style="margin-top:10pt; margin-left:48pt; margin-bottom:-9pt; text-align:justify; line-height:11.75pt">
                    <strong style="font-family:Arial; font-size:10.5pt">1st Year </strong>
                    <span
                        style="font-family:Arial; font-size:10.5pt; letter-spacing:92.55pt; -aw-import:spaces">&#xa0;</span>
                    <strong style="font-family:Arial; font-size:10.5pt">2nd Year </strong>
                    <span
                        style="font-family:Arial; font-size:10.5pt; letter-spacing:89.05pt; -aw-import:spaces">&#xa0;</span>
                    <strong style="font-family:Arial; font-size:10.5pt">3rd Year </strong>
                    <span
                        style="font-family:Arial; font-size:10.5pt; letter-spacing:91.7pt; -aw-import:spaces">&#xa0;</span>
                    <strong style="font-family:Arial; font-size:10.5pt">4th Year </strong>
                </p>
                {{-- top table --}}
                <div class="row">
                    {{-- @foreach ($students_id as $student_id) --}}
                    {{-- @if ($student_id->class_id == 1 or $student_id->class_id == 2) --}}
                    <div class="col-md-3">
                        @if ($students_id->class_id == 1)
                            <p>
                            <table cellspacing="0" cellpadding="0"
                                style="margin-left:3.45pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                                <tr style="height:21.85pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:42.35pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:47.02pt; padding-left:43.58pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:12.3pt">
                                            <span style="font-family:Arial; font-size:11pt">Theory </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:23.3pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Course</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Code</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Full</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-left:2.9pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Marks</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:44.98pt; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-indent:6.95pt; text-align:center; line-height:11pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Marks
                                            </span>
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Obtained</span>
                                        </p>
                                    </td>
                                </tr>
                                @foreach ($studentResult as $item)
                                    <tr style="height:17.15pt; -aw-height-rule:exactly">
                                        <td
                                            style="width:29.78pt; padding:4px; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c;  vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:9.5pt">{{ $item->course_code }}</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.28pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span style="font-family:'Century Gothic'; font-size:10.5pt">100</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.4pt; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:10.5pt">0{{ $item->marks }}
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr style="height:17.15pt; -aw-height-rule:exactly">
                                    <td colspan="2"
                                        style="width:36.2pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:13.32pt; padding-left:33.02pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:1.9pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span style="font-family:'Century Gothic'; font-size:10pt">Total :
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:24.3pt; border:0.75pt solid #08080c; padding-right:8.68pt; padding-left:16.68pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:1.95pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt">{{ $studentResult->sum('marks') }}
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:12.7pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:43.4pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">Tutorial
                                            </span>
                                        </p>
                                    </td>
                                </tr>

                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:29.98pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:7.93pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">1151
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.62pt; padding-left:15.82pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">025
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:7.42pt; padding-left:16.77pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">012
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:132.95pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:14.4pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:53.85pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #0f0f0f; border-bottom:0.75pt solid #08080c; padding-right:40.38pt; padding-left:36.92pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:11.4pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:9.5pt; letter-spacing:0.15pt">Vivo-voce</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:17.05pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:37.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; vertical-align:middle; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:43.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:49.65pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>

                                </tr>
                            </table>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if ($students_id->class_id == 2)
                            <p>
                            <table cellspacing="0" cellpadding="0"
                                style="margin-left:3.45pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                                <tr style="height:21.85pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:42.35pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:47.02pt; padding-left:43.58pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:12.3pt">
                                            <span style="font-family:Arial; font-size:11pt">Theory </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:23.3pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Course</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Code</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Full</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-left:2.9pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Marks</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:44.98pt; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-indent:6.95pt; text-align:center; line-height:11pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Marks
                                            </span>
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Obtained</span>
                                        </p>
                                    </td>
                                </tr>
                                @foreach ($studentResult as $item)
                                    <tr style="height:17.15pt; -aw-height-rule:exactly">
                                        <td
                                            style="width:29.78pt; padding:4px; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c;  vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:9.5pt">{{ $item->course_code }}</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.28pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span style="font-family:'Century Gothic'; font-size:10.5pt">100</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.4pt; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:10.5pt">0{{ $item->marks }}
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr style="height:17.15pt; -aw-height-rule:exactly">
                                    <td colspan="2"
                                        style="width:36.2pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:13.32pt; padding-left:33.02pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:1.9pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span style="font-family:'Century Gothic'; font-size:10pt">Total :
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:24.3pt; border:0.75pt solid #08080c; padding-right:8.68pt; padding-left:16.68pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:1.95pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt">{{ $studentResult->sum('marks') }}
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:12.7pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:43.4pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">Tutorial
                                            </span>
                                        </p>
                                    </td>
                                </tr>

                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:29.98pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:7.93pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">1151
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.62pt; padding-left:15.82pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">025
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:7.42pt; padding-left:16.77pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">012
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:132.95pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:14.4pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:53.85pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #0f0f0f; border-bottom:0.75pt solid #08080c; padding-right:40.38pt; padding-left:36.92pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:11.4pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:9.5pt; letter-spacing:0.15pt">Vivo-voce</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:17.05pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:37.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; vertical-align:middle; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:43.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:49.65pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>

                                </tr>
                            </table>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if ($students_id->class_id == 3)
                            <p>
                            <table cellspacing="0" cellpadding="0"
                                style="margin-left:3.45pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                                <tr style="height:21.85pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:42.35pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:47.02pt; padding-left:43.58pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:12.3pt">
                                            <span style="font-family:Arial; font-size:11pt">Theory </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:23.3pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Course</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Code</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Full</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-left:2.9pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Marks</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:44.98pt; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-indent:6.95pt; text-align:center; line-height:11pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Marks
                                            </span>
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Obtained</span>
                                        </p>
                                    </td>
                                </tr>
                                @foreach ($studentResult as $item)
                                    <tr style="height:17.15pt; -aw-height-rule:exactly">
                                        <td
                                            style="width:29.78pt; padding:4px; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c;  vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:9.5pt">{{ $item->course_code }}</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.28pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span style="font-family:'Century Gothic'; font-size:10.5pt">100</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.4pt; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:10.5pt">0{{ $item->marks }}
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr style="height:17.15pt; -aw-height-rule:exactly">
                                    <td colspan="2"
                                        style="width:36.2pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:13.32pt; padding-left:33.02pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:1.9pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span style="font-family:'Century Gothic'; font-size:10pt">Total :
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:24.3pt; border:0.75pt solid #08080c; padding-right:8.68pt; padding-left:16.68pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:1.95pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt">{{ $studentResult->sum('marks') }}
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:12.7pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:43.4pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">Tutorial
                                            </span>
                                        </p>
                                    </td>
                                </tr>

                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:29.98pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:7.93pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">1151
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.62pt; padding-left:15.82pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">025
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:7.42pt; padding-left:16.77pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">012
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:132.95pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:14.4pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:53.85pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #0f0f0f; border-bottom:0.75pt solid #08080c; padding-right:40.38pt; padding-left:36.92pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:11.4pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:9.5pt; letter-spacing:0.15pt">Vivo-voce</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:17.05pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:37.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; vertical-align:middle; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:43.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:49.65pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>

                                </tr>
                            </table>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if ($students_id->class_id == 4)
                            <p>
                            <table cellspacing="0" cellpadding="0"
                                style="margin-left:3.45pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                                <tr style="height:21.85pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:42.35pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:47.02pt; padding-left:43.58pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:12.3pt">
                                            <span style="font-family:Arial; font-size:11pt">Theory </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:23.3pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Course</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Code</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:32.62pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Full</span>
                                        </p>
                                        <p
                                            style="margin-top:0pt; margin-left:2.9pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Marks</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:44.98pt; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-indent:6.95pt; text-align:center; line-height:11pt">
                                            <span style="font-family:'Century Gothic'; font-size:9.5pt">Marks
                                            </span>
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt; letter-spacing:0.05pt">Obtained</span>
                                        </p>
                                    </td>
                                </tr>
                                @foreach ($studentResult as $item)
                                    <tr style="height:17.15pt; -aw-height-rule:exactly">
                                        <td
                                            style="width:29.78pt; padding:4px; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c;  vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:9.5pt">{{ $item->course_code }}</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.28pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span style="font-family:'Century Gothic'; font-size:10.5pt">100</span>
                                            </p>
                                        </td>
                                        <td
                                            style="width:25.4pt; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                            <p
                                                style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                                <span
                                                    style="font-family:'Century Gothic'; font-size:10.5pt">0{{ $item->marks }}
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr style="height:17.15pt; -aw-height-rule:exactly">
                                    <td colspan="2"
                                        style="width:36.2pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:13.32pt; padding-left:33.02pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:1.9pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span style="font-family:'Century Gothic'; font-size:10pt">Total :
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:24.3pt; border:0.75pt solid #08080c; padding-right:8.68pt; padding-left:16.68pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:1.95pt; margin-bottom:0pt; text-align:justify; line-height:11.85pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10pt">{{ $studentResult->sum('marks') }}
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:12.7pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:43.4pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">Tutorial
                                            </span>
                                        </p>
                                    </td>
                                </tr>

                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:29.98pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:7.93pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">1151
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:2.62pt; padding-left:15.82pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">025
                                            </span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:25.45pt; border:0.75pt solid #08080c; padding-right:7.42pt; padding-left:16.77pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:2.15pt; margin-bottom:0pt; text-align:justify; line-height:12.55pt">
                                            <span style="font-family:'Century Gothic'; font-size:10.5pt">012
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:18pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:132.95pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:14.4pt; -aw-height-rule:exactly">
                                    <td colspan="3"
                                        style="width:53.85pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #0f0f0f; border-bottom:0.75pt solid #08080c; padding-right:40.38pt; padding-left:36.92pt; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.05pt; margin-bottom:0pt; text-align:justify; line-height:11.4pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:9.5pt; letter-spacing:0.15pt">Vivo-voce</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="height:17.05pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:37.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; vertical-align:middle; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:43.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:49.65pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                            <span style="-aw-import:ignore">&#xa0;</span>
                                        </p>
                                    </td>

                                </tr>
                            </table>
                            </p>
                        @endif
                    </div>
                    {{-- @endif --}}
                    {{-- @endforeach --}}
                </div>

                {{-- top table --}}

                <p style="margin-top:11.85pt; margin-bottom:0pt; text-align:justify; font-size:1pt">
                    <span style="font-family:Arial; -aw-import:spaces">&#xa0;</span>
                </p>
                {{-- down table --}}
                <table cellspacing="0" cellpadding="0"
                    style="margin-left:9.6pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                    <tr style="height:34.55pt; -aw-height-rule:exactly">
                        <td
                            style="width:41.4pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Theory Total </span>
                            </p>
                        </td>
                        <td
                            style="width:37.68pt; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Tutoriel Total </span>
                            </p>
                        </td>
                        <td
                            style="width:61.9pt; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt; -aw-import:spaces">&#xa0;
                                </span>
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Vivo-voce </span>
                            </p>
                            <p
                                style="margin-top:0.05pt; margin-left:19.7pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Total </span>
                            </p>
                        </td>
                        <td
                            style="width:57.35pt; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-padding-left:0.35pt">
                            <p
                                style="margin-top:0pt; margin-left:5.15pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">English </span>
                            </p>
                            <p style="margin-top:2.5pt; margin-bottom:0pt; text-align:center; line-height:9.55pt">
                                <span style="font-family:'Century Gothic'; font-size:8pt">(Compulsory) </span>
                            </p>
                        </td>
                        <td
                            style="width:46.68pt; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:13.68pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="margin-top:0.05pt; margin-bottom:0pt; text-indent:0.1pt; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Military Science </span>
                            </p>
                        </td>
                        <td
                            style="width:36.82pt; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-left:6.72pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                            <p style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                <span style="font-family:'Century Gothic'; font-size:10.5pt">Grand Total </span>
                            </p>
                        </td>
                        <td
                            style="width:36.45pt; border-left:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:30.42pt; padding-left:26.12pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single">
                            <p style="margin-top:5.7pt; margin-bottom:0pt; text-align:center; line-height:11.7pt">
                                <span style="font-family:Consolas; font-size:10pt">Result</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:39.15pt; -aw-height-rule:exactly">
                        <td
                            style="width:29.9pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; padding-right:4.68pt; padding-left:17.38pt; vertical-align:top; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:9.05pt; margin-bottom:0pt; text-align:justify; line-height:11.1pt">
                                <span style="font-family:Arial; font-size:10pt">0810 </span>
                            </p>
                        </td>
                        <td
                            style="width:18.8pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; padding-right:4.68pt; padding-left:18.12pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:9.05pt; margin-bottom:0pt; text-align:justify; line-height:11.1pt">
                                <span style="font-family:Arial; font-size:10pt">72 </span>
                            </p>
                        </td>
                        <td
                            style="width:21.45pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; padding-right:17.52pt; padding-left:22.92pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:10.35pt; margin-bottom:0pt; text-align:justify; line-height:9.5pt">
                                <span style="font-family:Arial; font-size:8.5pt">058 </span>
                            </p>
                        </td>
                        <td
                            style="width:57.35pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single; -aw-padding-left:0.35pt">
                            <p
                                style="margin-top:0.05pt; margin-left:12.1pt; margin-bottom:0pt; text-align:justify; line-height:10.05pt">
                                <span style="font-family:Arial; font-size:9pt">049 </span>
                            </p>
                            <p style="margin-top:5.45pt; margin-bottom:0pt; text-align:justify; line-height:7.5pt">
                                <span
                                    style="font-family:Arial; font-size:6.5pt; font-style:italic; -aw-import:spaces">&#xa0;
                                </span>
                                <span style="font-family:Arial; font-size:6.5pt; font-style:italic">Above </span>
                                <span
                                    style="font-family:Arial; font-size:6.5pt; font-style:italic; letter-spacing:0.05pt">33</span>
                                <span style="font-family:Arial; font-size:6.5pt; font-style:italic"> added </span>
                            </p>
                            <p
                                style="margin-top:6.3pt; margin-left:12pt; margin-bottom:0pt; text-align:justify; line-height:7.5pt">
                                <span
                                    style="font-family:Arial; font-size:6.5pt; font-style:italic; letter-spacing:0.05pt">10</span>
                            </p>
                        </td>
                        <td
                            style="width:60.35pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
                                <span style="-aw-import:ignore">&#xa0;</span>
                            </p>
                        </td>
                        <td
                            style="width:20.85pt; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-left:0.75pt solid #08080c; padding-right:5.08pt; padding-left:17.62pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:4pt; margin-bottom:0pt; text-align:justify; line-height:11.65pt">
                                <span style="font-size:10.5pt">950</span>
                            </p>
                        </td>
                        <td
                            style="width:43.1pt; border-top:0.75pt solid #08080c; border-left:0.75pt solid #08080c; padding-right:30.98pt; padding-left:18.92pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-top:0.5pt single">
                            <p style="margin-top:1.1pt; margin-bottom:0pt; text-align:justify; line-height:14.5pt">
                                <span style="font-size:13pt; font-style:italic">Second</span>
                            </p>
                            <p
                                style="margin-top:4.15pt; margin-left:3.35pt; margin-bottom:0pt; text-align:justify; line-height:13.25pt">
                                <span style="font-size:12pt; font-style:italic">Class </span>
                            </p>
                        </td>
                    </tr>
                </table>

                <div class="row">
                    <div class="col-md-6">
                        <p
                            style="margin-top:5.65pt; margin-left:70.2pt; margin-bottom:0pt; text-align:justify; line-height:9.65pt">
                            <span
                                style="height:0pt; margin-top:-5.65pt; text-align:left; display:block; position:absolute; z-index:-1">
                                <img src="{{ asset('public/certificate/') }}/zzz.012.png" width="150"
                                    height="6" alt=""
                                    style="margin-top:15.92pt; margin-left:-31.9pt; -aw-left-pos:27pt; -aw-rel-hpos:page; -aw-rel-vpos:paragraph; -aw-top-pos:15.92pt; -aw-wrap-type:none; position:absolute" />
                            </span>

                            <span style="font-family:Arial; font-size:8.5pt; letter-spacing:0.05pt">9,</span>
                            <span style="font-family:Arial; font-size:8.5pt"></span>
                            <span style="font-family:Arial; font-size:8.5pt; letter-spacing:0.05pt">June</span>
                            <span style="font-family:Arial; font-size:8.5pt"></span>
                            <span style="font-family:Arial; font-size:8.5pt; letter-spacing:0.1pt">2023</span>
                            <span style="font-family:Arial; font-size:8.5pt;"></span>
                        </p>
                        <p
                            style="margin-top:4.65pt; margin-left:40.6pt; margin-bottom:0pt; text-align:justify; line-height:9.65pt">
                            <span style="font-family:Arial; font-size:8.5pt">Date </span>
                            <span style="font-family:Arial; font-size:8.5pt; letter-spacing:0.05pt">of</span>
                            <span style="font-family:Arial; font-size:8.5pt"> Publication </span>
                            <span style="font-family:Arial; font-size:8.5pt; letter-spacing:0.05pt">of</span>
                            <span style="font-family:Arial; font-size:8.5pt"> Resuït </span>
                        </p>

                    </div>
                    <div class="col-md-6">
                        <p
                            style="margin-top:10.65pt; margin-left:150.6pt; margin-bottom:0pt; text-align:justify; line-height:9.65pt">
                            <span style="font-family:Arial; font-size:10pt">Controller of Examinations </span>
                        </p>
                    </div>
                </div>

                <p
                    style="margin-top:20.7pt; margin-left:425.85pt; margin-bottom:0pt; text-align:justify; line-height:11.1pt">

                </p>
            </div>
        </div>
    </div>
</body>

</html>
