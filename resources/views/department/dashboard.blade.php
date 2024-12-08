@extends('layouts.department')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow">
                    <div class="inner">
                        <h3>{{$Teacher ?? ""}}</h3>
                        <p>Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{url('department-teacher')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow">
                    <div class="inner">
                        <h3>{{$Student ?? ""}}</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-solid fa-user-graduate"></i>
                    </div>
                    <a href="{{url('honours-first-year-students')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning shadow">
                    <div class="inner">
                        <h3>{{$Staff ?? ""}}</h3>
                        <p>Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{url('department_staff')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger shadow">
                    <div class="inner">
                        <h3>{{$DepartmentNotice ?? ""}}</h3>
                        <p>Department Notice</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-solid fa-file"></i>
                    </div>
                    <a href="{{url('department-notice')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning shadow">
                    <div class="inner">
                        <h3>{{$SeminarBookStock ?? ""}}</h3>
                        <p>Seminar Boot Stocks</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{url('seminar-book-stock')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger shadow">
                    <div class="inner">
                        <h3>{{$SeminarNotice ?? ""}}</h3>
                        <p>Seminar Notice</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-solid fa-file"></i>
                    </div>
                    <a href="{{url('seminar_notice')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div><!-- /.container-fluid -->
</div>
@endsection