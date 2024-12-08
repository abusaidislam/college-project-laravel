@extends('layouts.sportsapp')
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info shadow">
                  <div class="inner">
                       <h3>{{$SportsTeacher ?? ""}}</h3>
                      <p>Sports Teachers </p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-users"></i>
                  </div>
                  <a href="{{url('sportsteacherlist')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
              <div class="small-box bg-success shadow">
                  <div class="inner">
                       <h3>{{$Champion ?? ""}}</h3>
                      <p>Champions List</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-user-graduate"></i>
                  </div>
                  <a href="{{url('schampionslist')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
       
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-danger shadow">
                  <div class="inner">
                       <h3>{{$SNotice ?? ""}}</h3>
                      <p>Sports Notice</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-file"></i>
                  </div>
                  <a href="{{url('snoticelist')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
      </div>
   
  </div><!-- /.container-fluid -->
</div>
  @endsection
