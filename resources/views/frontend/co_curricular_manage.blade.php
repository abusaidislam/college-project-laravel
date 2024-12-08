@extends('layouts.master')
@section('content')
    <!-- About Start -->
    <div class=" py-5 bg-white">
        <div class="">
            @foreach ($CoCurricular as $item)
                @php
                    $data = DB::table('co_curricular_manages')
                        ->where('co_id', $item->id)
                        ->first();
                @endphp

                <div class="row">
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="img-fluid position-absolute w-100 h-100"
                                src="{{ asset('public/coteacher/' . $data->photo) }} " alt=""
                                style="object-fit: cover;">

                        </div>
                    </div>
                    <div class="col-md-6 text-justify">
                        <div class="text pl-md-12">
                            <div class="row bo ">
                                <div class="col-lg-1 col-sm-2  event-teaser text-right">
                                    <div class=" event--content">
                                        <div class="  col event--date-box">
                                            <div>{{ date('M', strtotime($data->date)) }} <div class="event--day nowrap">
                                                    {{ date('d', strtotime($data->date)) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-5 pt-3 event--info">

                                    <div class="event--details">
                                        <div class="event--times"><i class="fas fa-clock"></i>
                                            {{ $data->time }}</div>

                                    </div>
                                </div>
                            </div>
                            <h2><a href="#">{{ $item->name }}</a></h2>
                            <p style="font-size:15px;">{!! $data->details !!} </p>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- About End -->
@endsection
