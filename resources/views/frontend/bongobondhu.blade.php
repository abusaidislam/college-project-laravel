
@extends('layouts.master')
@section('content')
<div class=" bg-white">


<div class="row mx-1">

 <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark " >
    @foreach ($allbangabandhu as $nallbangabandhu)  <div class=" ps-2">
    <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href=" {{$nallbangabandhu->id}}">{{$nallbangabandhu->title}}</a><hr>  </div> @endforeach 

</div>


<div class="col-md-9 col-sm-8">

  <div class="row card">

              


<h5 class="text-center pt-2 pb-5">{{$bangabandhu->title}}</h5>

<p class="text-dark text-center"><img src="{{asset('public/Bangabandhu/'.$bangabandhu->image)}}" alt="" style="width: 500px; text-align: center; height: 200px;margin-right:15px; ">{!!$bangabandhu->description!!}</p>


    </div>
</div>







</div>
</div>
    @endsection
 