@extends('layouts.drexamapp')
<style>
    /* *, *:after, *:before {box-sizing: border-box;}
body {
 font-family: "Open Sans",sans-serif;
  color: inherit;
  padding: 10vh 0 0 0;
}

.container {
  width: 1000px;
  margin: 0 auto;
  background: rgba(0,0,0,.25);
  padding: 2em;
}

.row {
 width: 100%;
 text-align: center;
}
.column {
 width: 49.5%;
 display: inline-block;
}
.column a {
 width: 25%;
 display: inline-block;
 text-align: center;
 padding: 20px 0;
 background: yellow;
 margin: 7px 0;
 cursor: crosshair;}
.column a p {
 display: block;
 text-align: center;
 transition: ease .35s;
 opacity: 1;;
}
.column a:hover p {
 opacity: 0;
}
.column a span {
 dispay: block;
 text-align: center;
 transition: ease .35s;
 opacity: 0;
}
.column a:hover span {
 opacity: 1;
} */
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
        padding: 5px;
    }
</style>
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="download">Download PDF</a>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel" id="drseaplan" style="width:100%;">

                    <div class="x_title">
                        @php

                            $Collegelogo = DB::table('basics')->first();

                        @endphp
                        <p style="padding-left:120px; padding-top:70px "><img
                                src="{{ asset('public/basic/' . $Collegelogo->logo) }} " alt="" width="120"
                                height="100">
                        </p>
                        <div class="centerdesign" style="margin-top: -150px;">
                            <h3>Government Saadat College <br> Karatia, Tangail</h3>
                            <h5>{{ $examname ? $examname->title : '' }}</h5>
                            <h4><strong>At a Glance Seat Plan</strong></h4>
                            <h5> Date:{{ $exam_date ? $exam_date->date : '' }}</h5>
                        </div>

                    </div>
                    <div class="x_content">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="card-box table-responsive">
                                    <table class="tabledesign" style=" width:100%; justify-content:center">
                                        <th>
                                            <tr>
                                                <td>Building</td>
                                                <td>Room</td>
                                                <td>College Name</td>
                                                <td>Subject Name</td>
                                                <td>Roll Range</td>
                                                <td>Total</td>
                                            </tr>
                                        </th>
                                        <tbody>
                                            @php
                                                $prevBuildingName = null;
                                            @endphp

                                            @foreach ($seat_plan_info as $index => $seat_plan_info)
                                                @php
                                                    $room_info = DB::table('room_no')
                                                        ->where('id', $seat_plan_info->room_num)
                                                        ->first();
                                                    $bulding_info = DB::table('bulding_names')
                                                        ->where('id', $room_info->building_id)
                                                        ->first();
                                                @endphp
                                                @if ($prevBuildingName !== $bulding_info->building_name)
                                                    <tr>
                                                        <td>{{ $bulding_info->building_name }}</td>
                                                        <td>{{ $room_info->title }}</td>
                                                        <td>{{ $seat_plan_info->collegee_name }}</td>
                                                        <td>{{ $seat_plan_info->subject_name }}</td>
                                                        <td>{{ $seat_plan_info->starting_roll }}-{{ $seat_plan_info->rending_rolloll }}
                                                        </td>
                                                        <td>{{ $seat_plan_info->rending_rolloll - $seat_plan_info->starting_roll + 1 }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $room_info->title }}</td>
                                                        <td>{{ $seat_plan_info->collegee_name }}</td>
                                                        <td>{{ $seat_plan_info->subject_name }}</td>
                                                        <td>{{ $seat_plan_info->starting_roll }}-{{ $seat_plan_info->rending_rolloll }}
                                                        </td>
                                                        <td>{{ $seat_plan_info->rending_rolloll - $seat_plan_info->starting_roll + 1 }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                @php
                                                    $prevBuildingName = $bulding_info->building_name;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        window.onload = function() {
                            document.getElementById("download")
                                .addEventListener("click", () => {
                                    const drseaplan = this.document.getElementById("drseaplan");
                                    var opt = {
                                        margin: 0.5,
                                        filename: 'GlanceSeatfile.pdf',
                                        image: {
                                            type: 'jpeg',
                                            quality: 0.98
                                        },
                                        html2canvas: {
                                            scale: 1
                                        },
                                        jsPDF: {
                                            unit: 'in',
                                            format: 'letter',
                                            orientation: 'landscape'
                                        }
                                    };
                                    html2pdf().from(drseaplan).set(opt).save();
                                })
                        }
                    </script>
                @endsection
