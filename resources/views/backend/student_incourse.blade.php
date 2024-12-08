@extends('layouts.department') @section('content') <div class="right_col" role="main">
    <div class="">
      <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
  
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
         
        <div class="x_title">
            <h2>Student Incourse Manage</h2>
            <ul class="nav navbar-right panel_toolbox">
              <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
             <li>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="department" name="department" placeholder="Enter  Year"  required="">         
                  </div>
              </li> 
              <li>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="department" name="department" placeholder="Enter  Year"  required="">         
                  </div>
              </li>
              <li>
                  <div class="col-sm-12">
                    <input type="submit" class="btn btn-success btn-priamry" id="department" name="department" placeholder="Enter  Year" value="Show Report" >         
                  </div>
              </li>
              <li>
                  <div class="col-sm-12">
                  
                    <a class="btn btn-primary " href="javascript:void(0)" id="createNew"> Submit Result </a>
                  </div>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
  
  
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Year of exam</th>
                        <th>Class Of Year</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Roll No</th>
                        @foreach($CourseName as $v) 
                          {{-- <th>{{ $v->course_code }}({{$v->name}})</th> --}}
                          <th>{{ $v->course_code }}</th>
                        @endforeach
                        <th>CGPA</th>
                        <th>Merit Position</th>
                        <th>Download(PDF,Excel)</th>
                    
                      </tr>
                    </thead>
                    <tbody id="list">
                      @foreach($Student as $ndata) 
                      @php 
                      $studentclassList = DB::table('student_results')->where('depart_id',$depart_id)->where('student_id',$ndata->stu_id)->where('class_id',$ndata->class_name)->get();
                      $stu = DB::table('students')
                              ->join('student_sessions', 'students.id', '=', 'student_sessions.stu_id')
                              ->where('students.studentclass', $ndata->class_name)
                              ->first();
                      // @dd($stu);
  
                    // $studentclassList = DB::table('student_results')->where('depart_id',$depart_id)->where('student_id',$ndata->id)->where('class_id',$ndata->studentclass)->orderby('subject','asc')->get();
                     @endphp
  
                       <tr>
                        <td>{{ $loop->index }}</td>
                        <td>2023</td>
                        <td>1st year</td>
                        <td>{{ $stu ? $stu->name : 'N/A' }}</td>
                        <td>{{ $stu ? $stu->registration_no : 'N/A' }}</td>
                        <td>{{ $stu ? $stu->roll : 'N/A' }}</td>           
                     @foreach($CourseName as $v)
                     
                            @php
                              $found = $studentclassList->firstWhere('subject', $v->id);
                              $marks = $found ? $found->marks : '';
                            @endphp
                            <td>
                              @if ($marks)
                                {{ $marks }}
                              @endif
                            </td>
                             @endforeach
                        <td>CGPA</td>
                        <td>Merit Position</td>
                        <td>
                          <button type="button" id="edit" data-id="{{$ndata->id}}" class="btn btn-sm btn-info">Edit</button>
                          {{-- <a target="_blank" href="{{ url('mark-sheet-download/'.$ndata->id.'/2022/1') }}" class="btn btn-sm btn-primary">Download</a> --}}
                          <a target="_blank" href="{{ url('mark-sheet-download',$ndata->id) }}" class="btn btn-sm btn-primary">Download</a>
                        </td>
                      </tr>
                       @endforeach
                     </tbody>
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
                      <label for="mobile_no" class="col-sm-3 control-label">Class Name</label>
                    </div>
                    <div class="form-group">
                      <select class="form-control" id="classId" name="classId">
                        <option class="" value="0" selected>--Select --</option>
                         @foreach ($studentclass as $nstudentclass)
                          <option data-value="{{$nstudentclass->id}}" value="{{$nstudentclass->id}}">{{$nstudentclass->name}}</option> 
                         @endforeach
                      </select>
                    </div>
                
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
                      <label for="mobile_no" class="col-sm-3 control-label">Student List</label>
                    </div>
                    <div class="form-group">
                      {{-- <select class="form-control" id="class_id" name="class_id">
                        <option class="" value="0" selected>--Select --</option>
                         @foreach ($studentclass as $nstudentclass)
                          <option value="{{$nstudentclass->id}}">{{$nstudentclass->name}}</option> 
                         @endforeach
                      </select> --}}
                    </div>
                    
                    <div class="form-group">
                    <!-- <thead>
                      <tr>
                        <th>S.no</th>
                        <th>Student Name</th>
                        <th>Marks</th>
                      </tr>
                    </thead> -->
                    <span id="rep_all"></span>
                    </div>
                    @php $currentYear =  date('Y'); @endphp
                      <div class="col-sm-12">
                        <div class="form-group">
                              <label for="mobile_no" class="col-sm-3 control-label"> year</label>
                              <div class="col-sm-12">
                                <select class="form-control" id="year" name="year" required>
                                    <option class="" value="0" selected>--Select --</option>
                                    @php for($i = 2000 ; $i < 2050; $i++){  @endphp              
                                      <option value="{{ $i }}" @if( $currentYear == $i  ) selected @endif >{{ $i }}</option>
                                    @php } @endphp
                                  </select>
                                </div> 
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
  
  
        // $('#class_id').click(function(){
        //       var userid =$(this).find('option:selected').val();
        //       if(userid > 0){
        //         // AJAX POST request
        //         $.ajax({
        //           url: 'getUserbyid',
        //           type: 'post',
        //           data: {_token: CSRF_TOKEN, userid: userid},
        //           dataType: 'json',
        //           success: function(response){
        //             $("#rep_all").html(response);             
        //           }
        //         });
        //       }
        //    });
        $('#classId').click(function(){
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
                  "<input type='hidden' name='sid[]' value="+sid +" ><td align='center'><input type='text' class='form-control' id='marks' name='marks[]' placeholder='Enter Marks ' value='' required=''></td><td align='center'><input type='text' class='form-control' id='day' name='day[]' placeholder='Enter Atten. Day ' value='' required=''></td></tr>";
  
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