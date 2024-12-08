 <meta name="_token" content="{{ csrf_token() }}">
@extends('layouts.master')
@section('content')

  
   <section id="" class=" bg-white  "  >
    <div class="row mx-1">  

 <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark " >
     @foreach ($alldata as $nalldata)  <div class=" ps-2">
    <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href="{{$nalldata->id}}" >{{$nalldata->title}}</a> <hr>  </div> @endforeach 

</div>

<div class="col-md-8 col-sm-8">

  <div class="row card">
  <div class="text-center" ><h2>{{$data->title}}</h2></div>
  <iframe src ="{{ asset('forms/'.$data->file) }}" width="750px" height="500px"></iframe>
</div>

</div>

          </div>
       
      
        </section> 
      




    @endsection
 