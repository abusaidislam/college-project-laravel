<!DOCTYPE html>
<html lang="en">
<head>
 
@extends('layouts.master')
@section('content')
<div class=" bg-white">
<div class="row ">
    
<div class="col-md-12">  
    
  <div class=" p-5 text-center" ><h2>{{$news->title}}</h2></div>
</div>

</div>
<div class="row   ">
<div class="col-md-12 ">  
  <p class="text-dark text-center">  
<iframe  class="text-center" src ="{{ asset('public/breaking_news/'.$news->photo) }}" width="1000px" height="600px"></iframe></p>
</div>


</div>
</div>

    @endsection
 