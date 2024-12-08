@extends('layouts.adapp')
@section('content')
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info shadow">
                  <div class="inner">
                      <h3>{{$Principal ?? ""}}</h3>
                      <p>Principal</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-user"></i>
                  </div>
                  <a href="{{url('principaleinfo')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-success shadow">
                  <div class="inner">
                      <h3>{{$Viceprincipal ?? ""}}</h3>
                      <p>Vice Principal</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-user"></i>
                  </div>
                  <a href="{{url('viceprincipalinfo')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-warning shadow">
                  <div class="inner">
                      <h3>{{$TeacherCouncil?? ""}}</h3>
                      <p>Teachers Council</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-users"></i>
                  </div>
                  <a href="{{url('teachercouncil')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-danger shadow">
                  <div class="inner">
                      <h3>{{$AcademinCouncil ?? ""}}</h3>
                      <p>Academic Council</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-solid fa-school"></i>
                  </div>
                  <a href="{{url('academiccouncils')}}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
          <!-- ./col -->
      </div>
   
  </div><!-- /.container-fluid -->
</div>
  </div>@endsection
