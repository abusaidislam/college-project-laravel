@extends('layouts.department') @section('content') <div class="right_col" role="main">
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
          <h2>Student Result Manage</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li>
              <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
              </a>
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
                      <th>Name</th>
                      <th>Department</th>
                      <th>Course</th>
                      <th>years</th>
                      <th>marks</th>
                      <th>Mobile No.</th>
                      <th>Blood Group</th>
                      <th>Home District</th>
                      <th>Registration No</th>
                      <th width="280px">Action</th>
                    </tr>
                  </thead>
                  <tbody id="list"> @foreach ($data as $ndata) <tr>
                      <td>{{$ndata->name}}</td>
                      <td>{{$ndata->department}} </td>
                      <td>{{$ndata->subject}} </td>
                      <td>{{$ndata->years}} </td>
                      <td>{{$ndata->department}} </td>
                      <td>{{$ndata->mobile_no}} </td>
                      <td>{{$ndata->blood_group}}</td>
                      <td>{{$ndata->home_dis}} </td>
                      <td>{{$ndata->registration_no}} </td>
                      <td>
                        <button type="button" id="edit" data-id="{{$ndata->id}}" class="btn btn-sm btn-info">Edit</button>
                      </td>
                    </tr> @endforeach </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Table -->
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
              </div>
              <div class="modal-body">
                <form method="POST" id="form" name="form"  action="{{ route('students-result.store') }}" enctype="multipart/form-data"> 
                  @csrf() 
                 
                  <input type="hidden" name="depart_id" id="depart_id" value="{{ Session::get('depart_id') }}">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                    <label for="designation" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-12">
                      
                        <select class="form-control" id="subject" name="subject" required>
                          <option class="" value="0" selected>--Select --</option>
                           @foreach ($CourseName as $ndepart_value)
                            <option value="{{$ndepart_value->id}}">{{$ndepart_value->name}} => {{$ndepart_value->course_code}}</option>
                           @endforeach
                        </select>
                  
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="mobile_no" class="col-sm-3 control-label">Class Name</label>
                  </div>
                  <div class="col-sm-12">
                    <select class="form-control" id="class_id" name="class_id">
                      <option class="" value="0" selected>--Select --</option> @foreach ($studentclass as $nstudentclass) <option value="{{$nstudentclass->id}}">{{$nstudentclass->name}}</option> @endforeach
                    </select>
                  </div>
                  
                  <div class="col-sm-12">
                  <!-- <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Student Name</th>
                      <th>Marks</th>
                    </tr>
                  </thead> -->
                  <span id="rep_all"></span>
                  </div>
                    <div class="form-group">
                      <label for="designation" class="col-sm-2 control-label">Year</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="year" name="year" placeholder="Enter  Year" value="" required="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="department " class="col-sm-2 control-label">Department</label>
                      <div class="col-sm-12">
                      <input type="text" class="form-control" id="department" name="department" placeholder="Enter  Year" readonly value="{{$depart_name}}" required="">                      </div>
                    </div>
                    <div class=" col-sm-offset-2 col-sm-10 my-2">
                      <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                      <button type="button" class="btn btn-primary" id="closemodal" aria-label="Close"> close </button>
                    </div>
                </form>
             </div>
          </div>
        </div>
      </div>
      
<!-- Script CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Script Local -->
<!-- <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script> -->
<script type="text/javascript">

    // $('#form').on('submit', function(event) {
    //     event.preventDefault();

    //     $.ajax({
    //         url: "{{ url('student_store') }}",
    //         type: "POST",
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(response) {
    //           console.log('alertaaaaaaaaaaa');
    //         },
    //         error: function(response) {
    //             // handle error response
    //         }
    //     });
    // });


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
          $.get("{{ route('students-result.index') }}" +'/' + id +'/edit', function (data) {
              $('#modelHeading').html("Edit");
              $('#saveBtn').html('Update');
              $('#ajaxModel').modal('show');
              $('#id').val(data.id);
              $('#name').val(data.name);
              $('#email').val(data.email);
              $('#designation').val(data.designation);
              $('#department').val(data.department);
              $('#bcs_batch').val(data.bcs_batch);
              $('#mobile_no').val(data.mobile_no);
             $('#blood_group').val(data.blood_group);
              $('#home_dis').val(data.home_dis);
               $('#from').val(data.from);
              $('#to').val(data.to);
              $('#photo').val(data.photo);
          })
     });

      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


      $('#class_id').click(function(){
            var userid =$(this).find('option:selected').val();
            if(userid > 0){
              // AJAX POST request
              $.ajax({
                url: 'getUserbyid',
                type: 'post',
                data: {_token: CSRF_TOKEN, userid: userid},
                dataType: 'json',
                success: function(response){
                  $("#rep_all").html(response);             
                }
              });
            }
         });


      $(document).ready(function(){

        // Fetch all records
        $('#but_fetchall').click(function(){

            // AJAX GET request
            $.ajax({
              url: 'getUsers',
              type: 'get',
              dataType: 'json',
              success: function(response){

                createRows(response);

              }
            });
        });

        // Search by userid


      });

      // Create table rows
      function createRows(response){

        var len = 0;
        $('#empTable tbody').empty(); // Empty <tbody>
        if(response['data'] != null){
            len = response['data'].length;
        }

        if(len > 0){
          for(var i=0; i<len; i++){
              var sid = response['data'][i].id;
              var roll = response['data'][i].roll;
              var name = response['data'][i].name;
              var tr_str = "<tr>" +
                "<td align='center'>" + (i+1) + "</td>" +
                "<td align='center'> <input type='text' class='form-control' id='name' name='sname[]' readonly  value="+name +"  required=''></td> " +
                "<input type='hidden' name='sid[]' value="+sid +" ><td align='center'><input type='text' class='form-control' id='marks' name='marks[]' placeholder='Enter Marks ' value='' required=''></td></tr>";

              $("#empTable tbody").append(tr_str);
          }

        }else{
            var tr_str = "<tr>" +
              "<td align='center' colspan='4'>No record found.</td>" +
            "</tr>";

            $("#empTable tbody").append(tr_str);
        }
      } 

      $('#closemodal').click(function() {
      $('#ajaxModel').modal('hide');
      });

</script>

@endsection