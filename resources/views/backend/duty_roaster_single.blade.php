
@extends('layouts.examapp')
@section('content')
<div class="right_col" role="main">
<a href="{{url('examdutyroaster')}}"><button class="btn btn-primary">Back</button></a>
    <style>
        .card1 {
          box-shadow: 0 4px 8px 10px rgba(236, 51, 138, 0.2);
          transition: 0.3s;
          width: 30%;
          margin-top: 120px;
          margin-left: 400px;
          justify-items: center;
          color: black;

        }
        
        .card1:hover {
          box-shadow: 0 8px 16px 2px rgba(255, 83, 83, 0.2);
        }
        
        .container1 {
          margin: auto;
          padding: 20px;
          margin-bottom: 150px;
          text-align: center;
          /* background-color: rgb(102, 99, 99) */
        }
        .container1 p{
         margin-bottom: 2px;
         font-size: 15px;
        }

        </style>

    <div class="card1">
        <div class="container1">
          <h4><strong>Duty Roaster</strong></h4> 
          <h5><strong>{{$dutyroaster_sigle->exam_name}}</strong></h5> 
          <p> Name: {{$dutyroaster_sigle->name}}</p>
          <p> Designation: {{$dutyroaster_sigle->designation}}</p>            
          <p> Department: {{$dutyroaster_sigle->department}}</p>            
          <p> Duty Date: {{$dutyroaster_sigle->duty_date}}</p> 
          <p> Duty time: {{$dutyroaster_sigle->duty_time}}</p>           
        
        </div>
</div>







         

       
   
     
@endsection
