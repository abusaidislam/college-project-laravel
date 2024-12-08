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

    <div class="containers p-4" style="margin-top: -60px">
        <div class="">
            <div class="mt-5" style="    background: #b5a3a312; padding: 10px; border: 12px red;">
                {{-- <div class="mt-4"> --}}
                <div class="row mt-5">

                    <div class="col-md-12" style="margin-left: 20px">


                    </div>

                </div>

                <div class="row mt-1 ">

                    <div class="col-md-2 text-center" style="margin-top: -10px">
                        <span>
                            <img src="{{ asset('public\upload\imagelogo1.png') }}" width="150" height="120"
                                alt="" />
                        </span>

                    </div>
                    <div class="col-md-9 text-center" style="margin-top: -30px">

                        <h3>
                            Government Saadat College
                        </h3>
                        <h4>
                            Karatia, Tangail-1903
                        </h4>

                        <p class="mb-0">
                            <span style="font-family:Arial; font-size:15pt">Honours Examination
                                {{ $examyear->years ?? '' }}</span>
                        </p>

                        <p>
                            <span style="font-family:Arial; font-size:15.5pt"><strong><u>Consolidated
                                        Result</u></strong>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row" style="font-size: 13px;">
                    <div class="col-md-12">
                        <table class="table table-bordered">

                            <tbody>
                                <tr class="">
                                    <td width=30%><strong> Name of Student</strong></td>
                                    <td>{{ $studentInfos->name ?? '' }}</td>

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
                                    <td>{{ $studentInfos->session ?? '' }}</td>

                                </tr>

                                <tr>
                                    <td>Subject</td>
                                    <td>{{ $studentInfos->department ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>Credit(Compeleted/Total)</td>
                                    @php
                                        $sumCredit = 0;
                                        foreach ($TotalCredit as $item) {
                                            $sumCredit += $item->credit;
                                        }
                                    @endphp
                                    <td>{{ $sumCredit }}/{{ $sumCredit }}</td>
                                </tr>

                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                    $sume = 0;
                                @endphp

                                @foreach ($CourseInfo1stYear as $item)
                                    @php
                                        // $studen = DB::table('student_results')
                                        //     ->where('student_id', $item->stu_id)
                                        //     ->where('subject', $item->id)
                                        //     ->first();
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            // ->where('class_id', $item->studentclass)
                                            // ->where('class_id', $item->register_roll)
                                            ->where('subject', $item->course_id)
                                            ->first();
                                        $marks = $studen->marks;
                                        $gradPoint = $studen->marks;

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
                                            $hasFail = true;
                                        }

                                        $gpsum = $gp * $item->credit;
                                        $totalGpSum += $gpsum;
                                        $totalCreditSum += $item->credit;

                                    @endphp
                                @endforeach
                                @php
                                    $firstYearSum = $totalGpSum;
                                    $firstYearCredit = $totalCreditSum;
                                    $firstYearGpa = $hasFail;
                                @endphp
                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                @endphp

                                @foreach ($CourseInfo2ndYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
                                        // $studen = DB::table('student_results')
                                        //     ->where('student_id', $item->stu_id)
                                        //     ->where('subject', $item->id)
                                        //     ->first();
                                        $marks = $studen->marks;
                                        $gradPoint = $studen->marks;
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
                                            $hasFail = true;
                                        }

                                        $gpsum = $gp * $item->credit;
                                        $totalGpSum += $gpsum;
                                        $totalCreditSum += $item->credit;
                                    @endphp
                                @endforeach
                                @php
                                    $secondYearSum = $totalGpSum;
                                    $secondYearCredit = $totalCreditSum;
                                    $secondYearGpa = $hasFail;
                                @endphp
                                @foreach ($CourseInfo3rdYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
                                        // $studen = DB::table('student_results')
                                        //     ->where('student_id', $item->stu_id)
                                        //     ->where('subject', $item->id)
                                        //     ->first();
                                        $marks = $studen->marks;
                                        $gradPoint = $studen->marks;
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
                                            $hasFail = true;
                                        }

                                        $gpsum = $gp * $item->credit;
                                        $totalGpSum += $gpsum;
                                        $totalCreditSum += $item->credit;
                                    @endphp
                                @endforeach
                                @php
                                    $thirdYearSum = $totalGpSum;
                                    $thirdYearCredit = $totalCreditSum;
                                    $thirdYearGpa = $hasFail;
                                @endphp
                                @foreach ($CourseInfo4thYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
                                        // $studen = DB::table('student_results')
                                        //     ->where('student_id', $item->stu_id)
                                        //     ->where('subject', $item->id)
                                        //     ->first();
                                        $marks = $studen->marks;
                                        $gradPoint = $studen->marks;
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
                                            $hasFail = true;
                                        }

                                        $gpsum = $gp * $item->credit;
                                        $totalGpSum += $gpsum;
                                        $totalCreditSum += $item->credit;
                                    @endphp
                                @endforeach
                                @php
                                    $fourthYearSum = $totalGpSum;
                                    $fourthYearCredit = $totalCreditSum;
                                    $fourthYearGpa = $hasFail;
                                @endphp

                                @php
                                    $totalCredit = $firstYearCredit + $secondYearCredit + $thirdYearCredit + $fourthYearCredit;
                                    $totalGpa = number_format($firstYearSum + $secondYearSum + $thirdYearSum + $fourthYearSum, 2);
                                    $Totalcgpa = $totalGpa / $totalCredit;
                                @endphp
                                <tr>
                                    <td><strong>Result</strong></td>
                                    @if ($firstYearGpa || $secondYearGpa || $thirdYearGpa || $fourthYearGpa)
                                        <td><strong>CGPA: Failed</strong></td>
                                    @else
                                        <td><strong>CGPA: {{ number_format($Totalcgpa, 2) }}</strong></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h3 style="margin-top:0.05pt; margin-bottom:0pt; text-align:center; padding:5px; line-height:12.3pt">
                    <span style="font-family:Arial; font-size:15pt">Course Wise Grade </span>
                </h3>
                <div class="row" style="font-size: 13px;">
                    <div class="col-md-3" style="margin-right: -22px; margin-left:20px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">First Year</th>
                                </tr>
                                <tr>
                                    <th width=90%>Course Code(credit)</th>
                                    <th width=10%>LG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                    $sume = 0;
                                @endphp

                                @foreach ($CourseInfo1stYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            // ->where('class_id', $item->studentclass)
                                            // ->where('class_id', $item->register_roll)
                                            ->where('subject', $item->course_id)
                                            ->first();
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

                                    @endphp

                                    <tr class="">
                                        <td class="text-center">{{ $item->course_code }}({{ $item->credit }})</td>
                                        <td class="text-center">{{ $grade }}</td>

                                    </tr>
                                @endforeach
                                @php
                                    if ($hasFail) {
                                        $gpa = 0;
                                    } else {
                                        $gpa = $totalGpSum / $totalCreditSum;
                                    }
                                @endphp
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <strong>GPA: {{ number_format($gpa, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3" style="margin-right: -22px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Second Year</th>
                                </tr>
                                <tr>
                                    <th width=90%>Course Code(credit)</th>
                                    <th width=10%>LG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                @endphp

                                @foreach ($CourseInfo2ndYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
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
                                    @endphp
                                    <tr class="">
                                        <td class="text-center">{{ $item->course_code }}({{ $item->credit }})</td>
                                        <td class="text-center">{{ $grade }}</td>

                                    </tr>
                                @endforeach
                                @php
                                    if ($hasFail) {
                                        $gpa = 0;
                                    } else {
                                        $gpa = $totalGpSum / $totalCreditSum;
                                    }
                                @endphp
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <strong>GPA:{{ number_format($gpa, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3" style="margin-right: -22px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Third Year</th>
                                </tr>
                                <tr>
                                    <th width=90%>Course Code(credit)</th>
                                    <th width=10%>LG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                @endphp

                                @foreach ($CourseInfo3rdYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
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
                                    @endphp
                                    <tr class="">
                                        <td class="text-center">{{ $item->course_code }}({{ $item->credit }})</td>
                                        <td class="text-center">{{ $grade }}</td>

                                    </tr>
                                @endforeach

                                @php
                                    if ($hasFail) {
                                        $gpa = 0;
                                    } else {
                                        $gpa = $totalGpSum / $totalCreditSum;
                                    }
                                @endphp
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <strong>GPA:{{ number_format($gpa, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3" style="margin-right: -22px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Fourth Year</th>
                                </tr>
                                <tr>
                                    <th width=90%>Course Code(credit)</th>
                                    <th width=10%>LG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalGpSum = 0;
                                    $totalCreditSum = 0;
                                    $hasFail = false;
                                @endphp

                                @foreach ($CourseInfo4thYear as $item)
                                    @php
                                        $studen = DB::table('student_results')
                                            ->where('student_id', $item->id)
                                            ->where('class_id', $item->class_id)
                                            ->where('subject', $item->course_id)
                                            ->first();
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
                                    @endphp
                                    <tr class="">
                                        <td class="text-center">{{ $item->course_code }}({{ $item->credit }})</td>
                                        <td class="text-center">{{ $grade }}</td>

                                    </tr>
                                @endforeach
                                @php
                                    if ($hasFail) {
                                        $gpa = 0;
                                    } else {
                                        $gpa = $totalGpSum / $totalCreditSum;
                                    }
                                @endphp
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <strong>GPA:{{ number_format($gpa, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- top table --}}
                <div class="row">

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
                                style="margin-top:10.65pt; margin-left:100.6pt; margin-bottom:0pt; text-align:justify; line-height:9.65pt">
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
