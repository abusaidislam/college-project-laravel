@extends('layouts.department')
@section('title', ' Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Class Schedule Manage</h2>
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
                                                <th width="280px">Day/Time</th>
                                                <th width="280px">9.00--9.45 </th>
                                                <th width="280px">9.45--10.30</th>
                                                <th width="280px">10.30--11.15</th>
                                                <th width="280px">11.15--12.00</th>
                                                <th width="280px">12.00--12.45</th>
                                                <th width="280px">12.45--1.30</th>
                                                <th width="280px">1.30--2.00</th>
                                                <th width="280px">2.00--2.45</th>
                                                <th width="280px">2.45--3.30</th>
                                                <th width="280px">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $ndata->day }}
                                                    </td>
                                                    <td>
                                                        <pre>{!! $ndata->fitst !!}</pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->scend }} </pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->third }} </pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->forth }}</pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->fifth }} </pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->sixth }}</pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->seventh }} </pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->eight }} </pre>
                                                    </td>
                                                    <td>
                                                        <pre>{{ $ndata->nine }} </pre>
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
                    <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ Route('department-class_schedules.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf()
                                        <input type="hidden" name="depart_id" id="depart_id"
                                            value="{{ Session::get('depart_id') }}">
                                        <input type="hidden" name="id" id="id">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                        
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">Day Name</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="day" name="day" pl
                                                            class="form-control"aceholder="Day Name" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">9.00--9.45</label>
                                                    <div class="col-sm-12">

                                                        <textarea id="fitst" name="fitst" class="form-control"> </textarea>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">9.45--10.30</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="scend" name="scend" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label"> 10.30--11.15 </label>
                                                    <div class="col-sm-12">
                                                        <textarea id="third" name="third" class="form-control"> </textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">11.15--12.00</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="forth" name="forth" class="form-control"> </textarea>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">12.00--12.45</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="fifth" name="fifth" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">12.45--1.30</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="sixth" name="sixth" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label"> 1.30--2.00</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="seventh" name="seventh" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-12 control-label">2.00--2.45</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="eight" name="eight" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nine" class="col-sm-12 control-label">2.45--3.30</label>
                                                    <div class="col-sm-12">
                                                        <textarea id="nine" name="nine" class="form-control"> </textarea>
                                                    </div>
                                                </div>
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
            $.get("{{ Route('department-class_schedules.index') }}" + '/' + id + '/edit', function(data) {


                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#day').val(data.day);
                $('#fitst').val(data.fitst);
                $('#scend').val(data.scend);
                $('#third').val(data.third);
                $('#forth').val(data.forth);
                $('#fifth').val(data.fifth);
                $('#sixth').val(data.sixth);
                $('#seventh').val(data.seventh);
                $('#eight').val(data.eight);
                $('#nine').val(data.nine);
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
                        url: 'department-class_schedules/' + id,
                        success: function(data) {
                            window.location = 'department-class_schedules';
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
