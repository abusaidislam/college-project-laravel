@extends('layouts.degreeapp')
@section('title', 'Teachers Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Teachers Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
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
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>BCS_Batch</th>
                                                <th>First<br>Joining</th>
                                                <th>Present<br>Joining</th>
                                                <th>Blood Group</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Date of Birth</th>
                                                <th>PRL Date</th>
                                                <th>Home District</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $ndata)
                                            <tr>
                                                <td><img src="{{ asset('public/teachers/' . $ndata->photo) }} " alt=""
                                                        width="100" height="80"> </td>
                                                <td>{{ $ndata->name }}</td>
                                                @if ($ndata->designation == 1)
                                                <td>Professor</td>
                                                @elseif ($ndata->designation == 2)
                                                <td>Associate Professor</td>
                                                @elseif ($ndata->designation == 3)
                                                <td>Assistant Professor</td>
                                                @elseif ($ndata->designation == 4)
                                                <td>Lecturer</td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>{{ $ndata->bcs_batch }} </td>
                                                <td>{{ $ndata->first_joining }} </td>
                                                <td>{{ $ndata->present_joining }} </td>
                                                <td>{{ $ndata->blood_group }} </td>
                                                <td>{{ $ndata->mobile_no }} </td>
                                                <td>{{ $ndata->email }} </td>
                                                <td>{{ $ndata->date_of_birth }} </td>
                                                <td>{{ $ndata->rcl_date }} </td>
                                                <td>{{ $ndata->home_dis }} </td>
                                                <td>{{ $ndata->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
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
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('degree-teacher.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            placeholder="Enter Name" value="" maxlength="50"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            placeholder="Enter mail" value="" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="mobile_no" class="col-sm-3 control-label">Mobile
                                                        No.</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="mobile_no"
                                                            name="mobile_no" placeholder="Enter Mobile No." value=""
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"
                                                        class="col-sm-12 control-label">Designation</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="designation"
                                                            name="designation">
                                                            <option class="" value="" selected>--Select --</option>
                                                            <option class="" value="1">Professor</option>
                                                            <option class="" value="2">Associate Professor</option>
                                                            <option class="" value="3">Assistant Professor</option>
                                                            <option class="" value="4">Lecturer</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="designation" class="col-sm-12 control-label">Home
                                                        District</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="home_dis"
                                                            name="home_dis" placeholder="Enter Home District" value=""
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bcs_batch"
                                                        class="col-sm-12 control-label">BCS_Batch</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="bcs_batch"
                                                            name="bcs_batch" placeholder="Enter BCS_Batch" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="first_joining" class="col-sm-12 control-label">First
                                                        Joining</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="first_joining"
                                                            name="first_joining" placeholder="Enter First Joining"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">

                                                <div class="form-group">
                                                    <label for="present_joining" class="col-sm-12 control-label">Present
                                                        Joining</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="present_joining"
                                                            name="present_joining" placeholder="Enter Present Joining"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_of_birth" class="col-sm-12 control-label">Date
                                                        of
                                                        Birth
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control" id="date_of_birth"
                                                            name="date_of_birth" placeholder="Enter Date of Birth"
                                                            required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="rcl_date" class="col-sm-12 control-label">PRL Date
                                                    </label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="rcl_date"
                                                            name="rcl_date" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">Blood
                                                        Group</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="blood_group"
                                                            name="blood_group">
                                                            <option class="" value="" selected>--Select --</option>
                                                            <option class="" value="A+">A+</option>
                                                            <option class="" value="A-">A-</option>
                                                            <option class="" value="B+">B+</option>
                                                            <option class="" value="B-">B-</option>
                                                            <option class="" value="O+">O+</option>
                                                            <option class="" value="O-">O-</option>
                                                            <option class="" value="AB+">AB+</option>
                                                            <option class="" value="AB-">AB-</option>
                                                        </select>

                                                    </div>
                                                </div>
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

                                                <div class="form-group">
                                                    <label for="status" class="col-sm-12 control-label">Status</label>
                                                    <div class="col-sm-12">
                                                        <select class="form-control" id="status" name="status">
                                                            <option class="" value="0" selected>Active</option>
                                                            <option class="" value="1">Inactive</option>
                                                        </select>
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

            $.get("{{ route('degree-teacher.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#home_dis').val(data.home_dis);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#first_joining').val(data.first_joining);
                $('#present_joining').val(data.present_joining);
                $('#date_of_birth').val(data.date_of_birth);
                $('#rcl_date').val(data.rcl_date);
                $('#blood_group').val(data.blood_group);
                $('#mobile_no').val(data.mobile_no);
                $('#status').val(data.status);

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
                        url: 'degree-teacher/' + id,
                        success: function(data) {
                            window.location = 'degree-teacher';
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
            $('#ajaxModel').modal('hide');
        });
</script>
<script>
    $('#date_of_birth').change(function() {
            let fulldate = $(this).val();

            let birthDate = new Date(fulldate);
            let retratmentDate = new Date(birthDate);
            retratmentDate.setFullYear(birthDate.getFullYear() + 59);
            let formattedDate =
                `${retratmentDate.getMonth() + 1}-${retratmentDate.getDate()}-${retratmentDate.getFullYear()}`;
            $("#rcl_date").val(formattedDate);
        });
</script>
@endsection