@extends('layouts.paapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                </div>


            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>NOC Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                                <th>Issue_no</th>
                                                <th>Subject</th>
                                                <th>Publish_date</th>
                                                <th>Document</th>

                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->issue_no }}</td>
                                                    <td>{{ $ndata->subject }} </td>
                                                    <td>{{ $ndata->publish_date }} </td>
                                                    <td>
                                                        <a href="{{ asset('public/upload/' . $ndata->document) }} " download
                                                            class="btn btn-info ">
                                                            <span class="glyphicon glyphicon-download"></span> Download
                                                        </a>
                                                    </td>
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
                                        action="{{ route('noc.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Issue No</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="issue_no" name="issue_no"
                                                    placeholder="Enter Issue No" value="" maxlength="50"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Subject</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="subject" name="subject"
                                                    placeholder="Enter Subject" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-3 control-label">Publish Date</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="publish_date"
                                                    name="publish_date" placeholder="Enter Publish Date" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Document</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="document" name="document"
                                                    placeholder="Enter Document" value="">
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

            $.get("{{ route('noc.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#issue_no').val(data.issue_no);
                $('#subject').val(data.subject);
                $('#publish_date').val(data.publish_date);
                $('#document').val(data.document);


            });
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
                    url: 'noc/' + id,
                    success: function(data) {
                        window.location = 'noc'
                    }

                });
            }
            return false;

        });

        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection
