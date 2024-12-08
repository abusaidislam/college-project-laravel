
 <div class="container">
    <div class="text-center">
        <h6 class="section-title bg-white text-center text-primary px-3">Techers</h6>
        <h1 class="mb-5">Our Department Heads</h1>
    </div>
    <div class="owl-carousel testimonial-carousel position-relative">
        @foreach ($dhead as $np1) <div class="testimonial-item text-center bbo">
            <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('Dhead/'.$np1->photo)}} " style="width: 80px; height: 80px;">
            <h5 class="mb-0">{{$np1->name}}</h5>
            <p>{{$np1->designation}} </p>
            <div class="testimonial-text bg-light text-center p-4">
            <p class="mb-0 text-center">{!!$np1->message!!} </p>
            </div>
        </div>@endforeach
     
    </div>
</div>
