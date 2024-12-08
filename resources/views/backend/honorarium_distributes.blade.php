@php
    $userType = DB::table('users')
        ->where('id', $authID)
        ->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Honorarium Distribute Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Honorarium Distribute Manage</h2>
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
                                                <th>No.</th>
                                                <th>Receiver Name</th>
                                                <th>Date</th>
                                                <th>Ammount</th>
                                                <th>Note</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $ndata->receiver }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($ndata->dates)) }} </td>
                                                    <td>{{ $ndata->ammount }} </td>
                                                    <td>{!! $ndata->note !!} </td>
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
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('honorarium_distributes.store') }}" enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Receiver Name: </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="receiver" name="receiver"
                                                    placeholder="Receiver Name" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label"> Date</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="dates" name="dates"
                                                    placeholder="Date" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ammount" class="col-sm-12 control-label">Ammount</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="ammount" name="ammount"
                                                    placeholder="Enter Ammount" value="" required="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label><strong>Note :</strong></label>
                                            <div class="col-sm-12">
                                             <textarea class="summernote" placeholder="Enter Message" id="note"name="note"></textarea>
                                             </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger"
                                                id="close"data-bs-dismiss="modal" aria-label="Close">
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
            $.get("{{ route('honorarium_distributes.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#receiver').val(data.receiver);
                $('#dates').val(data.dates);
                $('#ammount').val(data.ammount);
                $('#note').summernote('code', data.note);

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
                    url: 'honorarium_distributes/' + id,
                    success: function(data) {
                        window.location = 'honorarium_distributes'
                    }

                });
            }
            return false;



        });




        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
@endsection
