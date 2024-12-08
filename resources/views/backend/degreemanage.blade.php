@extends('layouts.degreeapp')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow">
                    <div class="inner">
                        <h3>{{$DegreeTeacher ?? ""}}</h3>
                        <p>Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{url('degree-teacher')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow">
                    <div class="inner">
                        <h3>{{$DegreeFirstYearStudent ?? ""}}</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-solid fa-user-graduate"></i>
                    </div>
                    <a href="{{url('degree-first-year-sudetnts')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning shadow">
                    <div class="inner">
                        <h3>{{$DegreeStaff ?? ""}}</h3>
                        <p>Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{url('degree_staff')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger shadow">
                    <div class="inner">
                        <h3>{{$DegreeNotice ?? ""}}</h3>
                        <p>Department Notice</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-solid fa-file"></i>
                    </div>
                    <a href="{{url('degree-notice')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

    </div><!-- /.container-fluid -->
</div>
@endsection
