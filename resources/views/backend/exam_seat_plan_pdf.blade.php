<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam-seat-plan-</title>
    <link rel="stylesheet" href="https:jquery.dataTables//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>

        .centerdesign{
            text-align: center
        }
        .centerdesign h3{
           color: black;
           text-shadow: 3px 8px 6px #b5a9a9c2;
           
        }
        .centerdesign p{
            margin-left: 281px;
            margin-top: -31px;
        }
        .tabledesign{
            border: 1px solid black;
           
        }
        .tabledesign tr td{
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="col-md-12 col-sm-12 ">
          {{-- <div class="x_title">
              <div class="centerdesign">
                  <h3>Govt. Saadat College</h3>
                  <h3>Karatia, Tangail</h3>
                  <h5>Honors First Year Examination-2021</h5>
                  <h4><strong>Seat Plan</strong></h4>
                 <p> Date:{{$seat_info->created_at}}</p>
                 <h4>Room:{{$room_num->title}}</h4>
              </div>
          </div> --}}

              <div class="row">
                 
                  @for ($i= 0; $i <= $room_details->total_row; $i++)
                    @if($i < $room_details->total_row)
                      @php
                           $skip = ($room_details->total_bench_per_col * $room_details->student_per_bench) * $i;                      
                          $seat_details = DB::table('seat_plans')->where('room_num',$room_details->id)->skip($skip)->take($room_details->total_bench_per_col)->orderBy('id', 'asc')->get();
                      @endphp
                      <div class="col-sm-2 d-flex justify-content-center">
                              <table class="table table-bordered" style="width:30%">
                                  <tbody>                                   
                                     
                                      @foreach ($seat_details as $v)
                                       @php
                                          $first   = $v->roll;
                                          $second = ($v->roll + $room_details->total_bench_per_col);
                                          $third  = ($v->roll + ($room_details->total_bench_per_col * 2));
                                          $second_col = DB::table('seat_plans')->where('room_num',$room_details->id)->where('roll',$second)->first();
                                          $third_col = DB::table('seat_plans')->where('room_num',$room_details->id)->where('roll',$third)->first();
                  
                                       @endphp
                                      <tr>
                                          @if($room_details->student_per_bench == 1)
                                              <td>{{ $first }}</td>
                                          @elseif ($room_details->student_per_bench == 2)     
                                              <td>{{ $first }}</td>
                                       
                                              @if (!empty($second_col))
                                                <td>{{ $v->roll + $room_details->total_bench_per_col }}</td>   
                                              @endif
                                              
                                          @elseif ($room_details->student_per_bench == 3)      
                                              <td>{{ $first }}</td>
                                         
                                              @if (!empty($second_col))
                                                <td>{{ $v->roll + $room_details->total_bench_per_col  }}</td>   
                                              @endif
                                              
                                              @if (!empty($third_col))
                                               <td>{{  $v->roll + ($room_details->total_bench_per_col * 2)  }}</td>   
                                              @endif
                                              
                                          @endif                 
                                      </tr>                                      
                                      @endforeach
                                       
                                  </tbody>
                              </table>
                          
                      </div>
                      @endif
                  @endfor

                  
              </div>    
    </div>

</body>
</html>