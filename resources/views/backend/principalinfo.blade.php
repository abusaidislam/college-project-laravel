@extends('layouts.adapp')
@section('title', 'Principal Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Principal Information</h2>
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
                                                <th>Th</th>
                                                <th>BCS Batch</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td><img src="{{ asset($ndata->photo) }} " alt="" width="50"
                                                            height="80"></td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->designation }}</td>
                                                    <td>{{ $ndata->th }} </td>
                                                    <td>{{ $ndata->bcs_batch }}</td>
                                                    <td>{{ $ndata->department }}</td>
                                                    <td>{{ $ndata->mobile_no }}</td>
                                                    <td>{{ $ndata->blood_group }}</td>
                                                    <td>{{ $ndata->email }}</td>
                                                    <td>{{ $ndata->home_dis }}</td>
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
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('principaleinfo.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Name" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter mail" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    placeholder="Enter Mobile No." value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Designation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation" placeholder="Enter Designation" value=""
                                                    required="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="department" class="col-sm-12 control-label">Department</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="department"
                                                    name="department" placeholder="Enter Department" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-12 control-label">BCS Batch</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="bcs_batch"
                                                    name="bcs_batch" placeholder="Enter BCS_Batch" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="blood_group" class="col-sm-12 control-label">Blood Group</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="blood_group" name="blood_group">
                                                    <option class="" value="" selected>--Select --</option>
                                                    <option value="O+">O positive</option>
                                                    <option value="O-">O negative</option>
                                                    <option value="A+">A positive</option>
                                                    <option value="A-">A negative</option>
                                                    <option value="B+">B positive</option>
                                                    <option value="B-">B negative</option>
                                                    <option value="AB+">AB positive</option>
                                                    <option value="AB-">AB negative</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="home_dis"
                                                    name="home_dis" placeholder="Enter Home District" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">From Date</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="from" name="from"
                                                    placeholder="Enter From Date" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">To Date</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="to" name="to"
                                                    placeholder="Enter To Date" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-12 control-label">Th</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="th" name="th"
                                                    placeholder="Enter Th" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:530x650, Max-Size:200kb) </label>
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
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary" id="closemodal"
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

            $.get("{{ route('principaleinfo.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#mobile_no').val(data.mobile_no);
                $('#blood_group').val(data.blood_group);
                $('#home_dis').val(data.home_dis);
                $('#th').val(data.th);
                $('#from').val(data.from);
                $('#status').val(data.status);
                $('#to').val(data.to);
                $('#photo').val(data.photo);
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
                        url: 'principaleinfo/' + id,
                        success: function(data) {
                            window.location = 'principaleinfo';
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
@endsection
