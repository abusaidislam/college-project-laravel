<!DOCTYPE html>
<html lang="en">
<head>
 
@extends('layouts.master')
@section('content')
<div class=" bg-white">


<div class="row mx-1">

  <div class="col-md-4 card pt-3  bg-dark" >
   @foreach ($allevent as $ndata)<div class=" p-1">
            <i class="fa fa-caret-right"style="color:#089647; font-size:15px;"></i><a class="text-light fw-bold" style="font-size:15px; font-family: Times new roman;   " href=" {{$ndata->id}}">{{$ndata->title}}</a>
</div>
             
              @endforeach
           </div>


<div class="col-md-8">

  <div class="row card ">

              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead style="color:#004000">
                    <tr>
                       
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Place</th>
                        
                       
                    </tr>
                </thead>
                <tbody >
                  
                        <tr text-dark>
                          
                        <td>{{$event->title}}</td>
                        <td>{{$event->date}}  </td>
                         <td>{{$event->time}}  </td>
                        <td>{{$event->place}}  </td>
                       
                       
                       

                        </tr>
                  
                </tbody>
              </table>


<p class="text-dark " style="height:300px;" >{{$event->details}}

</p>


    </div>
</div>






</div>
</div>
    @endsection
 