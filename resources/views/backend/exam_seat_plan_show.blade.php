@extends('layouts.examapp')
<style>
    .centerdesign {
        text-align: center
    }

    .centerdesign h3 {
        color: black;
        text-shadow: 3px 8px 6px #b5a9a9c2;

    }


    .tabledesign {
        border: 1px solid black;

    }

    .tabledesign tr td {
        border: 1px solid black;
        text-align: center;
    }
</style>

@section('content')
    `
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 "> 
            <div class="x_panel">
                <div class="x_title">
                    <div class="centerdesign">
                        <h3>Government Saadat College</h3>
                        <h3>Karatia, Tangail</h3>
                        <h5>Honours First Year Examination-2021</h5>
                        <h4><strong>Seat Plan</strong></h4>
                        <p>Date:{{ $seat_info->created_at }}</p>
                        <h4>Room:{{ $room_num->title }}</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="#"><button id="btn-hide" class="btn bg-success">Print</button></a>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row ">
                        @foreach ($rows as $row)
                            @if ($room_details->student_per_bench >= 3)
                                <div class="col-md-4">
                                    <div class="">
                                        <table class="table tabledesign">
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
                                        <table class="table tabledesign">
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
            </div>
            <div></div>

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
            </script>

            <script type="text/javascript">
                $('#btn-hide').on('click', function() {
                    var elementsToHide = $('#btn-hide, .hide_footer, .top_nav, .panel_toolbox');
                    elementsToHide.hide();
                    window.print();
                    elementsToHide.show();
                });
            </script>
        @endsection
