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
            <div class="col-md-9  col-sm-9  border pt-4 m-0 pb-5 ">
                <div class="col-md-7 text-center">
                    <h4 class="text-center"><span class="sucontainer bg-white bheading">Hostel Rules & Regulations </span>
                    </h4>

                </div>
                @foreach ($data as $item)
                    <div class="row justify-content-center">
                        <div class="col-sm-3, col-md-3 bg-white shadow p-2 " style="border-radius:10px">
                            @if (pathinfo($item->photo, PATHINFO_EXTENSION) === 'pdf')
                                <div class="fakeimg">
                                    <object data="{{ asset('public/hostel_card/' . $item->photo) }}" type="application/pdf"
                                        width="100%" height="200">

                                    </object>
                                </div>
                            @else
                                <div class="fakeimg">
                                    <img src="{{ asset('public/hostel_card/' . $item->photo) }}" width="100%"
                                        alt="" srcset="">
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-5, col-md-5 " style="border-radius:10px">
                            <div class="hosteltext p-2">
                                <button type="" class="btn btn-outline-primary"><a
                                        href="{{ asset('public/hostel_card/' . $item->photo) }}" download>
                                        Download PDF</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        </div>






    </section>
@endsection
