@extends('layouts.drexamapp')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow">
                    <div class="inner">
                         <h3>{{$ExamCommittees ?? ""}}</h3>
                        <p>Committee  Member </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{url('examcommittee')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow">
                    <div class="inner">
                         <h3>{{$RoomNo ?? ""}}</h3>
                        <p>Room Number</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-solid fa-home"></i>
                    </div>
                    <a href="{{url('exam-room_no')}}" class="small-box-footer">
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
                         <h3>{{$ExamRoomwiseMasterDutyRoster?? ""}}</h3>
                        <p>Invigilator</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-solid fa-users"></i>
                    </div>
                    <a href="{{url('room-wise-master-duty')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning shadow">
                    <div class="inner">
                        <h3>{{$ExamMasterDutyRoster ?? ""}}</h3>
                        <p>Vigilance Team</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-solid fa-users"></i>
                    </div>
                    <a href="{{url('exam_setupplan')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
     
    </div><!-- /.container-fluid -->
</div>
@endsection
