@extends('layouts.master')
@section('content')
    <section id="" class="p-0 m-0" style="background: #f1f1f1">
        <style>
            .hosteltext {
                color: #1B653D;
                font-size: 25px;
                font-weight: 300;
            }

            .hosteltext:hover {
                background-color: rgb(69, 202, 239);
                font-weight: 500;
            }
        </style>

        <div class="container-fluid text-center p-0">
            <div class="row justify-content-center">
                @foreach ($data as $item)
                    <div class="col-sm-3 col-md-3 bg-white shadow p-2 m-3" style="border-radius: 10px">
                        <div class="fakeimg">
                            <img src="{{ asset('public/hostel_card/' . $item->photo) }}" width="100%" height="230px"
                                alt="{{ $item->title }}">
                        </div>
                        <div class="hosteltext p-2" style="white-space:wrap; overflow: hidden; text-overflow: ellipsis;">
                            <p style="">
                                {{ $item->title }}
                            </p>
                        </div>


                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
