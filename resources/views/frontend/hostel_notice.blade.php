@extends('layouts.master')
@section('content')
    <section id="" class=" bg-white  ">
        <div class="row mx-1">

            <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark ">
                @foreach ($sidemenu as $nsidemenu)
                    <div class=" ps-2">
                        <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                            class=" text-light fw-bold text-uppercase "
                            style="font-size:13px; font-family: Times new roman;   "
                            href="{{ url('/' . $nsidemenu->route) }}">{{ $nsidemenu->title }}</a>
                        <hr>
                    </div>
                @endforeach

            </div>
            <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">
                <div class="row pt-3  col-md-12  col-sm-12 text-center">
                    <h2>Notice Board </h2>
                </div>
                <div class="x_content pt-3 ">
                    <div class="row  pb-5 ">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-responsive"
                                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No</th>
                                            <th class="text-center">Hostel Name</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Publish Date</th>
                                            <th class="text-center">Document</th>
                                            <th class="text-center">Action</th>

                                    </thead>
                                    <tbody> <?php $i = 0; ?>
                                        @foreach ($data as $ndata)
                                            @php
                                                $name = DB::table('users')
                                                    ->where('id', $ndata->hostel_id)
                                                    ->first();
                                            @endphp
                                            <?php $i++; ?>
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td class="">{{ $name->name }}</td>
                                                <td class="">{{ $ndata->title }} </td>
                                                <td class="text-center">{{ $ndata->date }} </td>
                                                @if (pathinfo($ndata->photo, PATHINFO_EXTENSION) === 'pdf')
                                                    <td>
                                                        <object data="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                            type="application/pdf" width="100" height="100">

                                                        </object>

                                                    </td>
                                                @else
                                                    <td>
                                                        <img src="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                            alt="" width="100" height="100">

                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                        class="btn btn-info" download>
                                                        Download PDF
                                                    </a> <a href="{{ asset('public/hostel_card/' . $ndata->photo) }}"
                                                        target="_blank" class="btn btn-info ">
                                                        view
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-5">
                </div>

                {{-- <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h4><span class="sucontainer bg-white bheading">Hostel Notice Board </span></h4>

                </div>

                <div class="ftco-search">
                    <div class="row">

                        <div class="col-md-12 tab-wrap">

                            <div class="tab-content" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                    aria-labelledby="day-1-tab">
                                    @foreach ($data as $ndata)
                                        <div class="speaker-wrap ftco-animate d-flex">

                                            <div class="text pl-md-5">
                                                <div class="row bo ">
                                                    <div class="col-lg-1 col-sm-2  event-teaser text-right">
                                                        <div class=" event--content">
                                                            <div class="  col event--date-box">
                                                                <div>{{ date('M', strtotime($ndata->date)) }} <div
                                                                        class="event--day nowrap">
                                                                        {{ date('d', strtotime($ndata->date)) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-sm-5 pt-3 event--info">

                                                        <div class="event--details">
                                                            <div class="event--times"><i class="fas fa-clock"></i>
                                                                {{ $ndata->time }}</div>
                                                            {{-- <div class="event--location"><i
                                                                    class="fas fa-map-marker-alt"></i> {{ $ndata->place }}
                                                            </div> --}}
                {{-- </div>
                                                    </div>
                                                </div>
                                                <h2><a href="#">{{ $ndata->title }}</a></h2>
                                                <p style="font-size:10px;">{!! $ndata->details !!} </p>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>

    </section>
@endsection
