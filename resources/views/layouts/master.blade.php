<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Saadat College</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    @include('frontend.link')


    <style>
        #example,
        table {
            border-spacing: 0;

        }

        .headdata th {
            text-align: center !important;
            background: rgb(173, 255, 254)
        }

        .headdata th,
        .headdata td {
            border: 0.5px solid rgb(238, 233, 233);
        }
    </style>

</head>

<body class="pt-0 mt-0 " style="background: #c1eaf9; font-family: Times new roman;">
    <div class="" style=" ">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class=" border-bottom " style=" font-family:Times new roman;">
            <div class="row bg-white ">


                <div class="col-md-3 text-center  pt-3"><img class="  mb-2" src="{{ asset('public/basic/logo.png') }}"
                        alt="" style=" height: 100px;"></div>
                <div class="col-md-6 text-center pt-2"
                    style="line-height: 20px; font-family: Times new roman;color:#2f5396; font-size: 18px; ">
                    {{ $basic->company_email }}
                    <h2 class="pt-2"
                        style="color:#2f5396;  font-family: Times new roman; line-height: 30px;  font-size: 2rem;  ">
                        {{ $basic->company_name }}</h2>
                    <p class="p-0" id="eiinNumber"> {!! $basic->address !!}</p>
                </div>
                <div class="col-md-3 col-sm-12 text-center"><img src="{{ asset('public/basic/' . $basic->logo) }} "
                        alt="">
                    <p class="text-dark text-start" style="  font-size: 12px; font-weight: 600;">
                    </p>
                </div>


            </div>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class=" " style="font-family: Times new roman;">
        @include('frontend.nav')</div>
    <!-- Navbar End -->
    <div class=" " style="font-family: Times new roman;">
        @yield('content')

    </div>

    <!-- Footer Start -->

    <div class=" text-light footer text-center   wow fadeIn" data-wow-delay="0.1s" style=" background:#034320;">
        @include('frontend.footer')
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i></a>


    @include('frontend.script')


</body>

</html>
