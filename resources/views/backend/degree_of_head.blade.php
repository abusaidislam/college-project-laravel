@extends('layouts.degreeapp')
@section('title', 'Head of Department Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Head of Department Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{-- <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
                                </span>
                            </li> --}}
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
                                                <th> Name</th>
                                                <th>Designation</th>
                                                <th>Photo</th>
                                                <th>Signature</th>
                                                <th>Message</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            <tr id="row_list{{ $ndata->id }}">
                                                <td>1</td>
                                                <td>{{ $ndata->name }}</td>
                                                <td>{{ $ndata->designation }}</td>
                                                @if ($ndata->photo === 'department/images/default.jpg')
                                                <td> <img src="{{ asset('public/Dhead/' . $ndata->photo) }}" alt=""
                                                        width="80" height="80"></td>
                                                @else
                                                <td> <img src="{{ asset('public/Dhead/' . $ndata->photo) }}" alt=""
                                                        width="80" height="80"></td>
                                                @endif
                                                @if ($ndata->signature === 'department/images/default.jpg')
                                                <td> <img src="{{ asset('public/Dhead/' . $ndata->signature) }}" alt=""
                                                        width="150" height="80"></td>
                                                @else
                                                <td> <img src="{{ asset('public/Dhead/' . $ndata->signature) }}" alt=""
                                                        width="150" height="80"></td>
                                                @endif
                                                <td>{!! $ndata->message !!} </td>
                                                <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                        class="btn btn-sm btn-info">Edit</button>
                                                </td>
                                            </tr>
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
                                        action="{{ route('degree-headofdepartment.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label"> Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder=" Name" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="route" class="col-sm-12 control-label">Designation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation"
                                                    name="designation" placeholder="Designation" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Message :</strong></label>
                                            <textarea class="summernote" placeholder="Enter Message" id="message"
                                                name="message"></textarea>
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
                                            <label for="signature" class="col-sm-12 control-label">Signature
                                                (Dimensions:300x80, Max-Size:200kb)</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="signature" name="signature"
                                                    placeholder="Enter Signature" value="">
                                                <span class="text-danger">
                                                    @error('signature')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
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
            $.get("{{ route('degree-headofdepartment.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#designation').val(data.designation);
                $('#message').summernote('code', data.message);
                $('#departments').val(data.departments);
                $("#edi_image").attr('src', 'Dhead/' + data.photo);

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
                        url: 'degree-headofdepartment/' + id,
                        success: function(data) {
                            window.location = 'degree-headofdepartment';
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
@endsection