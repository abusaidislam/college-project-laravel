<div class=" pb-2 master m-0 p-0 " style=" font-family: Times new roman; background: #e7e8eb; ">
    <div class="row col-md-12 col-lg-12 col-sm-12   p-0  m-0">
        <div class="col-md-3   ">
            <div class="row ">
                <div class="icon-box p-0 border" data-aos="zoom-in-left" data-aos-delay="200">
                    <div class="card   p-0 ">
                        @foreach ($hmassage as $pmassage)
                            @if ($pmassage->id == 1)
                                <h6 class="card-header text-center  text-white"
                                    style="background:#1B653D; font-size:16px;">{{ $pmassage->designation }}</h6>
                                <div class="card-body text-start px-1 py-0 ">
                                    <div class="row p-1 pt-3 pb-4">
                                        <div class="col-md-5 p-0 m-0">
                                            <div class="">
                                                <img src="{{ asset('public/Message/' . $pmassage->photo) }}"
                                                    alt="" style=" width:120px;height:120px;">
                                            </div>
                                            <div class="row p-2" style="font-size:12px; margin-left: 0.5rem;">
                                                {{ $pmassage->name }} </div>
                                        </div>
                                        <div class="col-md-7 text-justify p-3">
                                            {!! $pmassage->message !!} <a href="/academy/1">Read
                                                More..</a>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="row mt-2 ">
                <div class="icon-box p-0 border" data-aos="zoom-in-left" data-aos-delay="200">
                    <div class="card   p-0 ">
                        @foreach ($hmassage as $pmassage)
                            @if ($pmassage->id == 2)
                                <h6 class="card-header text-center  text-white"
                                    style="background:#1B653D; font-size:16px;">{{ $pmassage->designation }}</h6>
                                <div class="card-body text-start px-1 py-0 ">
                                    <div class="row p-0 pt-2 pb-4">
                                        <div class="col-md-5 p-0 m-0">
                                            <div class="">
                                                <img src="{{ asset('public/Message/' . $pmassage->photo) }}"
                                                    alt="" style=" width:120px;height:120px;">
                                            </div>
                                            <div class="row p-2" style="font-size:12px; margin-left: 0.5rem;">
                                                {{ $pmassage->name }} </div>
                                        </div>
                                        <div class="col-md-7 text-justify p-3">
                                            {!! $pmassage->message !!} <a href="/academy/2">Read
                                                More..</a>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <style>
            .scroll-container {
                overflow: hidden;
                overflow-y: scroll;
                height: 420px;
            }
        </style>
        <div class="col-md-6 col-sm-12 ">
            <div class="icon-box p-0 border" data-aos="zoom-in-left" data-aos-delay="100">
                <div class="card p-0" style="border:0;">
                    <h6 class="card-header text-center text-white " style="background:#1B653D;">Citizen Charter</h6>
                    <p class="card-text p-0">
                    <div class="scroll-container">
                        <img class="p-0  " src="{{ asset('public/basic/' . $basic->citizen) }}"
                            style=" text-align: center; height:auto; width: 100%;">

                    </div>

                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3  col-sm-12  p-0 m-0">
            <div class="icon-box p-0 border" data-aos="zoom-in-left" data-aos-delay="100">
                <div class="card   p-0 m-0" style="border: 0; padding: 0; margin:0;">
                    <h6 class="card-header text-center  text-white" style="background:#1B653D;">UpComing Events</h6>
                    <div class="card-body text-start p-0">
                        @foreach ($event as $nevent)
                            <div class="row bo p-0 m-0 col-md-12 col-lg-12 col-sm-12  ">
                                <div class="col-lg-3 col-sm-3  event-teaser">
                                    <div class=" event--content">
                                        <div class="  col event--date-box p-0 ">
                                            <div>{{ date('M', strtotime($nevent->date)) }}
                                                <div class="event--day nowrap">
                                                    <a
                                                        href="eventview/{{ $nevent->id }}">{{ date('d', strtotime($nevent->date)) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9  col-sm-7 event--info pt-0 pb-0">
                                    <a href="eventview/{{ $nevent->id }}"
                                        class="event--title text-dark">{{ $nevent->title }}</a>
                                    <div class="event--details pb-0 ">
                                        <div class="event--times ">
                                            <i class="fas fa-clock"></i> {{ $nevent->time }}
                                        </div>
                                        <div class="event--location">
                                            <i class="fas fa-map-marker-alt"></i> {{ $nevent->place }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .image-zoom {}

    .image-zoom img {
        transition: transform 0.1s ease;
    }

    .image-zoom:hover img {
        transform: scale(1.4);
        /* Adjust the scale factor to control the zoom level */
    }
</style>
<style>
    .service-row {
        margin-bottom: 20px;
    }

    @media (min-width: 992px) {
        .col-md-9 {
            float: left;
            width: 75%;
        }
    }


    @media (min-width: 576px) {
        .container {
            max-width: 540px;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 720px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 960px;
        }
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1140px;
        }
    }


    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .container {
            width: 1170px;
        }
    }

    @media only screen and (min-width: 960px) {
        .container {
            position: relative;
            width: 960px;
            margin: 0 auto;
            padding: 0;
        }
    }

    .box {
        background-color: #f5f5f5;
        border: 1px solid #ccc;

    }


    .cust_card {
        display: flex;
        flex-direction: column;
        width: 100%;

        &__wrap {

            &--outer {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
            }

            &--inner {
                display: flex;
                flex-direction: row;
                width: 33.33%;
            }
        }
    }

    .service-box {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        cursor: pointer;
        padding: 10px;
        position: relative;
        overflow: hidden;
        color: #000;
        box-shadow: 1px 1px 1px 1px #ccc;
    }

    .service-title {
        font-size: 20px;
        text-align: center;
        color: white;
        display: block;
        background: #1B653D;
        border-radius: 5px;
    }

    h4 {
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: 500;
        line-height: 1.1;
        font-size: 18px;
        font-family: inherit;
        color: inherit;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
    }

    h4 {
        font-size: 21px;
        line-height: 30px;
        margin-bottom: 4px;
    }

    img {
        /* vertical-align:  baseline;
      border-style:    none;
      border:  0;
      margin: 0;
      padding: 0;  */
    }

    .service-box>img {
        position: relative;
        left: 0;
        max-width: 700px;
        transition: all 300ms ease-out;
        float: left;
    }

    ul {
        margin-top: 0;
        margin-bottom: 20px;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
    }

    .caption {
        position: relative;
        color: #000;
        z-index: 1;
        transition: all 300ms ease-out;
        left: 0;
        padding: 0;
        float: left;
    }

    .fade-caption {
        max-width: 65%;
    }

    li {
        line-height: 18px;
        margin-bottom: 12px;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
    }

    .caption li {
        margin: 2px 0 0 10px;
        list-style: none;
    }


    .text-green {
        color: limegreen;
    }

    .caption li i.fa {
        margin-right: 5px;
    }

    .fa-caret-right:before {
        content: "\f0da";
    }

    a {
        color: rgb(20, 12, 12);
        text-decoration: none;
        background-color: transparent;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
        outline: 0;
    }

    .caption li a {
        font-size: 15px;
        text-decoration: none;
    }

    a:hover {

        color: #0056b3;
        text-decoration: underline;
    }

    a:active,
    a:hover {
        outline: 0;
    }

    .nav-link:hover {
        background: #1B653D !important;
        color: white !important;
    }

    a:hover {
        color: #23527c;
        text-decoration: underline;
    }

    .caption li a:hover {
        text-decoration: underline;
    }

    #ww_51b284ece813a {
        background-color: #4F0B73 !important;
        color: #FFFFFF;
        font-family: Arial, Helvetica, sans-serif;
    }

    .btn-primary {
        color: #000;
        background-color: #1B653D !important;
        border-color: #1B653D !important;
    }
