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
              <h2>Result Information</h2>
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
                        <th>S.L</th>
                        <th>Year<br>of Exam</th>
                        <th>Class Name</th>
                        <th>Total<br>Seat</th>
                        <th>Total<br>Examinees</th>
                        @php
                        $data = [3.50,3.00,2.50,2.00];
                        @endphp
                        @foreach ($data as $v)
                            <th>>={{$v}}</th>
                        @endforeach
                        <th>Total<br>Pass</th>
                        <th>Total<br>Fail</th>
                        <th>%<br>Pass</th>
                        <th>%<br>Fail</th>
                        <th>Download<br>(PDF,Excel)</th>  
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody id="list">
                    {{-- @foreach ($CourseInfo as $dd )
                        <h1>{{$dd->id}}</h1>
                        @dd($CourseInfo);
                    @endforeach --}}
                    @foreach ($dep_result_info->pluck('years')->unique() as $year)
                    @foreach ($student_class as $class)
                        @php
                             $depart_id    = Session::get('depart_id');    
                             $seat  = DB::table('seat_plans')->where('depart_id',$depart_id)->where('year',$year)->where('class_id',$class->id)->get();             
                             $studentinfo  = DB::table('student_results')->where('depart_id',$depart_id)->where('years',$year)->where('class_id',$class->id)->pluck('student_id')->unique();             
                         
                       @endphp
                      <tr>
                          <td>1</td>
                          <td>{{ $year }}</td>
                          <td>{{$class->name}}</td>
                          <td>{{count($seat)}}</td>
                          <td>{{count($studentinfo) }}</td>  

                                    @php
                                        $stud = DB::table('student_results')
                                            ->where('depart_id', $depart_id)
                                            ->where('years', $year)
                                            ->where('class_id', $class->id)
                                            ->pluck('student_id')->unique();
                                     
                                       $gpaarray = [];       
                                    @endphp
                                    {{-- @dd($stud); --}}
                                @foreach ($stud as $st)
                                                @php
                                                    $totalGpSum = 0;
                                                    $totalCreditSum = 0;
                                                    $hasFail = false; 
                                                @endphp
                                            @foreach ($CourseInfo as $item)
                                                @php
                                                $studen = DB::table('student_results')
                                                    ->where('student_id', $st)
                                                    ->where('subject', $item->id)
                                                    ->first();
                                                    // @dd($studen);
                                                    if ($studen !== null) {
                                                        $marks = $studen->marks;
                                                    $gradPoint = $studen->marks;
                                                    $gp = '';
                                                    if ($gradPoint >= 80) {
                                                        $gp = 4.0;
                                                    } elseif ($gradPoint >= 75) {
                                                        $gp = 3.75;
                                                    } elseif ($gradPoint >= 70) {
                                                        $gp = 3.5;
                                                    } elseif ($gradPoint >= 65) {
                                                        $gp = 3.25;
                                                    } elseif ($gradPoint >= 60) {
                                                        $gp = 3.0;
                                                    } elseif ($gradPoint >= 55) {
                                                        $gp = 2.75;
                                                    } elseif ($gradPoint >= 50) {
                                                        $gp = 2.5;
                                                    } elseif ($gradPoint >= 45) {
                                                        $gp = 2.25;
                                                    } elseif ($gradPoint >= 40) {
                                                        $gp = 2.0;
                                                    } else {
                                                        $gp = 0.0;
                                                        $hasFail = true;
                                                    }
                                                    
                                                    $gpsum = $gp * $item->credit;
                                                    $totalGpSum += $gpsum;
                                                    $totalCreditSum += $item->credit;

                                                    if ($hasFail) {
                                                    $gpa = 0;
                                                        } else {
                                                            $gpa = $totalGpSum / $totalCreditSum;
                                                        }
                                                    
} else {
    $gp = 0.0;  // Handle the case when marks record doesn't exist
}
                                                   
                                                @endphp
                                            @endforeach   
                                    {{-- <strong>{{number_format($gpa, 2)}}</strong><br> --}}
                                        @php
                                            
                                            $gpaarray[] = number_format($gpa, 2)
                                        @endphp
                                    
                                        
                                @endforeach
                              
          @php
      
          $counts = [0, 0, 0, 0];
      
          foreach ($gpaarray as $gpa) {
              if ($gpa >= 3.5) {
                  $counts[0]++;
              } elseif ($gpa >= 3) {
                  $counts[1]++;
              } elseif ($gpa >= 2.5) {
                  $counts[2]++;
              } elseif ($gpa >= 2) {
                  $counts[3]++;
              } else {
                  
              }
          }
      @endphp
                             @foreach ($counts as $count)
                             <td>{{ $count }}</td>
                              @endforeach


                            @foreach ($data as $item)
                               
                                {{-- <td> --}}
                                @php
                                $passCount = collect($gpaarray)->filter(function ($value) use ($item) {
                                    return $value >= $item;
                                })->count();
                                
                                $failCount = collect($gpaarray)->filter(function ($value) use ($item) {
                                    return $value < $item;
                                })->count();
                                @endphp  
                                   {{-- {{$passCount}} --}}
                                   {{-- {{$passCount}}-{{$failCount}} --}}
                                                           
                                {{-- </td> --}}
                            @endforeach
                          <td>{{$passCount}} </td>
                          <td>{{$failCount}} </td>
                          <td>{{ count($studentinfo) > 0 ? round(($passCount / count($studentinfo)) * 100, 2) : 0 }}%</td>
                          <td>{{ count($studentinfo) > 0 ? round(($failCount / count($studentinfo)) * 100, 2) : 0 }}%</td>
                          <td>1</td>
                          <td>1</td>
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
                    <form method="POST" id="form" name="form" class="form-horizontal" action="{{ route('departmentresult.store') }}"  enctype="multipart/form-data">
                        @csrf()
                            <input type="hidden" name="id" id="id">
                    
                        @php $currentYear =  date('Y'); @endphp
                          <div class="form-group">
                                <label for="mobile_no" class="col-sm-12 control-label"> Year</label>
                            <div class="col-sm-12">
                                  <select class="form-control" id="year" name="year" required>
                                      <option class="" value="0" selected>--Select --</option>
                                      @php for($i = 2000 ; $i < 2050; $i++){  @endphp              
                                        <option value="{{ $i }}" @if( $currentYear == $i  ) selected @endif >{{ $i }}</option>
                                      @php } @endphp
                                    </select>
                            </div>                        
                        </div>
                        <div class="form-group">
                            <label for="depart_id " class="col-sm-12 control-label">Department Name:</label>
                            <div class="col-sm-12">

                                <select class="form-control" id="depart_id" name="depart_id" >
                                    {{-- @foreach ($department as $ndata) 
                                            <option value="{{$ndata->id}}">{{$ndata->name}}</option> 
                                     @endforeach --}}
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="total_seat " class="col-sm-12 control-label">Result</label>
                            <div class="col-sm-12">

                                <select class="form-control" id="total_seat" name="total_seat" >
                                    {{-- @foreach ($Studentresult as $ndata) 
                                            <option value="{{$ndata->years}}">{{$ndata->years}}</option> 
                                     @endforeach --}}
                                </select>
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
             $.get("{{ route('departmentresult.index') }}" +'/' + id +'/edit', function (data) {
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#ajaxModel').modal('show');
                 $('#id').val(data.id);
                 $('#year').val(data.year);
                 $('#depart_id').val(data.depart_id);
                 $('#total_seat').val(data.total_seat);
    
             })
        });

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
                   url:'departmentresult/'+id ,
                   success: function (data) {
                       window.location='departmentresult'
                   }

               });}
    return false;
             
              
           });
$('#closemodal').click(function() {
    $('#ajaxModel').modal('hide');
});





</script>

@endsection
