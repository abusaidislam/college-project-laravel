
@extends('layouts.master')
@section('content')

  <!-- About Start -->
    <div class=" py-5 bg-white">
        <div class="container" style="min-height: 500px;" >
            <div class="row">
                <div class="p-4 col-lg-6 col-md-6 col-sm-12 bg-info" style="margin: 0 auto;  box-shadow: 5px 5px 30px black; border-radius: 10px">
                    <form method="POST" action="{{ url('admission') }}"
                            id="myForm" enctype="multipart/form-data">
                            @csrf()
                            <input type="hidden" name="id" id="id">
                            <h3 class="text-center">Student Registration Form</h3><hr>
                                <div class="form-group mt-3">
                                    <label for="department_id" class="col-sm-12 control-label"> Department Name :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="department_id" 
                                            name="department_id"required>
                                            <option class="" value="" selected>--Choose One--</option>
                                            @foreach ($department as $item)
                                                <option value="{{ $item->id }}" {{ old('department_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                            <option value="40" {{ old('department_id') == '40' ? 'selected' : '' }}>{{ $genarelDepart->name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                {{-- General Deparment user Id 17 this id Department Id 17 mathch so new value 40 fiexd --}}
                                <div class="form-group mt-3">
                                    <label for="class" class="col-sm-12 control-label">Class Name :</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" id="class" name="class" required >
                                            <option class="" value="" selected>--Select --</option>
                                            @foreach ($className as $item)
                                                <option class="" value="{{ $item->id }}" {{ old('class') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                            @foreach ($degreeclassName as $item)
                                                <option class="" value="{{ $item->id }}" {{ old('class') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                        <label for="sname" class="form-label">Student Name:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{ old('sname') }}" id="sname" placeholder="Enter Student Name" name="sname" required>
                                        @error('sname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="session" class="col-sm-12">Session</label>
                                    <div class="col-sm-12">
                                        <select class="form-control sessionselect" id="session" 
                                            name="session" required>
                                            <option class="" value="{{ old('session') }}" selected>--Select --</option>
                                        </select>
                                        @error('session')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="roll" class="col-sm-12 control-label">Roll :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="roll" name="roll" value="{{ old('roll') }}"
                                            placeholder="Student Roll" required>
                                        @error('roll')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="home_dis" class="col-sm-12 control-label">Registration</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="registration"
                                            name="registration" placeholder="Enter To Registration" value="{{ old('registration') }}" required>
                                        @error('registration')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="mb-3 mt-3">
                                  <label for="uname" class="form-label">Username:</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" id="uname" placeholder="Enter Username" value="{{ old('uname') }}" name="uname" required>
                                     @error('uname')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                  </div>
                                </div>
 
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">Password:</label>
                                    <div class="password-container">
                                      <input type="password" class="form-control" id="password" value="{{ old('password') }}"  onfocus="this.placeholder = ''" placeholder="Enter password" name="password" required>
                                      <span class="" id="toggle-password">
                                          <i class="fa fa-eye-slash" aria-hidden="true" style="float: right; margin-right: 10px; margin-top: -27px; position: relative; z-index: 2; color:#909790;"></i>
                                      </span>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                  </div>
                                  
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-dark" id="saveBtn">Submit</button>
                                    <span class="input-group-btn">
                                        <a class="btn btn-success" href="{{url('admission')}}">Login</a>
                                    </span>
                                </div>
                        </form>
                </div> 
            </div>
     
        </div>
  
    </div>
    <!-- About End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

        $('#createNew').click(function() {
            $('#ajaxModel').modal('show');
            $('#modelHeading').html("Create New");
            $('#dform').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');


        });
       
        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });

            $('#class').on('change', function() {
                var id = $(this).val();
                var depart_id = $('#department_id').val();
                if (id) {
                    $.ajax({
                        url: 'admission_departinfo/' + id + '/' + depart_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#session').empty();
                            $('#session').append('<option value="">--Select--</option>');
                            $.each(data, function(key, value) {
                                if (value.session) {
                                    $('#session').append('<option  data="' + value
                                        .studentclass + '/' + value.session +
                                        '"value="' + value
                                        .session + '">' + value.session +
                                        '</option>');
                                } else if (value.session_year) {
                                    $('#session').append('<option data="' + value
                                        .class_id + '/' + value.session_year +
                                        '" value="' + value
                                        .session_year + '">' + value.session_year +
                                        '</option>');
                                }
                            });
                            // $('#session').trigger('change');
                        }

                    });
                }
            });
            $(document).ready(function() {
                $('.sessionselect').select2({
                    placeholder: "--Select--",
                    allowClear: true,
                    width: '100%'
                });
        
        });
        
        });
       
        $(document).ready(function() {
        $("#toggle-password").click(function() {
            var passwordField = $("#password");
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });

    </script>
   @endsection