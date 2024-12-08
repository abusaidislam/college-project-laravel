@extends('layouts.drexamapp')
@section('title', 'DR Exam Glance Seat Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>DR Exam Glance Seat Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="exprotModel"> View DR Exam Glance Seat </a>
                                </span>
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
                                                <td>Building</td>
                                                <td>Room</td>
                                                <td>College Name</td>
                                                <td>Subject Name</td>
                                                <td>Roll Range</td>
                                                <td>Total</td>
                                            </tr>
                                        </thead>
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
                                                        <td>{{ $loop->iteration }}</td>
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
                </div>
            </div>

            <div class="modal fade" id="pdfModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form" name="form" action="{{ url('dr_glance_exam_list') }}"
                                enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name Of Exam :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control exam_id" id="exam_name" name="exam_name" required>
                                        <option class="" value="0" selected>--Select --</option>
                                        @foreach ($examname as $nexamname)
                                            <option value="{{ $nexamname->id }}">{{ $nexamname->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                </div>

                                <div class="form-group">
                                    <label for="exam_date" class="col-sm-12 control-label">Exam Date :</label>
                                    <div class="col-sm-12">
                                    <select class="form-control exam_date" id="exam_date" name="exam_date" required>
                                        <option class="" value="0" selected>--Select --</option>

                                    </select>

                                </div>
                                </div>
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                                    <button type="button" class="btn btn-danger" id="closepdfmodel" aria-label="Close">
                                        close </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        $('#form').trigger("reset");
        $('#saveBtn').html('Save');
        $('#id').val('');
    });
    $('#exprotModel').click(function() {
        $('#pdfModel').modal('show');
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
        $.get("{{ route('examdutyroaster.index') }}" + '/' + id + '/edit', function(data) {
            $('#modelHeading').html("Edit");
            $('#saveBtn').html('Update');
            $('#ajaxModel').modal('show');
            $('#id').val(data.id);
            $('#exam_name').val(data.exam_name);
            $('#name').val(data.name);
            $('#designation.').val(data.designation);
            $('#department').val(data.department);
            $('#email').val(data.email);
            $('#duty_date').val(data.duty_date);
            $('#duty_time').val(data.duty_time);

        })
    });

    /*------------------------------------------
    --------------------------------------------
    Delete ndataInfo Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'examdutyroaster/' + id,
                        success: function(data) {
                            window.location = 'examdutyroaster';
                            const Toast = Swal.mixin(toastConfiguration);
                            Toast.fire({
                                icon: "success",
                                title: "Deleted Successfully!!!"
                            });
                        }
                    });
                }
            });
            return false;
        });

    $('#close').click(function() {
        $('#ajaxModel').modal('hide');
    });
    $('#closepdfmodel').click(function() {
        $('#pdfModel').modal('hide');
    });
</script>
<script>
    $(document).ready(function() {
        $('#exam_name').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: 'dr_examName_Info/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#exam_date').empty();
                        $('#exam_date').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            $('#exam_date').append('<option value="' + value.id +
                                '">' + value.date + '</option>');
                        });
                        $('#exam_date').trigger('change');
                    }

                });
            }

        });

    });
</script>
@endsection
