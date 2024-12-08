@php
    $userType = DB::table('users')
        ->where('id', $authID)
        ->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Room No Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Room No Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <span class="input-group-btn">
                                <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                            </span>
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
                                                <th>SL No.</th>
                                                <th>Building<br>Name</th>
                                                <th>Room<br>No</th>
                                                <th>Number <br> Of Bench</th>
                                                <th>Student<br>Par Bench</th>
                                                <th>Par Column<br>Total Bench</th>
                                                <th>Total<br>Column</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $ndata->building_name }}</td>
                                                    <td>{{ $ndata->title }}</td>
                                                    <td>{{ $ndata->number_bench }}</td>
                                                    <td>{{ $ndata->student_per_bench }}</td>
                                                    <td>{{ $ndata->total_bench_per_col }}</td>
                                                    <td>{{ $ndata->total_row }}</td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                        <a href="{{ url('show_exam_seatplan', $ndata->id) }}"> <button
                                                                type="button" id="showSeatPlan"
                                                                data-id="{{ $ndata->id }}"
                                                                class="btn btn-sm btn-primary">Show Seat Plan</button></a>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

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
                                        action="{{ route('exam-room_no.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="building_name" class="col-sm-12 control-label">Building Name
                                                :</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="building_id" name="building_id">
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($data_info as $building)
                                                        <option value="{{ $building->id }}">{{ $building->building_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Room No </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Room No" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="number_bench" class="col-sm-12 control-label">Number Of
                                                Bench</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="number_bench"
                                                    name="number_bench" placeholder="Number Of Bench" value=""
                                                    maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type" class="col-sm-12 control-label">Student Per Bench</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="type" name="type"
                                                    placeholder="Student Per Bench" value="" maxlength="50"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_bench_per_col" class="col-sm-12 control-label">Per Column
                                                Total Bench</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="total_bench_per_col"
                                                    name="total_bench_per_col" placeholder="Per Column Total Bench"
                                                    value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_row" class="col-sm-12 control-label">Total Row </label>
                                            <div class="col-sm-12">
                                                <input type="number" readonly class="form-control" id="total_row"
                                                    name="total_row" placeholder="Total Row" value=""
                                                    maxlength="50" required="">
                                            </div>
                                            <span id="msg"></span>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger " id="close"
                                                data-bs-dismiss="modal" aria-label="Close">Close</button>

                                        </div>
                                    </form>
                                </div>
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


        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('exam-room_no.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.title);
                $('#number_bench').val(data.number_bench);
                $('#total_bench_per_col').val(data.total_bench_per_col);
                $('#total_row').val(data.total_row);
                $('#type').val(data.type);
                $('#building_id').val(data.building_id);

            });
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
                        url: 'exam-room_no/' + id,
                        success: function(data) {
                            window.location = 'exam-room_no';
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
    </script>
    <script>
        $('#total_bench_per_col').on('keyup', function(e) {
            let totolrow = parseFloat($(this).val());
            let number_bench = parseFloat($('#number_bench').val());
            let divi = (number_bench / totolrow);
            if (typeof divi === 'number') {
                if (divi % 1 === 0) {
                    $('#msg').text('');
                } else {
                    $('#msg').text(
                        'ভগ্নাংশ সংখ্যার সিট প্ল্যান গ্রহণযোগ্য নয়। দয়া করে পূর্ণসংখ্যার সিট প্ল্যান প্রদান করুন।'
                    ).css('color', 'red');
                    ($('#total_bench_per_col').val(''));
                }
            }

            $("#total_row").val(divi);
        });
    </script>
@endsection
