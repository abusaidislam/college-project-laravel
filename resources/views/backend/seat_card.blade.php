@extends('layouts.examapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Seat Card Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">


                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>student_name</th>
                                                <th>exam_name</th>
                                                <th>roll</th>

                                                <th>course_name</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->id }}</td>


                                                    <td>{{ $ndata->student_name }} </td>
                                                    <td>{{ $ndata->exam_name }} </td>
                                                    <td>{{ $ndata->roll }}</td>
                                                    <?php $course_names = DB::table('course_names')
                                                        ->where('id', '=', $ndata->course_name)
                                                        ->get(); ?>
                                                    @foreach ($course_names as $ncourse_names)
                                                        <td>{!! $ncourse_names->name !!} </td>
                                                    @endforeach
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>

                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Delete</button>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" class="form-horizontal"
                                action="{{ route('seat_card.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Student Name: </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="student_name" name="student_name"
                                            placeholder="Student Name" value="" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>

                                    <select class="form-control" id="exam_name" name="exam_name">
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($examname as $nexamname)
                                            <option value="{{ $nexamname->title }}">{{ $nexamname->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="Roll" class="col-sm-12 control-label">Roll</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="roll" name="roll"
                                            placeholder="Roll" value="" required="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label><strong>Course Name:</strong></label>

                                    <select class="form-control" id="course_name" name="course_name">

                                        @foreach ($course_name as $ncourse_name)
                                            <option value="{{ $ncourse_name->id }}">{{ $ncourse_name->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class=" col-sm-offset-2 col-sm-10 my-2">

                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-primary" id="close"data-bs-dismiss="modal"
                                        aria-label="Close">
                                        close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="libBtnWrap">

            <button onclick="libPrint()">Print </button>
        </div>

        <?php 

$max_per_row = 3;
$item_count = 0;

echo "<table  id='libInp'align='center'  >";
echo "<tr>";
foreach($data as $ndata)
{
    if ($item_count == $max_per_row)
    {
        echo "</tr><tr>";
        $item_count = 0;
    }?>
        <td width="250" align="center" valign="middle" class="news2"
            style=" padding: 5px; color: black; padding-bottom: 10px; border: 1px dashed black;">
            <p> <b> {{ $ndata->exam_name }}</b> <br />
                Name:{{ $ndata->student_name }}</p>
            <span class="border border-dark p-2 font-weight-bold"
                style="border: 2px solid   black;   padding: 5px;">Roll:{{ $ndata->roll }}</span><br />
            <?php $course_names = DB::table('course_names')
                ->where('id', '=', $ndata->course_name)
                ->get(); ?>
            @foreach ($course_names as $ncourse_names)
                <p class="pt-2"> Course: {!! $ncourse_names->course_code !!} </p>
            @endforeach

        </td>

        <?php $item_count++;}
echo "</tr>";
echo "</table>";

?>




    </div>
    </div>
    </div>


    <p id="libOp"></p>

    </div>
    </div>







    <script>
        var libInpEl = document.getElementById("libInp");
        var libOutEl = document.getElementById("libOp");
        var libBtnWrapEl = document.getElementById("libBtnWrap");

        function libPrint() {

            printJS('libInp', 'html');
        }
    </script>


    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs4de6.kxcdn.com/print.min.css" />
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
            $('#form').trigger("reset");
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
            $.get("{{ route('seat_card.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#student_name').val(data.student_name);
                $('#exam_name').val(data.exam_name);
                $('#registration.').val(data.registration);
                $('#roll').val(data.roll);
                $('#course_name').val(data.course_name);

            })
        });

        /*------------------------------------------
        --------------------------------------------
        Delete ndataInfo Code
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#delete', function() {

            var id = $(this).data("id");
            if (confirm("Are You sure want to delete This!")) {
                $.ajax({
                    type: "DELETE",
                    url: 'seat_card/' + id,
                    success: function(data) {
                        window.location = 'seat_card'
                    }

                });
            }
            return false;



        });



        $('#close').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection
