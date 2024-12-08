@extends('layouts.master')
@section('content')

<div class="row mx-1">  

 <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark " >
    @foreach ($sidemenu as $nsidemenu)  <div class=" ps-2">
    <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href="/allacademic/{{$nsidemenu->id}}/{{$nsidemenu->type}}" >{{$nsidemenu->title}}</a> <hr>  </div> @endforeach 

</div>
   <div class="col-md-9  col-sm-9  border p-0 m-0 ">
<section id="master" class=" bg-white "  >
 
  
  

<div class="row " >
           <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title p-3 text-center">
              <h2>{{$academic->title}}</h2>
             
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                   <div class="card-box table-responsive">
 <div class="text-center" ><img class="pe-2 img-thumbnail border border-5 border-success" src="{{asset($academic->details)}}" alt=""></div>

              


          
            </div>
          </div>
        </div>
      </div>
</div></div></div>
       </section></div> </div> 
 @endsection
 