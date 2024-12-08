<!DOCTYPE html>
<html lang="en">
<head>
 
@extends('layouts.master')
@section('content')
        
<div class="ScriptTop">
    <div class="rt-container">
        <div class="col-rt-4" id="float-right">
 
            <!-- Ad Here -->
            
        </div>
       
    </div>
</div>

<header class="ScriptHeader">
    <div class="rt-container">
        <div class="col-rt-12">
            <div class="rt-heading px-5">
                <h1>Vice-Principal Information</h1>
               
            </div>
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="{{asset('viceprincipal/'.$p1->photo)}}" >
            <h3></h3>
          </div>
          <div class="card-body row">

            <p class="mb-0 px-5"><strong class="pr-1">Name : {{$p1->name}}</strong></p>
            <p class="mb-0 px-5"><strong class="pr-1">Designation : {{$p1->designation}}</strong></p>
            <p class="mb-0 px-5"><strong class="pr-1">Department : {{$p1->department}}</strong></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-headerp bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Email :</th>
              
                <td>{{$p1->email}}</td>
              </tr>
              <tr>
                <th width="30%">BCS_Batch : </th>
               
                <td>{{$p1->bcs_batch}}th</td>
              </tr>
              <tr>
                <th width="30%">Mobile No :</th>
                
                <td>{{$p1->mobile_no}} </td>
              </tr>
              <tr>
                <th width="30%">Home District :</th>
             
                <td>{{$p1->home_dis}}</td>
              </tr>
              <tr>
                <th width="30%">Blood :</th>
               
                <td>@switch($p1->blood_group)
                            @case($p1->blood_group==1)
                            <span >O positive</span>
                                @break
                                @case($p1->blood_group==2)
                                <span >O negative</span>
                                @break
                                @case($p1->blood_group==3)
                                <span >A positive</span>
                                    @break
                                    @case($p1->blood_group==4)
                                    A negative
                                    @break
                                    @case($p1->blood_group==5)
                                    B positive
                                        @break
                                        @case($p1->blood_group==6)
                                        B negative
                                        @break
                                        @case($p1->blood_group==7)
                                        AB positive
                                        @break
                                        @case($p1->blood_group==8)
                                        AB negative
                                        @break
                        @endswitch
</td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Posting Information</h3>
          </div>
          <div class="card-body pt-0">
             <table class="table table-bordered">
             <tr>
               <th width="50%">Name of College</th>
               <th width="30%">Designation </th>
               <th width="20%">From Date</th>
               <th width="20%">To Date</th>

                
              </tr>
            @foreach ($p2 as $pdetails)    <tr>
               
               <td>{{$pdetails->name}}</td>
                <td>{{$pdetails->designation}}</td>
                 <td>{{$pdetails->from}} </td>
                  <td>{{$pdetails->to}}</td>
              </tr>
           
             
                
               
              
                
             
               
              @endforeach</table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
           
            </div>
        </div>
    </div>
</section>
     
 @endsection
 