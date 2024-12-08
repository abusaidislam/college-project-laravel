@extends('layouts.drexamapp')
@section('title', 'DR Analysis Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>DR Analysis Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew">DR Analysis Import
                                    </a>
                                </span>
                             </li>
                           
                             <li>
                                <span class="input-group-btn">
                            <form action="{{ route('delete-data') }}" method="POST">
                                @csrf
                                <input class="p-2" type="text" name="exam_name" placeholder="Exam Name">
                                <input class="p-2" type="text" name="college_name" placeholder="College Name">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
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
                                                <th>SL No.</th>
                                                <th>Exam Name-Year</th>
                                                <th>College Code-Name</th>
                                                <th>Subject Code-Name</th>
                                                <th>Paper Code-Name</th>
                                                <th>Type</th>
                                                <th>Session</th>
                                                <th>Exam Roll </th>
                                                <th>Registration No</th>
                                                <th>Candidate Name</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $ndata->examname_year }}</td>
                                                    <td>{{ $ndata->collegecode_name }}</td>
                                                    <td>{{ $ndata->subjectcode_name }}</td>
                                                    <td>{{ $ndata->papercode_name }}</td>
                                                    <td>{{ $ndata->type }}</td>
                                                    <td>{{ $ndata->session }}</td>
                                                    <td>{{ $ndata->exam_roll }}</td>
                                                    <td>{{ $ndata->registration_no }}</td>
                                                    <td>{{ $ndata->candidate_name }}</td>
                                                    <td>
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
                                    <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file" class="col-sm-12 control-label">Excel File
                                                Import</label>
                                            <div class="col-sm-12 mb-4">
                                                <input type="file" class="form-control" id="file" name="file"
                                                    placeholder="Enter Excel File">

                                            </div>
                                            <button class="btn btn-primary" type="submit">Save</button>
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
        Delete ndataInfo Code
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'dranalysis/' + id,
                        success: function(data) {
                            window.location = 'dranalysis';
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

        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
@endsection
