@extends('layouts.examapp')
<style>

</style>

@section('content')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">

            <div id="libBtnWrap">
                <button onclick="libPrint()">Print </button>
            </div>
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <?php 
    
    $max_per_row = 3;
    $item_count = 0;
    
    echo "<table  id='libInp'align='center'  >";
    echo "<tr>";
    foreach($SeatCarddetails as $ndata)
    {
        if ($item_count == $max_per_row)
        {
            echo "</tr><tr>";
            $item_count = 0;
        }?>
            @php
                $department = DB::table('departments')
                    ->where('id', $ndata->depart_id)
                    ->first();
                $examName = DB::table('exam_names')
                    ->where('id', $ndata->exam_id)
                    ->first();
                $cantidatedName = DB::table('d_r_analyses')
                    ->where('exam_roll', $ndata->roll)
                    ->where('collegecode_name', $ndata->collegee_name)
                    ->where('subjectcode_name', $ndata->subject_name)
                    ->first();
                $sessions = [];

                switch ($ndata->class_id) {
                    case 1:
                        $sessions = DB::table('students')
                            ->select('name')
                            ->where('studentclass', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    case 2:
                        $sessions = DB::table('student_honours_secound_years')
                            ->select('student_name')
                            ->where('class_id', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    case 3:
                        $sessions = DB::table('student_honours_third_years')
                            ->select('student_name')
                            ->where('class_id', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    case 4:
                        $sessions = DB::table('student_honours_fourth_years')
                            ->select('student_name')
                            ->where('class_id', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    case 5:
                        $sessions = DB::table('student_preliminary_to_masters')
                            ->select('student_name')
                            ->where('studentclass', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    case 6:
                        $sessions = DB::table('student_masters_finals')
                            ->select('student_name')
                            ->where('studentclass', $ndata->class_id)
                            ->where('depart_id', $ndata->depart_id)
                            ->where('roll', $ndata->roll)
                            ->first();
                        break;
                    default:
                        break;
                }
            @endphp
            {{-- @dd($ndata); --}}
            <td width="250" align="center" valign="middle" class="news2"
                style=" padding: 5px; color: black; padding-bottom: 10px; border: 1px dashed black;">
                <p> <b> {{ $examName ? $examName->title : '' }}</b> <br />
                    Name:{{ $cantidatedName ? $cantidatedName->candidate_name : '' }}</p>
                <span class="border border-dark p-2 font-weight-bold"
                    style="border: 2px solid   black;   padding: 5px;">Roll:{{ $ndata->roll }}</span><br />

                <p class="pt-2"> Department: {{ $department ? $department->name : 'Department of Degree' }}</p>
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
                    console.log(seaplan);
                    console.log(window);
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
