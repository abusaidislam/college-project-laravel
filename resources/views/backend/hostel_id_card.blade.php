@extends('layouts.hosapp')
@section('title', 'Hostel Id Card Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Hostel Id Card</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary " href="javascript:void(0)" id="exprotModel">Export ID Card
                                    </a>
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
                                                <th>Photo</th>
                                                <th>Department</th>
                                                <th>Name</th>
                                                <th>Session</th>
                                                <th>Class</th>
                                                <th>Roll</th>
                                                <th>Registration</th>
                                                <th>Card No</th>
                                                <th>Mobile No</th>
                                                <th>Blood Group</th>
                                                <th>Building Name</th>
                                                <th>Floor Name</th>
                                                <th>Room Number</th>
                                                <th>Seat Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $info = DB::table('hostel_seat_allotments')
                                                        ->where('id', $ndata->s_name)
                                                        ->first();

                                                @endphp
                                                <tr>
                                                    <td><img src="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                            alt="" width="80" height="80"></td>
                                                    <td>{{ $ndata->deprartment }}</td>
                                                    <td>{{ $info ? $info->student_name : '' }}</td>
                                                    <td>{{ $ndata->session }}</td>
                                                    <td>{{ $ndata->year }}</td>
                                                    <td>{{ $ndata->roll }}</td>
                                                    <td>{{ $ndata->registration }}</td>
                                                    <td>{{ $ndata->card_no }}</td>
                                                    <td>{{ $ndata->mobile_no }}</td>
                                                    <td>{{ $ndata->blood_group }}</td>
                                                    <td>{{ $ndata->bulding_name }}</td>
                                                    <td>{{ $ndata->floor_name }}</td>
                                                    <td>{{ $ndata->room_number }}</td>
                                                    <td>{{ $ndata->seat_number }}</td>
                                                    <td>
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </button>

                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                        <a href="{{ url('hostcarddetails', $ndata->id) }}"
                                                            class="btn btn-sm btn-info">
                                                            Hostel ID Card
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('hostelidcard.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                   <div class="row">
                                      <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="" class="col-sm-12 control-label">Student Name:</label>
                                                    <div class="col-sm-12">
                                                    <select class="form-control" id="s_name" name="s_name" required>
                                                        <option value="0" selected>--Select--</option>
                                                        @foreach ($hostelStudent as $item)
                                                            <option value="{{ $item->id }}">{{ $item->student_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="designation" class="col-sm-12 control-label">Deprartment</label>
                                                    <div class="col-sm-12">

                                                        <select class="form-control" id="deprartment" name="deprartment"required>
                                                            <option class="" value="" selected>--Select --</option>
                                                            @foreach ($department as $item)
                                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                            @endforeach
                                                            <option value="Department of General">{{ $genarelDepart->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">Session</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="session" name="session"
                                                            placeholder="Enter Session" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">Class Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="class_name"
                                                            name="class_name" placeholder="Class Name" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text" class="col-sm-12 control-label">Roll</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="roll" name="roll"
                                                            placeholder="Enter Roll" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">Registration</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="registration"
                                                            name="registration" placeholder="Enter To Registration"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile_no" class="col-sm-12 control-label">Mobile No.</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="mobile_no"
                                                            name="mobile_no" placeholder="Mobile No." value=""
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="blood_group" class="col-sm-12 control-label">Blood Group</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="blood_group"
                                                            name="blood_group" placeholder="Blood Group" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="bulding_name" class="col-sm-12 control-label">Bulding Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="bulding_name"
                                                            name="bulding_name" placeholder="Bulding Name" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="floor_name" class="col-sm-12 control-label">Floor Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="floor_name"
                                                            name="floor_name" placeholder="Floor Name" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="room_number" class="col-sm-12 control-label">Room Number</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="room_number"
                                                            name="room_number" placeholder="Room Number" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="seat_number" class="col-sm-12 control-label">Seat Number</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="seat_number"
                                                            name="seat_number" placeholder="Seat Number" required="">
                                                    </div>
                                                </div>
                                                @php
                                                    $latestCard = DB::table('hostel_id_cards')
                                                        ->select('hostel_id')
                                                        ->orderBy('hostel_id', 'desc')
                                                        ->first();

                                                    // Check if any record exists
                                                    $cardNumber = $latestCard ? $latestCard->hostel_id + 1 : 1;
                                                @endphp

                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">ID Card No</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="card_no" name="card_no"
                                                            value="{{ $cardNumber }}">
                                                    </div>
                                                </div>

                                                <img id="uploaded_image" src="" height="100px" width="100px">
                                                <div class="form-group">
                                                    <label for="photo" class="col-sm-12 control-label">Photo
                                                        (Dimensions:530x650, Max-Size:200kb)</label>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" id="photo" name="photo"
                                                            placeholder="Enter Photo" value="">
                                                        <span class="text-danger">
                                                            @error('photo')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
                                                aria-label="Close">
                                                close
                                            </button>
                                        </div>
                                    </form>
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
                                    <form method="POST" id="form" name="form"
                                        action="{{ url('hostel_card_export') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label for="createddate" class="col-sm-3 control-label">Select Date</label>
                                            <div class="form-group">

                                                <select class="form-control" id="createddate" name="createddate"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($hostelCardinfo as $item)
                                                        <option value="{{ $item->date }}">
                                                            {{ $item->date }}
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                            <button type="button" class="btn btn-primary" id="closepdfmodel"
                                                aria-label="Close"> close </button>
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
            $('#form').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#modelHeading').html("Create New");

            $('#saveBtn').html('Save');
            $('#id').val('');
            $('#uploaded_image').hide();

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
            $.get("{{ route('hostelidcard.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#s_name').val(data.s_name);
                $('#roll').val(data.roll);
                $('#deprartment').val(data.deprartment);
                $('#mobile_no').val(data.mobile_no);
                $('#blood_group').val(data.blood_group);
                $('#session').val(data.session);
                $('#registration').val(data.registration);
                $('#year').val(data.year);
                $('#card_no').val(data.card_no);
                $('#uploaded_image').show();
                $('#uploaded_image').attr('src', 'public/hostel_card/' + data.photo);

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
                        url: 'hostelidcard/' + id,
                        success: function(data) {
                            window.location = 'hostelidcard';
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
        $('#closemodal').click(function() {
            $('#form').trigger("reset");
            $('#ajaxModel').modal('hide');
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#s_name').on('change', function() {
                var id = $(this).val();
                console.log(id);
                if (id) {
                    $.ajax({
                        url: 'studentData/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(values) {
                            // console.log(values);
                            if (values.length > 0) {
                                var value = values[0];

                                $('#session').val(value.session);
                                $('#class_name').val(value.class_name);
                                $('#roll').val(value.roll);
                                $('#registration').val(value.registration);
                                $('#mobile_no').val(value.mobile_no);
                                $('#blood_group').val(value.blood_group);
                                $('#bulding_name').val(value.bulding_name);
                                $('#floor_name').val(value.floor_name);
                                $('#room_number').val(value.room_number);
                                $('#seat_number').val(value.seat_number);

                            } else {
                                console.log('No data found');
                            }
                        }

                    });
                }
            });

            // Initialize Select2 for the student_name dropdown
            $('#student_name').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
        $('#closepdfmodel').click(function() {
            $('#pdfModel').modal('hide');
        });
    </script>
@endsection
