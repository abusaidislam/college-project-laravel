@extends('layouts.sportsapp')
@section('title', 'Sports Notice Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Sports Notice Board</h2>
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
                        <table id="responsive" class="table table-striped table-bordered nowrap" cellspacing="0" >
                            <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Place</th>
                                    <th>Details</th>
                                
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                            @foreach ($data as $ndata)
                                    <tr>
                                    <td>{{$ndata->title}}</td>
                                    <td>{{$ndata->date}}  </td>
                                    <td>{{$ndata->time}}  </td>
                                    <td>{{$ndata->place}}  </td>
                                <td>{!!$ndata->details!!}  </td> 
                                    <td><button type="button" id="edit" data-id="{{$ndata->id}}"
                                        class="btn btn-sm btn-info">Edit</button>
                                    
                                        <button type="button" id="delete" data-id="{{$ndata->id}}"
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
                            <form method="POST" id="form" name="form" class="form-horizontal modal-lg" action="{{ route('snoticelist.store') }}"  enctype="multipart/form-data">
                                @csrf()

                            <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date" value=""  required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="time" class="col-sm-12 control-label">Time</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="time" name="time" placeholder="Enter Time" value=""  required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="designation" class="col-sm-12 control-label">Place</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="place" name="place" placeholder="Enter Place" value=""  required="">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                        <label for="details" class="col-sm-12 control-label">Details</label>
                                        <div class="col-sm-12">
                                           <textarea class="summernote" placeholder="Enter Details" id="details"name="details"></textarea>
                                       </div>
                                    </div>
                            
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" ></button>
                                    <button type="button" class="btn btn-danger" id ="closemodal"  aria-label="Close">
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


         $('#createNew').click(function () {
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
           $('body').on('click', '#edit', function () {
             var id = $(this).data('id');

             $.get("{{ route('snoticelist.index') }}" +'/' + id +'/edit', function (data) {
                  $('#ajaxModel').modal('show');
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#id').val(data.id);
                 $('#title').val(data.title);
                 $('#date').val(data.date);
                 $('#place').val(data.place);
                 $('#time').val(data.time);
                  $('#details').summernote('code', data.details);
        }); });

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
                        url: 'snoticelist/' + id,
                        success: function(data) {
                            window.location = 'snoticelist';
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
