<!DOCTYPE html>
<html lang="en">
<head>
 
@extends('layouts.master')
@section('content')
<section id="master" class="container master bg-white allfont"  >
 <div class=" ">
<div class="row pt-3 " >  <div class="col-sm-4 text-end"><h3 class="allfont" >Teachers  </h3></div>
      <div class="col-sm-4 text-start pt-2 fonts">  
       <select id='sel_principal' name='name'>
           <option value='0'>-- Select --</option>
             @foreach ($data as $ndata)
  <option  value="{{$ndata->id}}">{{$ndata->name}}</option>
       @endforeach 
</select></div>
    
</div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">


              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">

                       <th>SL</th>
                        <th>Name</th>
                      
                        <th>Designation</th>
                      
                        <th>Department</th>
                          <th>BCS_Batch</th>
                        <th>Mobile No.</th>
                          <th>Email</th>
                        <th>Home District</th>
                       
                </thead>
                <tbody >@php ($i=1)
@foreach ($data as $ndata)
                        <tr class="text-center">
                        <td>{{$i++}}</td>
                        <td>{{$ndata->name}}</td>
                        
                        <td>{{$ndata->designation}}  </td>
                       
                        <td>{{$ndata->department}}  </td>
                         <td>{{$ndata->bcs_batch}}  </td>
                        <td>{{$ndata->mobile_no}}  </td>
                        <td>{{$ndata->email}}  </td>
                           <td>{{$ndata->home_dis}}  </td>
                        


                        </tr>
  @endforeach
                </tbody>
              </table>


          
            </div>
          </div>
        </div>
      </div>

        </section>
 @endsection
 