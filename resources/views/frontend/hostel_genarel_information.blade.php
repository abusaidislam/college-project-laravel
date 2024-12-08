@extends('layouts.master')
@section('content')
    <section id="" class="" style="background:#f1f1f1">
        <div class="container text-center p-5">
            <div class="row justify-content-center"> <!-- Added justify-content-center class -->
                @foreach ($data as $item)
                    @php
                        $name = DB::table('users')
                            ->where('id', $item->hostel_id)
                            ->first();
                    @endphp
                    <div class="col-sm-8 bg-white shadow p-2 mb-5" style="border-radius:10px">
                        <div class="fakeimg1"
                            style="background-image: url('{{ asset('public/hostel_card/' . $item->photo) }}'); background-size: cover; background-position: center; height: 500px;">
                        </div>
                        <div class="hosteltext p-2" style="background: rgb(0 226 255 / 17%)">
                            <h3>{{ $name->name }}</h3>
                            <h4>Total Seat: {{ $item->total_seat }}</h4>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
