@extends('layouts.master')
@section('content')
    <section id="" class="" style="background:#f1f1f1">
        <div class="container text-center p-5">
            <div class="row justify-content-center">
                @foreach ($data as $item)
                    <div class="col-sm-9, col-md-9 bg-white shadow p-2 " style="border-radius:10px">
                        <div class="fakeimg">
                            <img src="{{ asset('public/hostel_card/' . $item->photo) }}" width="100%"
                                alt="{{ $item->title }}">
                        </div>
                        <div class="hosteltext p-2">
                            <button type="" class="btn btn-outline-primary"><a
                                    href="{{ asset('public/hostel_card/' . $item->photo) }}" download>
                                    Download PDF</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
