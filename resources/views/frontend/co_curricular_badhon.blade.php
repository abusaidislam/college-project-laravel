{{-- @extends('layouts.master')
@section('content')
    <!-- About Start -->
    <div class=" py-5 bg-white">
        <h1>Co-Curricular Page</h1>
        <div class="">
            @foreach ($CoCurricular as $item)
                @php
                    $data = DB::table('co_curricular_manages')
                        ->where('co_id', $item->id)
                        ->first();
                @endphp
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="img-fluid position-absolute w-100 h-100"
                                src="{{ asset('public/coteacher/' . $data->photo) }} " alt=""
                                style="object-fit: cover;">

                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h5 class="section-title bg-white text-start text-primary ps-2 pb-2">{!! $data->details !!}
                        </h5>
                        <p class="mb-4 text-dark"> </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- About End -->
@endsection --}}
