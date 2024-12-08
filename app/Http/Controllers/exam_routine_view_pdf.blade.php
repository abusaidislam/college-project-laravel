@extends('layouts.examapp')
<style>
    .centerdesign {
        text-align: center
    }

    .centerdesign h3 {
        color: black;
        text-shadow: 3px 8px 6px #b5a9a9c2;

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
        background-color: #1e90ff;
    }
</style>
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">

            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="centerdesign">
                            <h3>Government Saadat College</h3>
                            <h3>Karatia, Tangail</h3>
                            <h5>{{ $routine_time->exam_name }}</h5>
                            <h4><strong>Routine</strong></h4><br>
                            <h6>Exam Start Time: Morning {{ $routine_time->time_1 }} To {{ $routine_time->time_2 }} And
                                Morning {{ $routine_time->time_3 }} To {{ $routine_time->time_4 }}</h6>
                        </div>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="card-box table-responsive">
                                    <table class="tabledesign" style=" width:100%; justify-content:center">
                                        <th>
                                            <tr>
                                                <td rowspan="2">Date</td>
                                                <td rowspan="2">Day</td>
                                                <td colspan="2">Subject And Subject Code</td>
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
                                                    <td>{{ $ndata->subName }}</td>
                                                    <td>{{ $ndata->subName2 }}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
