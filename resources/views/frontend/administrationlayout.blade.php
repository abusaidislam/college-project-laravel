 <meta name="_token" content="{{ csrf_token() }}">
@extends('layouts.master')
@section('content')

  
   <section id="" class=" bg-white  "  >
    <div class="row mx-1">  

 <div class=" col-md-3   col-sm-6 pt-2 p-0 m-0 pb-5  bg-dark " >
    @foreach ($sidemenu as $nsidemenu)  <div class=" ps-2">
    <i class="fa fa-angle-right"style="color:#ffffff; font-size:20px;"></i>   <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href="{{url('/'.$nsidemenu->subroute)}}" >{{$nsidemenu->sub_title}}</a> <hr>  </div> @endforeach 

</div>
@yield('administrationcontent')



 @endsection