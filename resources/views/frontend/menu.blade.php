
@extends('layouts.master')
@section('content')

  <!-- About Start -->
    <div class=" py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset('public/Menu/'.$tmenu->image)}} "   alt="" style="object-fit: cover;">
                    </div>
                </div>  
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">{{$tmenu->title}} </h6>
                 
                    <p class="mb-4">{!!$tmenu->description!!} </p>
                
                   
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
   @endsection