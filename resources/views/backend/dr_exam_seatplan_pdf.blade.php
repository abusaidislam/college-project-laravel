<!DOCTYPE html>
<html>

<head>
    <!-- Include any necessary CSS or JS libraries -->
    {{-- <link rel="stylesheet" href="path/to/bootstrap.css"> --}}
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->

</head>

<body>
    <style>
        .centerdesign {
            text-align: center;
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

    <div class="centerdesign">
        <h3>Government Saadat College</h3>
        <h3>Karatia, Tangail</h3>
        <h5>Honours First Year Examination-2021</h5>
        <h4><strong>Seat Plan</strong></h4>
        <p>Date: {{ $seat_info->created_at }}</p>
        <h4>Room: {{ $room_num->title }}</h4>
    </div>

    <div class="d-flex justify-content-end">
        <a href="#"><button id="btn-hide" class="btn bg-success">Print</button></a>
    </div>

    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
    </ul>

    <div class="clearfix"></div>

    <div class="x_content">
        <div class="row">
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

    <div></div>

    <script type="text/javascript">
        // Your JavaScript code goes here
        $('#btn-hide').on('click', function() {
            var elementsToHide = $('#btn-hide, .hide_footer, .top_nav, .panel_toolbox');
            elementsToHide.hide();
            window.print();
            elementsToHide.show();
        });
    </script>
</body>

</html>
