@extends('layouts.degreeapp')
@section('title', 'Degree Course Fee |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>Degree Course Fee Information</h2>
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
                                              <th>Class Name</th>
                                              <th>Session</th> 
                                              <th>Course Code</th> 
                                              <th>Fee Amount</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody id="list">
                                          @php
                                          $classSessionTotal = [];
                                      @endphp
                                      
                                      @foreach ($data as $ndata)
                                          <?php
                                              $classId = $ndata->class_id;
                                              $session = $ndata->session;
                                              $className = DB::table('degree_classes')->where('id', $classId)->value('name');
                                              $courseCode = DB::table('degree_courses')->where('id', $ndata->course_id)->first();
                                              
                                              if (!isset($classSessionTotal[$classId])) {
                                                  $classSessionTotal[$classId] = [];
                                              }
                                              if (!isset($classSessionTotal[$classId][$session])) {
                                                  $classSessionTotal[$classId][$session] = 0;
                                              }
                                              $classSessionTotal[$classId][$session] += $ndata->fee_amount;
                                          ?>
                                          <tr>
                                              <td>{{ $className }}</td>
                                              <td>{{ $ndata->session }}</td>
                                              <td>{{ $courseCode ? $courseCode->course_code : '' }}</td>
                                              <td>{{ $ndata->fee_amount }} Tk</td>
                                              <td>
                                                  <button type="button" id="edit" data-id="{{ $ndata->id }}" class="btn btn-sm btn-info">Edit</button>
                                                  <button type="button" id="delete" data-id="{{ $ndata->id }}" class="btn btn-sm btn-danger">Delete</button>
                                              </td>
                                          </tr>
                                      @endforeach
                                      
                                      @foreach ($classSessionTotal as $classId => $sessions)
                                          @foreach ($sessions as $session => $totalAmount)
                                              <tr class="bg-success">
                                                  <td>{{ DB::table('degree_classes')->where('id', $classId)->value('name') }}</td>
                                                  <td>{{ $session }}</td>
                                                  <td></td>
                                                  <td>Total Amount = {{ $totalAmount }} Tk</td>
                                                  <td></td>
                                              </tr>
                                          @endforeach
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
                                      action="{{ route('degree-course-fee.store') }}" enctype="multipart/form-data">
                                      @csrf()
                                      <input type="hidden" name="id" id="id">
                                      <div class="form-group">
                                          <label for="class_id " class="col-sm-12 control-label">Class Name</label>
                                          <div class="col-sm-12">
                                              <select class="form-control" id="class_id" name="class_id" required>
                                                  <option class="" value="" selected>--Choose One--</option>
                                                  @foreach ($classname as $nclassname)
                                                      <option value="{{ $nclassname->id }}">{{ $nclassname->name }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                              @error('class_id')
                                                  <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="session" class="col-sm-12 control-label">Session</label>
                                          <div class="col-sm-12">
                                          <select class="form-control session" id="session"
                                              name="session" required>
                                              <option class="" value="0" selected>--Choose One--</option>
                                          </select>
                                      </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="course_id " class="col-sm-12 control-label">Course Code</label>
                                          <div class="col-sm-12">
                                              <select class="form-control" id="course_id" name="course_id" required>
                                                  <option class="" value="" selected>--Choose One--</option>
                                                 
                                              </select>
                                          </div>
                                      </div>
                                     
                                      <div class="form-group">
                                          <label for="fee_amount" class="col-sm-12 control-label">Fee Amount</label>
                                          <div class="col-sm-12">
                                              <input type="number" class="form-control" id="fee_amount" name="fee_amount"
                                                  placeholder="Enter Fee Amount" value="" step="0.01" required>
                                              
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

          $.get("{{ route('degree-course-fee.index') }}" + '/' + id + '/edit', function(data) {
              $('#ajaxModel').modal('show');
              $('#modelHeading').html("Edit");
              $('#saveBtn').html('Update');
              $('#id').val(data.id);
              $('#class_id').val(data.class_id);
              $('#course_id').val(data.course_id);
              $('#fee_amount').val(data.fee_amount);
              $('#year').val(data.year);
              $.get("{{ route('degreegetcoursefeesession') }}", {
                      session: data.session,
                      class_id: data.class_id,
                      course_id: data.course_id,
                  }, function(accountData) {
                      if (accountData && accountData.sessions) {
                          $('#session').empty();
                          $('#session').append('<option selected value="' + accountData.sessions.session +
                              '">' + accountData.sessions.session + '</option>');
                      } else {
                          console.error("Error: No Session data found");
                      }
                      if (accountData && accountData.courseName) {
                          $('#course_id').empty();
                          $('#course_id').append('<option selected value="' + accountData.courseName.id +
                              '">' + accountData.courseName.course_code + '</option>');
                      } else {
                          console.error("Error: No Course Code data found");
                      }
                  }).fail(function(xhr, textStatus, errorThrown) {
                      console.error("Error:", errorThrown);
                  });

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
                      url: 'degree-course-fee/' + id,
                      success: function(data) {
                          window.location = 'degree-course-fee';
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


      $('#class_id').on('change', function() {
          var id = $(this).val();
          $.ajax({
              url: 'degree_coursefee_session/' + id,
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                  $('#session').empty();
                  $('#course_id').empty();
              
                  $.each(data.sessions, function(index, session) {
                      $('#session').append('<option value="' + session.session + '">' + session.session + '</option>');
                  });

                  $.each(data.courseName, function(index, course) {
                      $('#course_id').append('<option value="' + course.id + '">' + course.course_code + '</option>');
                  });
              }
          });
      });


      $('#closemodal').click(function() {
          $('#ajaxModel').modal('hide');
      });

      $(document).ready(function() {
          $('#session').select2({
              placeholder: "--Select--",
              allowClear: true,
              width: '100%'
          });
       

      });
  
  </script>
@endsection