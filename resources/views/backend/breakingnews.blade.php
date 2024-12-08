@extends('layouts.app')
@section('title', 'News Manage |')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>News Manage</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <span class="input-group-btn">
                                    <a class="btn btn-success text_end" href="javascript:void(0)" id="createNew">
                                        Create New </a>
                                </span>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-responsive"
                                            class="table table-striped table-bordered dt-responsive nowrap p-0"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Title</th>
                                                    <th>Document</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list">
                                                @foreach ($data as $ndata)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $ndata->title }}</td>
                                                        <td>
                                                            <a href="{{ asset('public/breaking_news/' . $ndata->photo) }}" download
                                                                class="btn btn-sm"
                                                                style=" background: linear-gradient(to top, #93bbb1, #05eaff)">
                                                                <span class="glyphicon glyphicon-download"></span> Download
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button type="button" id="edit"
                                                                data-id="{{ $ndata->id }}"
                                                                class="btn btn-sm btn-info">Edit</button>
                                                            <button type="button" id="delete"
                                                                data-id="{{ $ndata->id }}"
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
                                            action="{{ route('news.store') }}" enctype="multipart/form-data">
                                            @csrf()
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="title" class="col-sm-12 control-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="title" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="photo" class="col-sm-12 control-label">Document</label>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" id="photo" name="photo"
                                                        placeholder="Enter Photo">
                                                </div>
                                            </div>
                                            <div class=" col-sm-offset-2 col-sm-10 my-3">
                                                <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                                <button type="button" class="btn btn-primary " id="close"
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
            });

            $('#createNew').click(function() {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Create New");
                $('#form').trigger("reset");
                $('#saveBtn').html('Save');
                $('#id').val('');
            });

            $('body').on('click', '#edit', function() {
                var id = $(this).data('id');
                $.get("{{ route('news.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#title').val(data.title);
                    $('#photo').val(data.photo);
                });
            });
            $('body').on('click', '#delete', function() {
                var id = $(this).data("id");
                Swal.fire(sweetAlertConfirmation).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: 'news/' + id,
                            success: function(data) {
                                window.location = 'news';
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


            // $('#form').submit(function(event) {
            //     event.preventDefault();
            //     $('#saveBtn').prop('disabled', true);

            //     $.ajax({
            //         type: "POST",
            //         url: '{{ route('news.store') }}',
            //         data: new FormData(this),
            //         contentType: false,
            //         processData: false,
            //         success: function(data) {
            //             // window.location = 'news';
            //             $('#ajaxModel').modal(
            //                 'hide'); // Hide the modal after successful submission
            //             $('#saveBtn').prop('disabled', false);
            //             location.reload();
            //             $('.text-success').html('Inserted successfully!!!')
            //                 .show(); // Show success message
            //             setTimeout(function() {
            //                 $('.text-success').hide();
            //             }, 10000);
            //         },
            //         complete: function() {
            //             $('#saveBtn').prop('disabled', false);

            //         }
            //     });
            // });
        });
    </script>
@endsection
