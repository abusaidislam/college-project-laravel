@extends('layouts.examapp')
<style>
    .centerdesign {
        font-size: 14px;
        text-align: center;
        padding: 0px;
    }

    .centerdesign h3 {
        color: black;
        /* text-shadow: 3px 8px 6px #b5a9a9c2; */

    }

    .tabledesign {
        border: 1px solid black;
    }

    .tabledesign tr td {
        border: 1px solid black;
        text-align: center;
        font-size: 13px;
    }

    .seatdata {
        color: black;
        font-size: 13px;
        padding: 0px;
        width: 100% !important;
    }
</style>

@section('content')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="download">Download PDF</a>
                    </span>

                </div>
            </div>
            <div class="x_panel" id="seaplan">
                <div class="x_title">
                    <div class="centerdesign">
                        <h3>Government Saadat College <br>Karatia, Tangail</h3>
                        <h4><strong>Seat Plan</strong></h4>
                        <h5>{{ $exam_info ? $exam_info->title : '' }}</h5>
                        <h4>Room: {{ $room_num->title }} Date: {{ $exam_date ? $exam_date->date : '' }} </h4>
                    </div>
                </div>
                <div class="x_content ">
                    <div class="row seatdata">
                        @foreach ($rows as $row)
                            {{-- @dd($rows); --}}
                            @if ($room_details->student_per_bench >= 3)
                                <div class="col-md-4">
                                    <div class="">
                                        <table class="table tabledesign" style="max-width: 300px; overflow: auto;">
                                            <tbody>
                                                @foreach ($row as $bench)
                                                    <tr>
                                                        @if ($room_details->student_per_bench == 1)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                        @elseif ($room_details->student_per_bench == 2)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                            <td class="arts">{{ $bench['arts'] ?? '' }}</td>
                                                        @elseif ($room_details->student_per_bench == 3)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                            <td class="arts">{{ $bench['arts'] ?? '' }}</td>
                                                            <td class="commerce">{{ $bench['commerce'] ?? '' }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @elseif ($room_details->student_per_bench < 3)
                                <div class="col-md-1" style="margin:auto">
                                    <div class="">
                                        <table class="table tabledesign" style="max-width: 300px; overflow: auto;">
                                            <tbody>
                                                @foreach ($row as $bench)
                                                    <tr>
                                                        @if ($room_details->student_per_bench == 1)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                        @elseif ($room_details->student_per_bench == 2)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                            <td class="arts">{{ $bench['arts'] ?? '' }}</td>
                                                        @elseif ($room_details->student_per_bench == 3)
                                                            <td class="science">{{ $bench['science'] ?? '' }}</td>
                                                            <td class="arts">{{ $bench['arts'] ?? '' }}</td>
                                                            <td class="commerce">{{ $bench['commerce'] ?? '' }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


                <div class="row" width="100%">
                    @foreach ($College_Seatdetails as $item)
                        @php
                            $SeatInfo = DB::table('seat_plans')
                                ->where('depart_id', $item->depart_id)
                                ->where('exam_id', $item->exam_id)
                                ->where('exam_routin_id', $item->exam_routin_id)
                                ->first();
                            $depart = DB::table('departments')
                                ->where('id', $item->depart_id)
                                ->first();
                            $rollinfo = DB::table('seat_plans')
                                ->select('roll')
                                ->where('depart_id', $item->depart_id)
                                ->where('exam_id', $item->exam_id)
                                ->where('exam_routin_id', $item->exam_routin_id)
                                ->count();
                        @endphp

                        <h6 style="margin-left: 50px; color:rgb(205, 0, 174);">Total = {{ $rollinfo ? $rollinfo : '' }},
                            Roll Range:
                            ({{ $SeatInfo ? $SeatInfo->starting_roll : '' }}--{{ $SeatInfo ? $SeatInfo->rending_rolloll : '' }})
                            ,
                            Department Name: {{ $depart ? $depart->name : '' }}


                        </h6>
                    @endforeach
                </div>
            </div>
            <div>
            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                });

                $('#createNew').click(function() {
                    $('#ajaxModel').modal('show');
                    $('#modelHeading').html("Create New");
                    $('#dform').trigger("reset");
                    $('#saveBtn').html('Save');
                    $('#id').val('');


                });


                /*------------------------------------------
                --------------------------------------------
                Click to Edit Button
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '#edit', function() {
                    var id = $(this).data('id');

                    $.get("{{ route('examcommittee.index') }}" + '/' + id + '/edit', function(data) {
                        $('#ajaxModel').modal('show');
                        $('#modelHeading').html("Edit");
                        $('#saveBtn').html('Update');
                        $('#id').val(data.id);
                        $('#room_num').val(data.room_num);
                        $('#roll').val(data.roll);
                        $('#total_row').val(data.total_row);
                        $('#perBench').val(data.perBench);
                        $('#starting_roll').val(data.starting_roll);
                        $('#ending_roll').val(data.ending_roll);
                        $('#year').val(data.year);

                    });
                });





                /*------------------------------------------
                           --------------------------------------------
                           Delete ndataInfo Code
                           --------------------------------------------
                           --------------------------------------------*/
                $('body').on('click', '#delete', function() {

                    var id = $(this).data("id");
                    confirm("Are You sure want to delete !");

                    $.ajax({
                        type: "DELETE",
                        url: 'examcommittee/' + id,
                        success: function(data) {
                            window.location = 'examcommittee'
                        }

                    });
                });

                $('#closemodal').click(function() {
                    $('#ajaxModel').modal('hide');
                });
                // $('#btn-hide').on('click', function() {
                //     // Elements to hide when printing
                //     var elementsToHide = $('#btn-hide, .hide_footer, .top_nav, .panel_toolbox');

                //     // Hide the specified elements
                //     elementsToHide.hide();

                //     // Trigger the browser's print functionality
                //     window.print();

                //     // Show the hidden elements after printing
                //     elementsToHide.show();
                // });
            </script>
            <script>
                window.onload = function() {
                    document.getElementById("download")
                        .addEventListener("click", () => {
                            const seaplan = this.document.getElementById("seaplan");

                            var opt = {
                                margin: 0.5,
                                filename: 'SeatPlanfile.pdf',
                                image: {
                                    type: 'jpeg',
                                    quality: 0.98
                                },
                                html2canvas: {
                                    scale: 2
                                },
                                jsPDF: {
                                    unit: 'in',
                                    format: 'letter',
                                    orientation: 'landscape'
                                }
                            };
                            html2pdf().from(seaplan).set(opt).save();
                        })
                }
            </script>
        @endsection
