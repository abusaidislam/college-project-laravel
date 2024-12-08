@extends('layouts.cocurricularapp')
@section('title', 'Co-Curricular Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Co-Curricular Manage</h2>
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
                                    <table id="responsive" class="table table-striped table-bordered nowrap"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($CoCurricular as $ndata)
                                                @php
                                                    $co_name = DB::table('co_curriculars')
                                                        ->where('id', $ndata->co_id)
                                                        ->first();
                                                @endphp
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td><img src="{{ asset('public/coteacher/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $co_name->name }}</td>
                                                    <td>{{ $ndata->date }} </td>
                                                    <td>{{ $ndata->time }} </td>
                                                    <td>{!! $ndata->details !!} </td>
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
                                        action="{{ route('cocurricularmanage.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="total_row" class="col-sm-12 control-label">Name:</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="co_id" name="co_id">
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @foreach ($data as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Date</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="date" name="date"
                                                    placeholder="Enter Date" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="time" class="col-sm-3 control-label">Time</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="time" name="time"
                                                    placeholder="Enter Time" value="" required="">
                                            </div>
                                        </div>
                               
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label><strong>Details :</strong></label>
                                            <textarea class="summernote" placeholder="Enter Details" id="details"name="details"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" id="photo" name="photo"
                                                placeholder="Enter Photo" value="">

                                            <input type="hidden" name="hidden_image" id="hidden_image">
                                        </div>
                                    </div>
                                    <div class=" col-sm-offset-2 col-sm-10 my-2">
                                        <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                        <button type="button" class="btn btn-danger" id="closemodal" aria-label="Close">
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

            $.get("{{ route('cocurricularmanage.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#co_id').val(data.co_id);
                $('#date').val(data.date);
                $('#time').val(data.time);
                $('#details').summernote('code', data.details);
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
                        url: 'cocurricularmanage/' + id,
                        success: function(data) {
                            window.location = 'cocurricularmanage';
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
