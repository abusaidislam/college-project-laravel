@extends('layouts.examapp')
<style>
    .centerdesign {
        text-align: center
    }

    .centerdesign h3 {
        color: black;
        /* text-shadow: 3px 8px 6px #b5a9a9c2; */

    }

    .centerdesign p {
        margin-left: 231px;
        margin-top: -31px;
    }

    .tabledesign {}

    .tabledesign tr td {
        border: 1px solid black;
        text-align: center;
    }


    .multiselect {
        width: 200px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }

    #checkboxes2 {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes2 label {
        display: block;
    }

    #checkboxes2 label:hover {
        background-color: #c9cccf;
    }
</style>
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="{{ url('examroutine') }}" id="createNew"> Back
                        </a>
                    </span>
                </div>
                <div class=" title_left ml-5 d-flex justify-content-end">
                    <span class="input-group-btn" style="">
                        <a class="btn btn-success" href="javascript:void(0)" id="download"><i class="fa fa-download"
                                style="font-size:20px"> Download</i></a>
                    </span><br>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="centerdesign" style="color: black">
                            <h3>Government Saadat College</h3>
                            <h3>Karatia, Tangail</h3>
                            @php
                                $examName = DB::table('exam_names')
                                    ->where('id', $routine_time->exam_name)
                                    ->first();
                            @endphp
                            <h5>{{ $examName ? $examName->title : '' }}</h5>
                            <h4><strong>Routine</strong></h4><br>
                            <h6>Exam Start Time: Morning {{ $routine_time->time_1 }} To {{ $routine_time->time_2 }} And
                                Afternoon {{ $routine_time->time_3 }} To {{ $routine_time->time_4 }}</h6>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="card-box table-responsive">
                                    <table class="tabledesign" style=" width:100%; justify-content:center; color:black">
                                        <th>
                                            <tr>
                                                <td rowspan="2">Date</td>
                                                <td rowspan="2">Day</td>
                                                <td colspan="2">Course Code</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $routine_time->time_1 }}--{{ $routine_time->time_2 }}</td>
                                                <td>{{ $routine_time->time_3 }}--{{ $routine_time->time_4 }}</td>
                                            </tr>
                                        </th>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->date }}</td>
                                                    <td>{{ $ndata->day }}</td>
                                                    <td>{{ $ndata->first_sub }}</td>
                                                    <td>{{ $ndata->second_sub }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                filename: 'exam_routine.pdf',
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
                            var element = document.querySelector('.x_panel');

                            // Generate PDF
                            html2pdf(element, options);
                        });
                    </script>
                @endsection
