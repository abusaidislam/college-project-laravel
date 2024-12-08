@extends('layouts.department')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <h4 class="text-success text-center"></h4>
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
              <h2> Vision & Mission Manage: </h2>
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
                        <th width="20">No.</th>
                        <th>Vision & Mission Title </th>
                        <th> Images</th>
                        <th> Vision & Mission History </th>
                        <th width="70px">Action</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @foreach ($vision_mission as $vm)                   
                    
                    <tr id="row_list">
                      <td> 1. </td>
                      <td> {{ $vm->vision_title }} </td>
                      <td><img src="{{ asset($vm->vision_images) }}" alt="{{ $vm->vision_title }}" width="150" height="100"></td>
                      <td> {{ $vm->vision_details }} </td>                                            
                      <td>
                        <button type="button" id="edit" data-id="{{$vm->id}}"
                            class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o p-0" aria-hidden="true"></i></button>
                        <button type="button" id="delete"
                                class="btn btn-sm btn-danger"> <i class="fa fa-trash p-0" aria-hidden="true" ></i>                               </i> </button>
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
                <form method="POST" id="form" name="form" class="form-horizontal" action="{{ url('/visioneditaction') }}"  enctype="multipart/form-data">
                    
                @csrf()
 <input type="hidden" name="depart_id" id="depart_id" value="{{ Session::get('depart_id') }}"> 
  <input type="hidden" name="id" id="id">
                    <div class="form-group">
                         <label for="name" class="col-sm-12 control-label">Vision & Mission Title :</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Department Title" value="" maxlength="50" required="">
                        </div>
                    </div>
                   <div class="form-group">
                                <label><strong>Description :</strong></label>
                                 <textarea class="summernote" placeholder="Enter description" id="description"name="description"></textarea>
                            </div>

                    <div class="form-group">

                        <label for="photo" class="col-sm-12 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Enter Photo" value=""  >

                            <input type="hidden" name="hidden_image" id="hidden_image">
                        </div>
                    </div>

                   
                    <div class=" col-sm-offset-2 col-sm-10 my-2">

                     <button type="submit" class="btn btn-primary" id="saveBtn" ></button>
                     <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="closemodal" aria-label="Close">
                    close
                    </button>
                    </div>
                </form>
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


        

           /*------------------------------------------
           --------------------------------------------
           Click to Edit Button
           --------------------------------------------
           --------------------------------------------*/
           $('body').on('click', '#edit', function () {
             var id = $(this).data('id');
             $.get("{{ url('department-visionedit') }}" +'/' + id , function (data) {
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#ajaxModel').modal('show');
                 $('#id').val(data.id);
                 $('#name').val(data.vision_title);
             
                   $('#description').summernote('code', data.vision_details);
                 
                
             })
        });

        



$('#closemodal').click(function() {
    $('#ajaxModel').modal('hide');
});




       </script>
@endsection
