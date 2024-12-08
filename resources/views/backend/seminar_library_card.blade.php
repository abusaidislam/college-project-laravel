@extends('layouts.department')
@section('title', 'Seminar Id Card Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Seminar Id Card</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                     <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                 </span>
                              </li>
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-primary" href="javascript:void(0)" id="exprotModel">Export ID Card
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
                                                <th>Deprartment</th>
                                                <th>Name</th>
                                                <th>Class Name</th>
                                                <th>Roll</th>
                                                <th>registration</th>
                                                <th>card_no</th>
                                                <th>Mobile No.</th>
                                                <th>session</th>
                                                <th>Blood Group</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                @php
                                                    $depart = DB::table('departments')
                                                        ->where('id', $ndata->department_id)
                                                        ->first();

                                                    $class = DB::table('studen_classes')
                                                        ->where('id', $ndata->class)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td><img src="{{ asset('public/library_card/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $depart ? $depart->name : '' }} </td>
                                                    <td>{{ $ndata->student_name }}</td>
                                                    <td>{{ $class ? $class->name : '' }}</td>
                                                    <td>{{ $ndata->roll }} </td>
                                                    <td>{{ $ndata->registration }} </td>
                                                    <td>{{ $ndata->card_no }} </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->session }} </td>
                                                    <td>{{ $ndata->blood_group }} </td>
                                                    <td>{{ $ndata->date }} </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary"><a class="text-white" href="{{ url('seminar_carddetails', $ndata->id) }}">ID Card</a></button>
                                                      
                                                        <button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>
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
                                        action="{{ route('seminar-id-card.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Department Name :</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="department_id" name="department_id"required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($department as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Class Name :</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="class" name="class" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($className as $item)
                                                        <option class="" value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Session :</label>
                                                <div class="col-sm-12">
                                                <select class="form-control" id="session" name="session" required>
                                                    <option class="" value="0" selected>--Select --</option>

                                                </select>
                                                <input type="text" class="form-control" id="studentSession"
                                                    name="studentSession">
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Student Name :</label>
                                                <div class="col-sm-12">
                                                <select id="student_name" name="student_name" class="js-select2"
                                                    style="width: 100%;">
                                                    <option value="">--Select--</option>

                                                </select>
                                                <input type="text" class="form-control" id="studentName"
                                                    name="studentName">
                                                <input type="hidden" class="form-control" id="stu_name" name="stu_name">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-12 control-label">Roll :</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="roll" name="roll"
                                                        placeholder="Student Roll " required>
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
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                              

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
                                                            name="blood_group" placeholder="Blood Group" value=""
                                                            required="">
                                                    </div>
                                                </div>

                                                @php
                                                    $latestCard = DB::table('seminar_library_cards')
                                                        ->select('card_no')
                                                        ->orderBy('card_no', 'desc')
                                                        ->first();

                                                    // Check if any record exists
                                                    $cardNumber = $latestCard ? $latestCard->card_no + 1 : 1;
                                                @endphp

                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">ID Card No</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="card_no" name="card_no"
                                                            value="{{ $cardNumber }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_dis" class="col-sm-12 control-label">Date</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="date" name="date"
                                                            placeholder="Enter Date" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label for="photo" class="col-sm-12 control-label">Photo
                                                        (Dimensions:530x650, Max-Size:200kb)</label>
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" id="photo" name="photo"
                                                            placeholder="Enter Photo" value="">
                                                        <img id="uploaded_image" src="" height="100px" width="100px">
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
                                        action="{{ url('seminar_card_export') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label for="createddate" class="col-sm-3 control-label">Select Date</label>
                                            <div class="form-group">

                                                <select class="form-control" id="createddate" name="createddate"
                                                    required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($SeminarCardinfo as $item)
                                                        <option value="{{ $item->date }}">
                                                            {{ $item->date }}
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Export</button>
                                            <button type="button" class="btn btn-danger" id="closepdfmodel"
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
            $('#studentName').hide();
            $('#studentSession').hide();

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
            $.get("{{ route('seminar-id-card.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#student_name').val(data.student_name).trigger('change');
                $('#studentName').show();
                $('#studentName').val(data.student_name);
                $('#class').val(data.class).trigger('change');
                $('#roll').val(data.roll);
                $('#department_id').val(data.department_id).trigger('change');
                $('#mobile_no').val(data.mobile_no);
                $('#blood_group').val(data.blood_group);
                $('#session').val(data.session).trigger('change');
                $('#studentSession').show();
                $('#studentSession').val(data.session);
                $('#registration').val(data.registration);
                $('#date').val(data.date);
                $('#card_no').val(data.card_no);
                $('#uploaded_image').show();
                $('#uploaded_image').attr('src', 'public/library_card/' + data.photo);

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
                    url: 'seminar-id-card/' + id,
                    success: function(data) {
                        window.location = 'seminar-id-card'
                    }

                });
            }
            return false;
        });
        $('#closepdfmodel').click(function() {
            $('#pdfModel').modal('hide');
        });
        $('#closemodal').click(function() {
            $('#form').trigger("reset");
            $('#ajaxModel').modal('hide');
        });
    </script>
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#class').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: 'seminar_classInfo/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $('#session').empty();
                            $('#session').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                if (value.session) {
                                    $('#session').append('<option  data="' + value
                                        .studentclass + '/' + value.session +
                                        '"value="' + value
                                        .session + '">' + value.session +
                                        '</option>');
                                } else if (value.session_year) {
                                    $('#session').append('<option data="' + value
                                        .class_id + '/' + value.session_year +
                                        '" value="' + value
                                        .session_year + '">' + value.session_year +
                                        '</option>');
                                }
                            });
                            $('#session').trigger('change');
                        }

                    });
                }
            });
            $('#session').on('change', function() {
                var userid = $(this).find('option:selected').attr('data');
                // console.log(userid);
                $.ajax({
                    url: 'seminarstudentInfo',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        userid: userid
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#student_name').empty();
                        $('#student_name').append('<option value="">--Select--</option>');
                        $.each(data, function(key, value) {
                            if (value.name) {
                                $('#student_name').append('<option data="' + value
                                    .studentclass + '/' + value.id +
                                    '" value="' + value
                                    .id + '">' + value.name +
                                    '</option>');
                            } else if (value.student_name) {
                                $('#student_name').append('<option data="' + value
                                    .class_id + '/' + value.id +
                                    '" value="' + value
                                    .id + '">' + value.student_name +
                                    '</option>');
                            }
                        });
                        $('#student_name').trigger('change');
                    }
                });
            });

            $('#student_name').on('change', function() {
                var stu_id = $(this).find('option:selected').attr('data');

                $.ajax({
                    url: 'seminarstuallInfo',
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        stu_id: stu_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            var value = data[0];
                            $('#roll').val(value.roll);
                            $('#registration').val(value.registration_no);
                            $('#mobile_no').val(value.mobile_no);
                            $('#blood_group').val(value.blood_group);
                            if (value.name) {
                                $('#stu_name').val(value.name);
                            } else if (value.student_name) {
                                $('#stu_name').val(value.student_name);
                            }
                        } else {
                            $('#roll').val('Student Roll Not Found').css('color', 'red');
                        }

                    }

                });

            });
            $('#student_name').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
