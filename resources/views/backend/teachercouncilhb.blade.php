@extends('layouts.adapp')
@section('content')
@section('title', 'Teacher Council Honour Board Manage |')
@section('content')
<div class="content">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Teachers Council Honour Board Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Academic Designation</th>
                                                <th>Department</th>
                                                <th>BCS_Batch</th>
                                                <th>
                                                    <div class="row ">
                                                        <div class="col text-center border-bottom ">Period</div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col ">From</div>
                                                        <div class="col text-center">To</div>
                                                    </div>
                                                </th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>

                                                    <td class="text-center"><img src="{{ asset($ndata->photo) }} "
                                                            style="width: 100px; height: 80px;"> </td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->designation }} </td>
                                                    <td>{{ $ndata->academicdesignation }} </td>
                                                    <td>{{ $ndata->department }} </td>
                                                    <td>{{ $ndata->bcs_batch }} </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col border-end">{{ $ndata->from }} </div<div
                                                                    class="col text-center">- {{ $ndata->to }}</div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->email }} </td>

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
                                        action="{{ route('teachercouncilhb.store') }}" enctype="multipart/form-data">
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
                                                    <label for="designation" class="col-sm-12 control-label">Designation</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="designation"
                                                            name="designation" placeholder="Enter Designation" value=""
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="designation" class="col-sm-12 control-label">Academin
                                                        Designation</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="academicdesignation"
                                                            name="academicdesignation" placeholder="Enter Academin Designation"
                                                            value="" required="">
                                                    </div>
                                                </div>

                                             
                                               </div>
                                               <div class="col-md-6 col-sm-12">
                                                
                                                <div class="form-group">
                                                    <label for="department" class="col-sm-2 control-label">Department</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="department"
                                                            name="department" placeholder="Enter Department" value=""
                                                            required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="bcs_batch" class="col-sm-2 control-label">BCS_Batch</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="bcs_batch"
                                                            name="bcs_batch" placeholder="Enter BCS_Batch" required="">
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

                                                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                                                        <div class="col-sm-12">
                                                            <input type="file" class="form-control" id="photo" name="photo"
                                                                placeholder="Enter Photo" value="">


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

            $.get("{{ route('teachercouncilhb.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#academicdesignation').val(data.academicdesignation);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#mobile_no').val(data.mobile_no);
                $('#from').val(data.from);
                $('#to').val(data.to);

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
                        url: 'teachercouncilhb/' + id,
                        success: function(data) {
                            window.location = 'teachercouncilhb';
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
