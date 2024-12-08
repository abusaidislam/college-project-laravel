<div class="row ">
    <div class="col-md-9">
        @foreach ($hmassage as $pmassage)
            @if ($pmassage->id == 1)
                <div class="pb-1" style="font-size:14px; font-weight: normal;font-family:Times new roman;">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="icon-box" data-aos="zoom-in-left">

                                <div class="">
                                    <p class="p-2 m-0 title text-dark bg">Office of the Principal</p>
                                </div>
                                <div>
                                    <ul>
                                        <li class=" text-dark"><a href="noticeboardview"> Notice Board</a></li>
                                        <li class="pt-1">Office Order</li>
                                        <li class="pt-1">Annual Committees</li>
                                        <li class="pt-1">Exam Committees</li>
                                        <li class="pt-1">Occasional Committees</li>
                                    </ul>

                                </div>

                                <p class="p-2 m-0 title text-dark bg">Faculty of Arts</p>
                                <ul>
                                    @foreach ($department1 as $ndepartment1)
                                        <li>{{ $ndepartment1->name }}</li>
                                    @endforeach
                                    <li><a href="bangla">Bangla</a></li>
                                </ul>
                                <p class="p-1 m-0 title text-dark bg">Faculty of Social Science</p>
                                <ul>
                                    <li>Economics</li>
                                    <li>Social Work</li>
                                    <li>P olitical Science</li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">

                                <h4 class="title text-right">Citizen Charter</h4>
                                <p><img class="border  p-2 mx-auto mb-3" src="{{ asset('slide/1670160757.jpg') }}"
                                        style="width: 500px; text-align: center; height: 400px;"> </p>

                            </div>
                        </div>

                    </div>
                </div>
            @endif
        @endforeach

        <d iv class="row ">
            <div class="col-md-4">
                <div class="icon-box" data-aos="zoom-in-left">


                    <p class="p-2 m-0 title text-dark bg">Faculty of Science</p>
                    <ul>
                        <li>Chemistry</li>
                        <li>Physics</li>
                        <li>ICT</li>
                        <li>Zoology</li>
                        <li>Botany</li>
                        <li>Mathematics</li>
                    </ul>
                    <p class="p-2 m-0 title text-dark bg">Faculty of Business Studies</p>
                    <ul>
                        <li>Management</li>
                        <li>Finance &amp; Banking</li>
                        <li>Accounting</li>
                        <li>Marketing</li>

                    </ul>
                    <p class="pt-1 m-0 title text-dark bg"> Mail<br>
                    <ul>
                        <li><a class="text-dark" href="/">Web Mail</a></li>
                        <li><a class="text-dark" href="/">Internal Mail</a></li>


                    </ul>
                    <p class="p-2 m-0 title text-dark bg">Online Portal<br>


                    <div class="p-0 ">

                        <ul>

                            @foreach ($qucklink as $nqucklink)
                                <li style="line-height:20px; font-family:sans-serif;"><a href="{{ $nqucklink->link }}">
                                        {{ $nqucklink->title }}</a></li>
                            @endforeach
                            <ul>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="icon-box" data-aos="zoom-in-left">

                    <div class="">
                        <p class="p-2 m-0 title text-dark bg">Bangabandhu &<br>
                            Liberation War Corner</p>
                    </div>

                    <div class="text-center"><a href="/academy/{{ $pmassage->id }}"> <img
                                class="border  p-2 mx-auto mb-3" src="{{ asset('upload/bangobandhu.jpg') }}"
                                style="width: 200px; text-align: center; height: 100px;"></a></div>
                    <div>
                        জাতির জনক বঙ্গবন্ধু শেখ মুজিবুর রহমান ফরিদপুর জেলার গোপালগঞ্জ মহকুমার (বর্তমানে জেলা)
                        টুঙ্গিপাড়া গ্রামে এক সম্ভ্রান্ত মুসলিম পরিবারে ১৯২০ সালের ১৭ মার্চ জন্মগ্রহণ করেন। <a
                            href="/bongobondhu"> More</a>

                    </div>


                    <p class="p-2 m-0 title text-dark bg">Class Schedule<br>
                    <div class="text-center"> <a href="/">Link</a></div>
                    <p class="p-2 m-0 title text-dark bg"> Journal of Saadat
                        College</p>
                    <div class="text-center"> <a href="/">Link</a></div>
                    <p class="p-2 m-0 title text-dark bg">Video Clip</p>
                    <video height="100" controls>
                        <source src="movie.mp4" type="video/mp4">
                        >
                        Your browser does not support the video tag.
                    </video>
                    <p class="p-2 m-2 title text-dark bg">Hit Counter: 200 Visitors</p>

                </div>

            </div>
            <div class="col-md-4 ">
                <div class="icon-box" data-aos="zoom-in-left">
                    <p class="p-2 m-0 title text-dark bg">Golden Jubilee Corner<br>
                    <div class="text-center"><img class="border  p-2 mx-auto mb-3"
                            src="{{ asset('slide/1670160757.jpg') }}" style=" text-align: center; height: 200px;"></div>
                    <p class="p-2 m-0 title text-dark bg">Bus Schedule<br>
                    <div class="text-center"> <a href="/">Link</a></div>
                    <p class="p-2 m-0 title text-dark bg">Online Portal<br>


                    <div class="p-0 ">

                        <ul>

                            @foreach ($qucklink as $nqucklink)
                                <li style="line-height:20px; font-family:sans-serif;"><a href="{{ $nqucklink->link }}">
                                        {{ $nqucklink->title }}</a></li>
                            @endforeach
                            <ul>
                    </div>

                    <p class="p-2 m-0 title text-dark bg">Complain Corner<br>
                    <form>
                        <textarea id="w3review" name="w3review" rows="2" cols="25"></textarea>
                        <input type="submit" name="Send">
                    </form>
                </div>
            </div>

    </div>




    <div class="col-md-3">
        <div class="icon-box list" data-aos="zoom-in-left" data-aos-delay="200">



            @foreach ($hmassage as $pmassage)
                @if ($pmassage->id == 1)
                    <div class="row col-md-12">
                        <p class="p-0 m-0  title text-center bg  text-dark " style="font-size:15px;">
                            <b>{{ $pmassage->designation }}</b>
                        </p>
                        <div class="text-center col-md-4 "><img class="border  p-1"
                                src="{{ asset('Message/' . $pmassage->photo) }}" alt=""
                                style=" height: 120px;">
                        </div>
                        <div class="text-center col-md-8 p-0 " style=" font-size:10px; font-family:Times new roman;">
                            {!! $pmassage->message !!} </div>

                        <p class="title bg text-center p-0  text-dark "> {{ $pmassage->name }} </p>

                    </div>
                @endif
            @endforeach


            @foreach ($hmassage as $pmassage)
                @if ($pmassage->id == 2)
                    <div class="row col-md-12">
                        <p class="p-0 m-0  title text-center bg  text-dark " style="font-size:15px;">
                            <b>{{ $pmassage->designation }}</b>
                        </p>
                        <div class="text-center col-md-4 "><img class="border  p-1"
                                src="{{ asset('Message/' . $pmassage->photo) }}" alt=""
                                style=" height: 120px;"></div>
                        <div class=" col-md-8 p-0 " style=" font-size:10px; font-family:Times new roman;">
                            {!! $pmassage->message !!} </div>

                        <p class="title bg text-center p-0  text-dark "> {{ $pmassage->name }} </p>


                    </div>
                @endif
            @endforeach





            <p class="p-2 m-2 title text-dark bg">Up-Coming Events</p>
            <div class="container text-center">

                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">


                        <form action="#" class="row">
                            <div class="col-md-12">
                                <div id="inline_cal"></div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>








    </div>




</div>
</div>


</script>