</style>

<div class="row col-md-12 col-lg-12 col-sm-12  p-0  m-0">

    <div class="col-md-3 " style="padding: 4px; ">
        <div class="service-box box" style="min-height:280px;">
            <h4 class="service-title">Office of the Principal</h4>
            <img src="{{ asset('public/basic/' . $basic->principaloffice) }}" style="max-width:80px; ">
            <ul class="caption fade-caption">
                @foreach ($sidemenu as $nofficemenu)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark "
                            href="{{ url('/' . $nofficemenu->subroute) }}">{{ $nofficemenu->sub_title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:280px;">
            <h4 class="service-title">Faculty of Business Studies</h4>
            <img src="{{ asset('public/basic/' . $basic->socialscience) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($depart_value3 as $ndepart_value3)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="departmentdetails/{{ $ndepart_value3->id }}">{{ $ndepart_value3->name }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:280px;">
            <h4 class="service-title">Faculty of Arts</h4>
            <img src="{{ asset('public/basic/' . $basic->arts) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($depart_value as $ndepart_value)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="departmentdetails/{{ $ndepart_value->id }}">{{ $ndepart_value->name }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:280px;">
            <h4 class="service-title">Faculty of Science</h4>
            <img src="{{ asset('public/basic/' . $basic->science) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($depart_value2 as $ndepart_value2)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="departmentdetails/{{ $ndepart_value2->id }}">{{ $ndepart_value2->name }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title">Online Portals</h4>
            <img src="{{ asset('public/basic/' . $basic->portal) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($online_portals as $nonline_portals)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $nonline_portals->link }}">{{ $nonline_portals->title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title" style="font-size: 15px !important;">Bangabandhu & Liberation War Corner</h4>
            <img src="{{ asset('public/basic/' . $basic->bangabandhu) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($allbangabandhu as $nallbangabandhu)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="bongobondhu/{{ $nallbangabandhu->id }}">{{ $nallbangabandhu->title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title">Faculty of Social Science</h4>
            <img src="{{ asset('public/basic/' . $basic->business) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($depart_value1 as $ndepart_value1)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="departmentdetails/{{ $ndepart_value1->id }}">{{ $ndepart_value1->name }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title">Mail</h4>
            <img src="{{ asset('public/basic/' . $basic->mail) }}" style="max-width:80px">
            <ul class="caption fade-caption">

                <li>
                    <i class="text-green fa fa-caret-right"></i>
                    <a class=" text-dark" href="https://saadatcollege.gov.bd/webmail"> Web Mail</a>
                </li>
                {{-- <li>
                <i class="text-green fa fa-caret-right"></i>
                <a class=" text-dark" href="https://saadatcollege.gov.bd/webmail"> Internal Mail</a>
            </li>   --}}

            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:180px;">
            <h4 class="service-title">Golden Jubilee Corner</h4>
            <img src="{{ asset('public/basic/' . $basic->golden_jubilee) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($goldenJubilee as $ngoldenJubilee)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark"
                            href="goldenJubilee/{{ $ngoldenJubilee->id }}">{{ $ngoldenJubilee->title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:180px;">
            <h4 class="service-title">Class Schedule</h4>
            <img src="{{ asset('public/basic/' . $basic->Class_s) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($departments as $ndepartments)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="class_schedules/{{ $ndepartments->id }}">
                            {{ $ndepartments->name }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>



    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:180px;">
            <h4 class="service-title">Forms</h4>
            <img src="{{ asset('public/basic/' . $basic->forms) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($allforms as $nallforms)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="fromsview/{{ $nallforms->id }}">{{ $nallforms->title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:180px;">
            <h4 class="service-title">Publications</h4>
            <img src="{{ asset('public/basic/' . $basic->Journal) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                <li>
                    <i class="text-green fa fa-caret-right"></i>
                    <a class="text-dark" href="journals-of-saadat-college">Journals of Saadat College</a>
                </li>
                <li>
                    <i class="text-green fa fa-caret-right"></i>
                    <a class="text-dark" href="college-magazines">College Magazines</a>
                </li>
                <li>
                    <i class="text-green fa fa-caret-right"></i>
                    <a class="text-dark" href="other-publications">Other Publications</a>
                </li>
            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title">Video Clip</h4>
            @foreach ($video_clips as $nvideo_clips)
                <iframe height="165" width="100%" allowfullscreen src={{ $nvideo_clips->link }}></iframe>
            @endforeach
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:230px;">
            <h4 class="service-title">Bus Schedule</h4>
            <img src="{{ asset('public/basic/' . $basic->bus_s) }}" style="max-width:80px">
            <ul class="caption fade-caption">

                <li>
                    <i class="text-green fa fa-caret-right"></i>
                    <a class="text-dark" href="{{ url('busschedule') }}">Bus Schedule</a>
                </li>

            </ul>
            </ul>
        </div>
    </div>
    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:230px;">
            <h4 class="service-title">APA Corner </h4>
            <img src="{{ asset('public/basic/' . $basic->apa) }}" style="max-width:80px">
            <ul class="caption fade-caption">

                @foreach ($apalink as $napalink)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $napalink->link }}">{{ $napalink->title }}</a>
                    </li>
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="apa-notices-view">APA Notice</a>
                    </li>
                @endforeach

            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:190px;">
            <h4 class="service-title">Quick Links</h4>
            <img src="{{ asset('public/basic/' . $basic->links) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($qucklink as $nqucklink)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $nqucklink->link }}">{{ $nqucklink->title }}</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">National Integrity Strategy</h4>
            <img src="{{ asset('public/basic/' . $basic->nis) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($nislink as $nnislink)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $nnislink->link }}">{{ $nnislink->title }}</a>
                    </li>
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="nis-notices-view">NIS Notice</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Complain Corner </h4>
            @if (session()->has('success'))
                <div class="alert alert-danger">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card-body text-start ">
                <form action="{{ route('complainMassage') }}" method="post">
                    @csrf
                    <div class="col-12">
                        <div class="form">
                            <textarea name="complain_massage" class="form-group" placeholder="Leave a message here..." cols="25"
                                style="height: 100px; width:100%"></textarea>
                        </div>
                    </div>
                    <div class="col-8">
                        <button class="btn btn-sm btn-block btn-primary w-100 py-1" type="submit">Send
                            Message</button>
                    </div>
                </form>
              </div>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Innovative Activities</h4>
            <img src="{{ asset('public/basic/' . $basic->innovation) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($innovativelinks as $ninnovativelink)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $ninnovativelink->link }}">{{ $ninnovativelink->title }}</a>
                    </li>
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="innovative-notices-view">Innovative Notice</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>


    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Elearning Resources & Platforms</h4>
            <img src="{{ asset('public/basic/' . $basic->elearning) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                @foreach ($elearninglinks as $nelearninglink)
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class=" text-dark" href="{{ $nelearninglink->link }}">{{ $nelearninglink->title }}</a>
                    </li>
                    <li>
                        <i class="text-green fa fa-caret-right"></i>
                        <a class="text-dark" href="elearning-notices-view">Elearning Notice</a>
                    </li>
                @endforeach
            </ul>
            </ul>
        </div>
    </div>
    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Apps Download</h4>
            <a href="{{ asset('public/saadatcollege.apk') }}" download>
                <img src="https://icons.iconarchive.com/icons/alecive/flatwoken/256/Apps-Android-icon.png"
                    style="max-width:80px">
            </a>
            <ul class="caption fade-caption">
                <li>
                    <div class="card-body text-start">
                        <div id="sfc8wklt3uwcjtn5rk4kgws5zhzgnmszykj"></div>
                        {{-- <script type="text/javascript"
                            src="https://counter10.optistats.ovh/private/counter.js?c=8wklt3uwcjtn5rk4kgws5zhzgnmszykj&down=async" async>
                        </script><noscript><a href="#" title="counter for website"><img
                                    src="https://counter10.optistats.ovh/private/freecounterstat.php?c=8wklt3uwcjtn5rk4kgws5zhzgnmszykj"
                                    border="0" title="" alt=""></a></noscript> --}}

                    </div>
                </li>
            </ul>
            </ul>
        </div>

    </div>

    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Weather Forecast </h4>
            <div class="card-body text-start p-0 " style="height:150px;">
                <div id="ww_51b284ece813a" v='1.3' loc='id'
                    a='{"t":"horizontal","lang":"en","sl_lpl":1,"ids":["wl10574"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"#1976D2","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#FFFFFF","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>
                    Weather Data Source: <a href="https://sharpweather.com/weather_tangail/" id="ww_51b284ece813a_u"
                        target="_blank">weather for Tangail</a>
                </div>
                <script async src="https://app1.weatherwidget.org/js/?id=ww_51b284ece813a"></script>
            </div>
            </ul>
        </div>
    </div>
    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:240px;">
            <h4 class="service-title">Current online users</h4>
            <img src="{{ asset('public/basic/' . $basic->currentusers) }}" style="max-width:80px">
            <ul class="caption fade-caption">
                <li class="text-dark p-0" style="color: rgb(117, 80, 185);"> <i class="fa fa-caret-right pb-1"
                        style="color:#089647 "></i>
                    {{-- <script language="JavaScript">
                        var fhs = document.createElement('script');
                        var fhs_id = "5686853";
                        var ref = ('' + document.referrer + '');
                        var pn = window.location;
                        var w_h = window.screen.width + " x " + window.screen.height;
                        fhs.src = "//freehostedscripts.net/ocounter.php?site=" + fhs_id + "&e1=Online User&e2=Online Users&r=" + ref +
                            "&wh=" + w_h + "&a=1&pn=" + pn + "";
                        document.head.appendChild(fhs);
                        document.write("<span id='o_" + fhs_id + "'></span>");
                    </script> --}}
                </li>
            </ul>
            </ul>
        </div>
    </div>
    <div class="col-md-3" style="padding: 4px;">
        <div class="service-box box" style="min-height:180px;">
            <h4 class="service-title">Wind Map & Live Weather Forecast</h4>
            <iframe width="310" height="180"
                src="https://embed.windy.com/embed2.html?lat=23.039&lon=90.000&detailLat=17.372&detailLon=94.746&width=300&height=200&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1"
                frameborder="0"></iframe>
            </ul>
        </div>
    </div>
</div>
