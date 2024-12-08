
@extends('layouts.master')
@section('content')

  <!-- About Start -->
    <div class=" py-5 bg-white">
        <div class="container bg-info" style="min-height: 500px; box-shadow: 5px 5px 30px black; border-radius: 10px" >
            @if(session('message'))
               <h1>{{ session('message') }}</h1>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12" style="margin: 0 auto">
                    <form method="POST" action="{{ url('form-fillUp-fee-store') }}"
                            id="myForm" enctype="multipart/form-data">
                            @csrf()
                            <input type="hidden" name="id" id="id"><br>
                            <h3 class="text-center">Form Fill-Up Fee Collection</h3><hr>
                            {{-- <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Department Name :</label>
                                <div class="col-sm-12">
                                   <input class="form-control" type="text" id="depart_id"  name="depart_id" data-id="{{$department->id}}" value="{{$department->name}}" readonly required>
                                </div>
                            </div> --}}
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Department Name :</label>
                                <div class="col-sm-12">
                                    <select class="form-control depart_id" id="depart_id"
                                        name="depart_id"required>
                                        <option class="" value="" selected>--Select --</option>
                                        @foreach ($department as $item)
                                            <option data-value="{{ $item->id }}" value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                        <option data-value="40" value="Department of General">{{ $genarelDepart->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="class_id" class="col-sm-12 control-label">Class Name :</label>
                                <div class="col-sm-12">
                                    <select class="form-control class_id" id="class_id" name="class_id" required>
                                        <option class="" value="" selected>--Choose One--</option>
                                        {{-- @foreach ($className as $item)
                                            <option class="" data-value="{{ $item->id }}" value="{{ $item->name }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                        @foreach ($degreeclassName as $item)
                                            <option class="" data-value="{{ $item->id }}" value="{{ $item->name }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
     
                            <div class="form-group">
                                <label for="session" class="col-sm-12 control-label">Session</label>
                                <div class="col-sm-12">
                                    <select class="form-control session p-2" id="session"
                                        name="session">
                                        <option class="" value="0" selected>--Select --</option>
                                    </select>
                                 </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="sname" class="form-label">Student Name:</label>
                                <input type="text" class="form-control" id="sname" placeholder="Student Name" name="sname" value="">
                              </div>
    
                          
                            <div class="form-group mt-3">
                                <label for="" class="col-sm-12 control-label">Roll :</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="roll" name="roll"
                                        placeholder="Student Roll " value="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="home_dis" class="col-sm-12 control-label">Registration</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="registration"
                                        name="registration" placeholder="Student Registration" value="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="regi_type" class="col-sm-12 control-label">Registration  Type :</label>
                                <div class="col-sm-12">
                                    <select class="form-control regi_type" id="regi_type" name="regi_type" required>
                                        <option class="" value="" selected>--Select --</option>
                                        <option class="" value="regular" >Regular Fee</option>
                                        <option class="" value="ir-regular-form-fillup" >Ir-Regular Form Fillup</option>
                                        <option class="" value="ir-regular-non-form-fillup" >Ir-Regular Non Form Fillup</option>
                                        <option class="" value="imporvement" >Imporvement Fee</option>
                                        <option class="" value="cpromoted" >Conditional Promoted Fee</option>
                                        <option class="" value="fail" >Fail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3 examtypehide">
                                <label for="exam_type" class="col-sm-12 control-label">Exam Type :</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="exam_type" name="exam_type" >
                                        <option class="" value="" selected>--Select --</option>
                                        <option class="" value="regular" >Practical Exam</option>
                                        <option class="" value="regular" >Non Practical Exam</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="course_code" class="col-sm-12 control-label">Course Code :</label>
                                <div class="col-sm-12">
                               
                                 <select class="form-control js-example-basic-multiple" id="course_code" name="course_code[]" multiple="multiple">
                 
                                </select>
                            
                            </div>
                           
                            <div class="form-group mt-3">
                                <label for="amount" class="col-sm-12 control-label">Total Amount (Tk)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control amount" id="amount"
                                        name="amount" placeholder="Total Amount" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="final_amount" class="col-sm-12 control-label">Final Amount (Tk)</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control final_amount" id="final_amount"
                                        name="final_amount" placeholder="Total Amount" required>
                                </div>
                            </div>
                            <button class="btn btn-info" id="proced_amount">Proced Amount</button>
                        <button type="submit" class="btn btn-success  mt-3">Submit</button>
                    </form><br>
                   
                </div> 
            </div>
        </div>
    </div>
    <!-- About End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
               })
               $('#depart_id').on('change', function() {
                var depart_id = $("#depart_id").find('option:selected').data('value');
                    if (depart_id) {
                        $.ajax({
                            url: 'admission_departInfo/' + depart_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#class_id').empty();
                                $('#class_id').append('<option value="">--Select--</option>');
                                $.each(data, function(key, value) {
                                    $('#class_id').append('<option data-id="' + value
                                        .id + 
                                        '"value="' + value.name + '">' + value.name + '</option>');
                                });
                            }
                        });
                    }
                });

               $('#class_id').on('change', function() {
                var id = $(this).find('option:selected').data('id');
                var depart_id = $("#depart_id").find('option:selected').data('value');
                if (depart_id) {
                    $.ajax({
                        url: 'admission_classInfo/' + id + '/' + depart_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
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


            $('#regi_type').on('change', function() {
                var typeValue = $(this).val();
                var departId = $("#depart_id").find('option:selected').data('value');
                var classId = $("#class_id").find('option:selected').data('id');
                
                if (typeValue) {
                    $.ajax({
                        url: 'regi_typeInfo/' + typeValue + '/' + departId + '/' + classId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var sum = data.sum;
                            var failAmount = data.failAmount;
                            var courseName = data.CourseName; 
                            if (failAmount == null) {
                                $(".amount").val(sum);  
                                $('#course_code').empty();
                                $('#course_code').append('<option value="select_all">Select All</option>');
                                $.each(courseName, function(index, course) {
                                        $('#course_code').append('<option value="' + course.course_code + '">' + course.course_code + '</option>');
                                    });

                            } else if(sum == null) {
                                $(".amount").val(failAmount);
                                $('#course_code').empty();
                                $('#course_code').append('<option value="select_all">Select All</option>');
                                    $.each(courseName, function(index, course) {
                                            $('#course_code').append('<option value="' + course.course_code + '">' + course.course_code + '</option>');
                                        });
                            }else{
                                $(".amount").val();  
                            }
                              
                   
                        }

                    });
                }
            });
       
            // $('#regi_type').on('change', function() {
            //     var typeValue = $(this).val();
            //     var departId = $("#depart_id").find('option:selected').data('value');
            //     var classId = $("#class_id").find('option:selected').data('id');
                
            //     if (typeValue) {
            //         $.ajax({
            //             url: 'regi_typeInfo/' + typeValue + '/' + departId + '/' + classId,
            //             type: 'GET',
            //             dataType: 'json',
            //             success: function(data) {
            //                 var sum = data.sum;
            //                 var failAmount = data.failAmount;
            //                 var courseName = data.CourseName; 
            //                 if (failAmount == null) {
            //                     $(".amount").val(sum);  
            //                     $('#course_code').empty();
            //                     $('#course_code').append('<option value="select_all">Select All</option>');
            //                     $.each(courseName, function(index, course) {
            //                             $('#course_code').append('<option value="' + course.course_code + '">' + course.course_code + '</option>');
            //                         });

            //                 } else if(sum == null) {
            //                     $(".amount").val(failAmount);
            //                     $('#course_code').empty();
            //                     $('#course_code').append('<option value="select_all">Select All</option>');
            //                         $.each(courseName, function(index, course) {
            //                                 $('#course_code').append('<option value="' + course.course_code + '">' + course.course_code + '</option>');
            //                             });
            //                 }else{
            //                     $(".amount").val();  
            //                 }
                              
                   
            //             }

            //         });
            //     }
            // });
       
            

        });
        $(document).ready(function() {
                // Initialize Select2
                $('.js-example-basic-multiple').select2();

                // Add an option to select all
                $('#course_code').append('<option value="select_all">Select All</option>');

                // Handle change event
                $('#course_code').on('change', function() {
                    var selectedValues = $(this).val();
                    
                    // If "Select All" is selected, select all other options
                    if (selectedValues && selectedValues.includes('select_all')) {
                        $(this).val($(this).find('option').not(':first').map(function() {
                            return this.value;
                        })).trigger('change');
                    }
                });
            });

        $(document).ready(function() {
            $('#session').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });




        });

        $(document).ready(function() {
    // Initialize Select2
    $('#course_code').select2();

    $('#proced_amount').on('click', function(event) {
        event.preventDefault(); // Prevent form submission
        
        var selectedCourses = $('#course_code').find(":selected").length;
        var defaultAmount = parseInt($('#amount').val());
        var total;

        if (selectedCourses > 1 ) {
            total = defaultAmount + (selectedCourses-1) * 250;
        } else {
            total = defaultAmount;
        }

        $('#final_amount').val(total);

        console.log("Selected Courses: ", selectedCourses);
        console.log("Default Amount: ", defaultAmount);
        console.log("Final Amount: ", total);
    });
});


$(document).ready(function() {
    // Initially hide the element
    $('.examtypehide').hide();

    // Handle the change event
    $('.regi_type').on('change', function() {
        var typeValue = $(this).val();
        if (typeValue == 'imporvement' || typeValue =='cpromoted') {
            $('.examtypehide').show();
        }
         else {
            $('.examtypehide').hide();
        }
    });
});

// $(document).ready(function() {
//     // Initialize Select2
//     $('#course_code').select2();

    
//     $('#proced_amount').on('click', function() {
//         var selectedCourses = $('#course_code').find(":selected").length;
//         var defaultAmount = parseInt($('#amount').val());
//         var finalAmount = parseInt($('#final_amount').val());

//         var total;

//         if (selectedCourses === 0) {
//             total = defaultAmount;
//         } else if (selectedCourses === 1) {
//             total = defaultAmount;
//         } else {
           
//             total = finalAmount + (selectedCourses - 1) * 250;
//         }

//         $('#final_amount').val(total);

//     });
// });




   </script>
   
    
   @endsection