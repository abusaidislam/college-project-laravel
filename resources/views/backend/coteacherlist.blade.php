@extends('layouts.cocurricularapp')
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
              <h2>Co-Curricular Activity Teacher List</h2>
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

                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Blood Group </th>
                        <th>Mobile No.</th>
                        <th>Teacher Type</th>
                        <th>Home District</th>
                        <th>First Joining</th>
                        <th>Present Joining</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody id="list">
    @foreach ($data as $ndata)
                        <tr>
                        <td><img src="{{asset('coteacher/'.$ndata->photo)}} " alt="" width="80" height="80">  </td>
                        <td>{{$ndata->name}}</td>
                        <td>{{$ndata->email}}  </td>
                        <td>{{$ndata->designation}}  </td>
                         <td>@switch($ndata->blood_group)
                            @case($ndata->blood_group==1)
                            <span >O positive</span>
                                @break
                                @case($ndata->blood_group==2)
                                <span >O negative</span>
                                @break
                                @case($ndata->blood_group==3)
                                <span >A positive</span>
                                    @break
                                    @case($ndata->blood_group==4)
                                    A negative
                                    @break
                                    @case($ndata->blood_group==5)
                                    B positive
                                        @break
                                        @case($ndata->blood_group==6)
                                        B negative
                                        @break
                                        @case($ndata->blood_group==7)
                                        AB positive
                                        @break
                                        @case($ndata->blood_group==8)
                                        AB negative
                                        @break
                        @endswitch

        </td>
                        <td>{{$ndata->mobile_no}}  </td>
                         <td>@switch($ndata->teachertype)
                            @case($ndata->teachertype==1)
                            <span >Badhon</span>
                                @break
                                @case($ndata->teachertype==2)
                                <span >ICT Club</span>
                                @break
                                @case($ndata->teachertype==3)
                                <span >Career Club</span>
                                    @break
                                    @case($ndata->teachertype==4)
                                    Sports
                                    @break
                                    @case($ndata->teachertype==5)
                                    BNCC
                                        @break
                                        @case($ndata->teachertype==6)
                                       Rover Scout
                                        @break
                                        @case($ndata->teachertype==7)
                                        Red Crescent
                                        @break
                                        @case($ndata->teachertype==8)
                                       Shilpolok
                                        @break
                                        @case($ndata->teachertype==8)
                                       Debating Club
                                        @break
                        @endswitch

        </td><td>{{$ndata->home_dis}}  </td> <td>{{$ndata->first_join}}  </td>
                        <td>{{$ndata->present_join}}  </td>
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
                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg" action="{{ route('coteacherlist.store') }}"  enctype="multipart/form-data">
                        @csrf()

      <input type="hidden" name="id" id="id">
                        <div class="form-group">
                             <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter mail" value=""  required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_no" class="col-sm-3 control-label">Mobile No.</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." value=""  required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teachertype" class="col-sm-12 control-label">Teacher Type</label>
                            <div class="col-sm-12">
                                <select name="teachertype" id="teachertype">
                                    <option value="1">Badhon</option>
                                    <option value="2">ICT Club</option>
                                    <option value="3">Career Club</option>
                                    <option value="4">Sports</option>
                                    <option value="5">BNCC</option>
                                    <option value="6">Rover Scout</option>
                                    <option value="7">Red Crescent</option>
                                    <option value="8">Shilpolok</option>
                                     <option value="9">Debating Club</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" value=""  required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="blood_group" class="col-sm-12 control-label">Blood Group</label>
                            <div class="col-sm-12">
                                <select name="blood_group" id="blood_group">
                                    <option value="1">O positive</option>
                                    <option value="2">O negative</option>
                                    <option value="3">A positive</option>
                                    <option value="4">A negative</option>
                                    <option value="5">B positive</option>
                                    <option value="6">B negative</option>
                                    <option value="7">AB positive</option>
                                    <option value="8">AB negative</option>
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="home_dis" name="home_dis" placeholder="Enter Home District"  required="">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="home_dis" class="col-sm-12 control-label">First Joining</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="first_join" name="first_join" placeholder="Enter First Joining"  required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="home_dis" class="col-sm-12 control-label">Present Joining</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="present_join" name="present_join" placeholder="Enter Present Joining"  required="">
                            </div>
                        </div>
                        <div id="img"></div>
                        <div class="form-group">

                            <label for="photo" class="col-sm-3 control-label">Photo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="photo" name="photo" placeholder="Enter Photo" value=""  >

                                <input type="hidden" name="hidden_image" id="hidden_image">
                            </div>
                        </div>

                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                         <button type="submit" class="btn btn-primary" id="saveBtn" ></button>
                         <button type="button" class="btn btn-primary" id ="closemodal"  aria-label="Close">
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

             $.get("{{ route('coteacherlist.index') }}" +'/' + id +'/edit', function (data) {
                  $('#ajaxModel').modal('show');
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#id').val(data.id);
                 $('#name').val(data.name);
                 $('#email').val(data.email);
                 $('#designation').val(data.designation);
                 $('#teachertype').val(data.teachertype);
                 $('#mobile_no').val(data.mobile_no);
                 $('#blood_group').val(data.blood_group);
                 $('#home_dis').val(data.home_dis);
                 $('#first_join').val(data.first_join);
                 $('#present_join').val(data.present_join);
                 $('#photo').val(data.photo);
        }); });





/*------------------------------------------
           --------------------------------------------
           Delete ndataInfo Code
           --------------------------------------------
           --------------------------------------------*/
           $('body').on('click', '#delete', function () {

               var id = $(this).data("id");
               confirm("Are You sure want to delete !");

               $.ajax({
                   type: "DELETE",
                   url:'coteacherlist/'+id ,
                   success: function (data) {
                       window.location='coteacherlist'
                   }

               });
           });

$('#closemodal').click(function() {
    $('#ajaxModel').modal('hide');
});





</script>

@endsection
