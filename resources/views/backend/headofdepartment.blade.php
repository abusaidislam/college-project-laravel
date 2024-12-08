
@extends('layouts.department')
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
              <h2>Head of Department Manage</h2>
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


              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th> Name</th>
                        <th>Designation</th>
                        <th>Photo</th>
                        <th>Message</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @foreach ($data as $ndata)
                        <tr id="row_list{{$ndata->id}}">
                            <td>{{$ndata->id}}</td>
                        <td>{{$ndata->name}}</td>
                        <td>{{$ndata->designation}}  </td>
                        <td><img src="{{$ndata->photo}}" alt="Head of Department" width="80" height="80">  </td>
                        <td>{!!$ndata->message!!}  </td>
                       
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
                <form method="POST" id="form" name="form" class="form-horizontal" action="{{ route('headofdepartment.store') }}"  enctype="multipart/form-data">
                    @csrf()
<input type="hidden" name="depart_id" id="depart_id" value="{{ Session::get('depart_id') }}"> 
  <input type="hidden" name="id" id="id">
                    <div class="form-group">
                         <label for="name" class="col-sm-12 control-label"> Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder=" Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="route" class="col-sm-12 control-label">Designation</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value=""  required="">
                        </div>
                    </div>

                   


  <div class="form-group">
                                <label><strong>Message :</strong></label>
                                <textarea class="summernote" placeholder="Enter Message" id="message"name="message"></textarea>
                            </div>

          
  
       <div id="click2edit"></div>
   
                  
                   
                    <div class="form-group">

                        <label for="photo" class="col-sm-12 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Enter Photo" value=""  >

                            
                        </div>
                    </div>

                    <div class=" col-sm-offset-2 col-sm-10 my-2">

                     <button type="submit" class="btn btn-primary" id="saveBtn" ></button>
                      <button type="button" class="btn btn-primary "  id="close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                 
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


           $('#createNew').click(function () {
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
           $('body').on('click', '#edit', function () {
             var id = $(this).data('id');
             $.get("{{ route('headofdepartment.index') }}" +'/' + id +'/edit', function (data) {
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#ajaxModel').modal('show');
                 $('#id').val(data.id);
                 $('#name').val(data.name);
                 $('#designation').val(data.designation);
                 $('#message').summernote('code', data.message);
                 $('#photo').val(data.photo);
                 
        }); });

           

     
           /*------------------------------------------
           --------------------------------------------
           Delete ndataInfo Code
           --------------------------------------------
           --------------------------------------------*/
           $('body').on('click', '#delete', function () {

               var id = $(this).data("id");
                if (confirm("Are You sure want to delete This!")) {
        $.ajax({
                   type: "DELETE",
                   url:'headofdepartment/'+id ,
                   success: function (data) {
                       window.location='headofdepartment'
                   }

               });}
    return false;
           });


     $('#close').click(function () {
    $('#ajaxModel').modal('hide');

});

       </script>
@endsection
