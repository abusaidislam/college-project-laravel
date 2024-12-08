@extends('layouts.libaryapp')
@section('title', 'Library Personnel Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Library Personnel List</h2>
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
                                                <th>SL</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Mobile No.</th>
                                                <th>First join</th>
                                                <th>Present join</th>
                                                <th>Date of Birth</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Status</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->serial_num }}</td>
                                                    <td><img src="{{ asset('public/librain/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->designation }} </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->first_join }} </td>
                                                    <td>{{ $ndata->present_join }} </td>
                                                    <td>{{ $ndata->date_of_birth }} </td>
                                                    <td>{{ $ndata->blood_group }}</td>
                                                    <td>{{ $ndata->email }} </td>
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
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('library_personnel.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        @php
                                            $number = DB::table('librarians')
                                                ->select('serial_num')
                                                ->orderBy('serial_num', 'desc')
                                                ->first();
                                        @endphp
                                    <div class="row">
                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="serial_num" class="col-sm-12 control-label">Serial Number</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="serial_num" name="serial_num"
                                                    value="{{ $number ? $number->serial_num + 1 : 1 }}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Name" value="" maxlength="50" required="">
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
                                            <label for="mobile_no" class="col-sm-3 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    placeholder="Enter Mobile No." value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation" placeholder="Enter Designation" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Blood Group</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="blood_group" name="blood_group">
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
                                            <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="home_dis"
                                                    name="home_dis" placeholder="Enter Home District" required="">
                                            </div>
                                        </div>
                                      </div>
                               
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">From Join</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="first_join"
                                                    name="first_join" placeholder="Enter From Join" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">Present Join</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="present_join"
                                                    name="present_join" placeholder="Enter To Present Join"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_of_birth" class="col-sm-12 control-label">Date of Birth
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
                                        <div id="img"></div>
                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:530x650, Max-Size:200kb)</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">
                                                <input type="hidden" name="hidden_image" id="hidden_image">
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
                                        <button type="button" class="btn btn-danger" id="close"
                                            data-bs-dismiss="modal" aria-label="Close">
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
            $.get("{{ route('library_personnel.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#serial_num').val(data.serial_num);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#mobile_no').val(data.mobile_no);
                $('#blood_group').val(data.blood_group);
                $('#home_dis').val(data.home_dis);
                $('#first_join').val(data.first_join);
                $('#present_join').val(data.present_join);
                $('#date_of_birth').val(data.date_of_birth);
                $('#rcl_date').val(data.rcl_date);
                $('#photo').val(data.photo);
                $('#status').val(data.status);
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
                        url: 'library_personnel/' + id,
                        success: function(data) {
                            window.location = 'library_personnel';
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
