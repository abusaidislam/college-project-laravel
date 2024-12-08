 <meta name="_token" content="{{ csrf_token() }}">
@extends('layouts.master')
@section('content')

  
   <section id="" class=" bg-white  "  >
    <div class="row mx-1">  

 <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark " >
     @foreach ($alldata as $nalldata)  <div class=" ps-2">
    <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href="{{$nalldata->id}}" >{{$nalldata->title}}</a> <hr>  </div>

     @endforeach 

</div>

<div class="col-md-9 col-sm-8">

  <div class="row py-3">
  <div class="  text-start col-md-6 " ><h2>{{$data->title}}</h2></div>
   <div class=" text-end  col-md-6">

  <a  href="{{asset('public/forms/'.$data->file)}}" download class="btn btn-info ">
          <span class="glyphicon glyphicon-download"></span> Download
        </a>  </div>
    </div>
        <div class="row text-center card">
  <iframe  src ="{{ asset('public/forms/'.$data->file) }}" width="800px" height="500px"></iframe>
</div>

</div></div>

          </div>
       
      
        </section> 
      




    @endsection
 