<!DOCTYPE html>
<html lang="en">
<head>
 
@extends('layouts.master')
@section('content')
<div class=" bg-white">
<div class="row ">
    
<div class="col-md-4">  
    
  <div class="text-center" ><img class="border  p-1 mx-auto mb-3"   src="{{asset('public/Message/'.$pmassage->photo)}}" alt="" style=" height: 300px; width: 300px;"></div>
</div>
<div class="col-md-8">  
  <p class="text-uppercase py-5  text-dark" style="font-size: 30px; font-family: serif, sans-serif ; ">  
<b > {{$pmassage->name}}</b></br>
 <b>{{$pmassage->designation}}</b></p>
</div>
</div>
<div class="row p-2 ">
<div class="col-md-12 col-sm-12">  
  <p class="">  
 {!!$pmassage->details!!}</p>
</div>


</div>
</div>

    @endsection
 