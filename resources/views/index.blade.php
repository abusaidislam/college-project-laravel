@extends('layouts.master')
@section('content')
    <!-- Carousel Start -->
    <div class=" p-0 ">
        @include('frontend.slider')
    </div>
    <!-- Carousel End -->
    <section class=" pb-2 " style="background:#d8dbe2;">

        <marquee behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();">বিশেষ বিজ্ঞপ্তিঃ <i class="fas fa-star"
                style="color: red;"></i>
            @foreach ($breaking_news as $ndata)
                <a href="{{ 'newsview/' . $ndata->id }}" style="color:#089647;">{{ $ndata->title }} </a><i
                    class="fas fa-star " style="color: red;"></i>
            @endforeach
            </a>
        </marquee>

    </section>
    <!-- headmaster Start -->
    <section id="" class=" p-0 wow fadeInUp " data-wow-delay="0.2s">

        @include('frontend.hmaster')


    </section> <!-- headmaster End -->
@endsection
