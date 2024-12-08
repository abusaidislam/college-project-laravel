<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Taprom' rel='stylesheet'>


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
    <span class="input-group-btn" style="margin-left:50px;">
        <a class="btn btn-success mt-4" href="javascript:void(0)" id="download"> Download</a>
    </span>

    <div class="containers p-4" style="margin-top: -40px">
        <div class="">
            <div class="mt-5" style="    background: #b5a3a312; padding: 10px; border: 12px red;">
                {{-- <div class="mt-4"> --}}
                <div class="row mt-5">

                    <div class="col-md-12" style="margin-left: 20px">


                    </div>

                </div>

                <div class="row mt-1 ">

                    <div class="col-md-2 text-center">
                        <span>
                            <img src="{{ asset('public\upload\imagelogo1.png') }}" width="150" height="120"
                                alt="" />
                        </span>

                    </div>
                    <div class="col-md-9 text-center" style="margin-top: -20px">

                        <h2>
                            Government Saadat College
                        </h2>
                        <h3>
                            Karatia, Tangail-1903
                        </h3>
                        @php
                            $examdata = DB::table('degree_classes')
                                ->where('id', 2)
                                ->first();
                        @endphp
                        <p class="mb-0">

                            <span style="font-family:Arial; font-size:15pt">{{ $examdata->name ?? '' }} Examination,
                                {{ $examyear->years ?? '' }}</span>
                        </p>
                        <p>
                            </span>
                        </p>
                        <p>
                            <span style="font-family:Arial; font-size:15.5pt"><strong><u>Result Sheet</u></strong>
                            </span>
                        </p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">

                            <tbody>
                                <tr class="">
                                    <td width=30%><strong> Name of Student</strong></td>
                                    <td>{{ $studentInfos->student_name ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>College</td>
                                    <td> Government Saadat College</td>

                                </tr>
                                <tr>
                                    <td>Exam. Roll</td>
                                    <td>{{ $studentInfos->roll ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>Registration No</td>
                                    <td>{{ $studentInfos->registration_no ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>Session</td>
                                    <td>{{ $studentInfos->session_year ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>Student Type</td>
                                    <td>Regular</td>

                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>Deparment of Degree</td>

                                </tr>
                                <tr>
                                    <td><strong>Result</strong></td>
                                    <td>Promoted</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- top table --}}
                <div class="row">
                    <div class="col-md-12">
                        <p>
                        <table cellspacing="0" cellpadding="0"
                            style="margin-left:3.45pt; border:0.75pt solid #08080c; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
                            <tr style="height:21.85pt; -aw-height-rule:exactly">
                                <td colspan="5"
                                    style="width:42.35pt; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding-right:47.02pt; padding-left:43.58pt; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; padding:3px; line-height:12.3pt">
                                        <span style="font-family:Arial; font-size:11pt">Course Wise Marks & Grade
                                        </span>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:23.3pt; -aw-height-rule:exactly">
                                <td
                                    style="width:10%; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt">
                                        <span><strong>Course</strong></span>
                                    </p>
                                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:12.1pt">
                                        <span><strong>Code</strong></span>
                                    </p>
                                </td>
                                <td
                                    style="width:70%; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11.55pt p-3">
                                        <span><strong>Course Title</strong></span>
                                    </p>

                                </td>
                                <td
                                    style="width:10%; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11pt p-2">
                                        <span><strong>Credit</strong></span>

                                    </p>
                                </td>
                                <td
                                    style="width:10%; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11pt p-2">
                                        <span><strong>Marks</strong></span>

                                    </p>
                                </td>
                                <td
                                    style="width:10%; border:0.75pt solid #08080c; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                    <p
                                        style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; line-height:11pt">
                                        <span><strong>Letter Grade</strong></span>
                                    </p>
                                </td>
                            </tr>
                            @php
                                $totalGpSum = 0;
                                $totalCreditSum = 0;
                                $hasFail = false;
                            @endphp
                            @foreach ($CourseIn as $item)
                                {{-- @dd($item); --}}
                                @php
                                    $studen = DB::table('degree_student_results')
                                        ->where('student_id', $item->id)
                                        ->where('class_id', $item->class_id)
                                        ->where('subject', $item->course_id)
                                        ->first();
                                    if ($studen) {
                                        $marks = $studen->marks;
                                        $gradPoint = $studen->marks;
                                        $grade = '';

                                        if ($marks >= 80) {
                                            $grade = 'A+';
                                        } elseif ($marks >= 75) {
                                            $grade = 'A';
                                        } elseif ($marks >= 70) {
                                            $grade = 'A-';
                                        } elseif ($marks >= 65) {
                                            $grade = 'B+';
                                        } elseif ($marks >= 60) {
                                            $grade = 'B';
                                        } elseif ($marks >= 55) {
                                            $grade = 'B-';
                                        } elseif ($marks >= 50) {
                                            $grade = 'C+';
                                        } elseif ($marks >= 45) {
                                            $grade = 'C';
                                        } elseif ($marks >= 40) {
                                            $grade = 'D';
                                        } else {
                                            $grade = 'F';
                                            $hasFail = true;
                                        }

                                        $gp = '';
                                        if ($gradPoint >= 80) {
                                            $gp = 4.0;
                                        } elseif ($gradPoint >= 75) {
                                            $gp = 3.75;
                                        } elseif ($gradPoint >= 70) {
                                            $gp = 3.5;
                                        } elseif ($gradPoint >= 65) {
                                            $gp = 3.25;
                                        } elseif ($gradPoint >= 60) {
                                            $gp = 3.0;
                                        } elseif ($gradPoint >= 55) {
                                            $gp = 2.75;
                                        } elseif ($gradPoint >= 50) {
                                            $gp = 2.5;
                                        } elseif ($gradPoint >= 45) {
                                            $gp = 2.25;
                                        } elseif ($gradPoint >= 40) {
                                            $gp = 2.0;
                                        } else {
                                            $gp = 0.0;
                                        }

                                        $gpsum = $gp * $item->credit;
                                        $totalGpSum += $gpsum;
                                        $totalCreditSum += $item->credit;
                                    } else {
                                        $marks = 0;
                                    }
                                @endphp
                                {{-- @dd($studen); --}}
                                <tr style="height:17.15pt; -aw-height-rule:exactly">
                                    <td
                                        style="width:10%; padding:4px; border-top:0.75pt solid #08080c; border-right:0.75pt solid #08080c; border-bottom:0.75pt solid #08080c; vertical-align:top; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                                        <p
                                            style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:9.5pt">{{ $item ? $item->course_code : '' }}</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:70%; border:0.75pt solid #08080c; padding-right:2.28pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p style="margin-top:0.95pt; margin-bottom:0pt; line-height:12.55pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10.5pt">{{ $item ? $item->course_name : '' }}</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:10%; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10.5pt">{{ $item ? $item->credit : '' }}</span>
                                        </p>
                                    </td>

                                    <td
                                        style="width:10%; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10.5pt">{{ isset($marks) ? $marks : 'N/A' }}</span>
                                        </p>
                                    </td>
                                    <td
                                        style="width:10%; border:0.75pt solid #08080c; padding-right:7.22pt; padding:4px; vertical-align:top; -aw-border:0.5pt single">
                                        <p
                                            style="margin-top:0.95pt; margin-bottom:0pt; text-align:center; line-height:12.55pt">
                                            <span
                                                style="font-family:'Century Gothic'; font-size:10.5pt">{{ isset($grade) ? $grade : 'N/A' }}</span>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            @php
                                if ($hasFail) {
                                    $gpa = 0;
                                } else {
                                    if ($totalGpSum == 0) {
                                        // You can handle this case if needed
                                    } else {
                                        $gpa = $totalGpSum / $totalCreditSum;
                                    }
                                }
                            @endphp
                            <tr>
                                <td colspan="4" class="text-center" style="">
                                    @if ($totalGpSum == 0)
                                        {{-- Handle the case where GPA is 0 --}}
                                    @else
                                        <strong>GPA: {{ number_format($gpa, 2) }}</strong>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        </p>

                    </div>

                    {{-- top table --}}

                    <p style="margin-top:11.85pt; margin-bottom:0pt; text-align:justify; font-size:1pt">
                        <span style="font-family:Arial; -aw-import:spaces">&#xa0;</span>
                    </p>
                    {{-- down table --}}

                    <div class="row">
                        <div class="col-md-6">

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        <script>
            document.getElementById('download').addEventListener('click', function() {
                // Options for PDF generation
                var options = {
                    margin: 5,
                    filename: 'result_sheet.pdf',
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
                var element = document.querySelector('.containers');

                // Generate PDF
                html2pdf(element, options);
            });
        </script>
</body>

</html>
