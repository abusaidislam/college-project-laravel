@extends('layouts.sportsapp')
@section('title', 'Champions List Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Champions List</h2>
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
                                                <th>Deprartment</th>
                                                <th>Session</th>
                                                <th>Events</th>
                                                <th>Awards</th>
                                                <th>Mobile No.</th>
                                                <th>Blood Group</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td><img src="{{ asset('public/schampions/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->deprartment }} </td>
                                                    <td>{{ $ndata->session }} </td>
                                                    <td>{{ $ndata->events }} </td>
                                                    <td>{{ $ndata->awards }} </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->blood_group }}
                                                    <td>{{ $ndata->email }} </td>
                                                    </td>
                                                    <td>{{ $ndata->home_dis }} </td>
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
                                        action="{{ route('schampionslist.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
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
                                                <label for="designation" class="col-sm-2 control-label">Deprartment</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="deprartment"
                                                        name="deprartment" placeholder="Enter Deprartment" value=""
                                                        required="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="blood_group" class="col-sm-12 control-label">Blood Group</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="blood_group" id="blood_group">
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
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="home_dis"
                                                        name="home_dis" placeholder="Enter Home District" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="home_dis" class="col-sm-12 control-label">Events</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="events" name="events"
                                                        placeholder="Enter Events" required="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="home_dis" class="col-sm-12 control-label">Awards</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="awards" name="awards"
                                                        placeholder="Enter Awards" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="home_dis" class="col-sm-12 control-label">Session</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="session" name="session"
                                                        placeholder="Enter Session" required="">
                                                </div>
                                            </div>
                                            <div id="img"></div>
                                            <div class="form-group">

                                                <label for="photo" class="col-sm-3 control-label">Photo</label>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" id="photo" name="photo"
                                                        placeholder="Enter Photo" value="">

                                                    <input type="hidden" name="hidden_image" id="hidden_image">
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
            $.get("{{ route('schampionslist.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#deprartment').val(data.deprartment);
                $('#mobile_no').val(data.mobile_no);
                $('#blood_group').val(data.blood_group);
                $('#home_dis').val(data.home_dis);
                $('#events').val(data.events);
                $('#awards').val(data.awards);
                $('#session').val(data.session);
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
                        url: 'schampionslist/' + id,
                        success: function(data) {
                            window.location = 'schampionslist';
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
