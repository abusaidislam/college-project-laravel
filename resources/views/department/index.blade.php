@include('department.departmentheader')

<body>
    <!-- ======= Mobile nav1 toggle button ======= -->
    <div id="main1">
        <div id="head" class="container border-bottom " style=" ">
            <div class="row bg-white  ">@include('frontend.header1')
            </div>
            <div class="" style="font-size:14px; ">
                @include('frontend.nav')</div>
        </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">
            @include('department.departmentmenu')
            <!-- .nav1-menu -->
        </div>
    </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    {{-- <section id="hero" class="d-flex flex-column  align-items-center"
        style="background-image: url({{ asset($backgroundImage->image) }});background-repeat: no-repeat;">

        <div class="hero-container" data-aos="fade-in">
            <h1
                style="margin: 0 0 10px 0;font-size: 45px;font-weight: 700; line-height: 56px; color: #ff0000; padding: 5px;">
                @foreach ($departments_id as $ndepartments_id)
                    {{ $ndepartments_id->name }}
                @endforeach
            </h1>
            <p class="text-center ps-2"><span class="typed"
                    data-typed-items="Government Saadat College, Karatia Tangail-1903"></span>
            </p>
        </div>
    </section> --}}
    <!-- End Hero -->

    <main id="main">

        <section id="hero" class="d-flex flex-column  align-items-center"
            style="background-image: url({{ asset('public/department/images/' . $backgroundImage->image) }});background-repeat: no-repeat;">

            <div class="hero-container" data-aos="fade-in">
                <h1
                    style="background-color: #4f0b7399;
            color: white;
            padding: 4px; margin: 0 0 10px 0; font-size: 45px; font-weight: 700; line-height: 56px;">
                    @foreach ($departments_id as $ndepartments_id)
                        {{ $ndepartments_id->name }}
                    @endforeach
                </h1>
                <p class="text-center p-2"><span class="typed"
                        data-typed-items="Government Saadat College, Karatia Tangail-1903"></span>
                </p>
            </div>
        </section>
        @foreach ($history as $nhistory)
            <!-- ======= About Section ======= -->
            <section id="history" class="about section-bg">
                <div class="container">

                    <div class="section-title">
                        <h2>Our History</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4" data-aos="fade-right">
                            <img src="{{ asset('public/department/images/' . $nhistory->history_images) }}"
                                class="img-fluid" alt="{{ $nhistory->history_title }}"
                                style="float: left; height:300px;">
                        </div>
                        <div class="col-lg-8 p-4 pt-lg-0 content" data-aos="fade-left">
                            <div class="row ">
                                <h3>{{ $nhistory->history_title }}</h3>
                                <p style="text-align: justify;">{!! $nhistory->history_details !!}
                                </p>
                            </div>
                        </div>

                    </div>
        @endforeach
        </section><!-- End About Section -->

        <!-- ======= Facts Section ======= -->
        <section id="mission" class="facts">

            <div class="container">
                @foreach ($visionmission as $nvisionmission)
                    {{-- @dd($visionmission); --}}
                    <div class="section-title">
                        <h2>Our Mission</h2>

                    </div>
                    <div class="row">
                        <div class="col-lg-4" data-aos="fade-right">
                            <img src="{{ asset('public/department/images/' . $nvisionmission->vision_images) }}"
                                class="img-fluid" alt="{{ $nvisionmission->vision_title }}"
                                style="float: left; height:300px;">

                        </div>
                        <div class="col-lg-8 p-4 pt-lg-0 content" data-aos="fade-left">
                            <div class="row ">
                                <h3>{{ $nvisionmission->vision_title }}</h3>

                                <p style="text-align: justify;">{!! $nvisionmission->vision_details !!}
                                </p>
                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="row no-gutters">

                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ count($student) }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Number of students</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ count($teacher) }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Number of Teachers</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ count($staff) }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p><strong>Academic staff</strong> </p>
                        </div>
                    </div>



                </div>

            </div>
        </section><!-- End Facts Section -->
        <!-- ======= Testimonials Section ======= -->
        <section id="teachers" class="testimonials section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>OUR TEACHERS</h2>

                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($teacher as $nteacher)
                            <div class="swiper-slide">
                                <div class="testimonial-item" data-aos="fade-up">
                                    <h3>{{ $nteacher->name }}</h3>
                                    @if ($nteacher->designation == 1)
                                        <h4>Professor</h4>
                                    @elseif ($nteacher->designation == 2)
                                        <h4>Associate Professor</h4>
                                    @elseif ($nteacher->designation == 3)
                                        <h4>Assistant Professor</h4>
                                    @elseif ($nteacher->designation == 4)
                                        <h4>Lecturer</h4>
                                    @else
                                        <h4></h4>
                                    @endif
                                    <img src="{{ asset('public/teachers/' . $nteacher->photo) }}"
                                        class="testimonial-img rounded-circle" height="100" alt="">
                                    <p class="text-start ps-5">
                                        <i class="bi bi-chevron-right"></i> <strong>BCS_Batch :</strong>
                                        <span>{{ $nteacher->bcs_batch }}</span> </br>

                                        {{-- <i class="bi bi-chevron-right"></i> <strong>Mobile No:</strong>
                                        <span>{{ $nteacher->mobile_no }} </span></br> --}}
                                        <i class="bi bi-chevron-right"></i> <strong>Email:</strong>
                                        <span>{{ $nteacher->email }} </span></br>
                                        <i class="bi bi-chevron-right"></i> <strong>Home District:</strong>
                                        <span>{{ $nteacher->home_dis }} </span></br>
                                        {{-- <i class="bi bi-chevron-right"></i> <strong>Date of Birth:</strong>
                                        <span>{{ $nteacher->date_of_birth }} </span></br>
                                        <i class="bi bi-chevron-right"></i> <strong>PRL Date:</strong>
                                        <span>{{ $nteacher->rcl_date }} </span></br> --}}

                                    </p>

                                </div>
                            </div><!-- End testimonial item -->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- ======= Skills Section ======= -->
        <!-- ======= Testimonials Section ======= -->
        <section id="honour" class="testimonials">
            <div class="container">

                <div class="section-title">
                    <h2>TEACHERS HONOUR BOARD</h2>

                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($honourteacher as $nteacher)
                            <div class="swiper-slide">
                                <div class="testimonial-item" data-aos="fade-up">
                                    <h3>{{ $nteacher->name }}</h3>
                                    @if ($nteacher->designation == 1)
                                        <h4>Professor</h4>
                                    @elseif ($nteacher->designation == 2)
                                        <h4>Associate Professor</h4>
                                    @elseif ($nteacher->designation == 3)
                                        <h4>Assistant Professor</h4>
                                    @elseif ($nteacher->designation == 4)
                                        <h4>Lecturer</h4>
                                    @else
                                        <h4></h4>
                                    @endif
                                    <img src="{{ asset('public/teachers/' . $nteacher->photo) }}"
                                        class="testimonial-img rounded-circle" height="100" alt="">
                                    <p class="text-start ps-5">
                                        <i class="bi bi-chevron-right"></i> <strong>BCS_Batch :</strong>
                                        <span>{{ $nteacher->bcs_batch }}</span> </br>

                                        {{-- <i class="bi bi-chevron-right"></i> <strong>Mobile No:</strong>
                                        <span>{{ $nteacher->mobile_no }} </span></br> --}}
                                        <i class="bi bi-chevron-right"></i> <strong>Email:</strong>
                                        <span>{{ $nteacher->email }} </span></br>
                                        <i class="bi bi-chevron-right"></i> <strong>Home District:</strong>
                                        <span>{{ $nteacher->home_dis }} </span></br>
                                        {{-- <i class="bi bi-chevron-right"></i> <strong>Date of Birth:</strong>
                                        <span>{{ $nteacher->date_of_birth }} </span></br>
                                        <i class="bi bi-chevron-right"></i> <strong>PRL Date:</strong>
                                        <span>{{ $nteacher->rcl_date }} </span></br> --}}

                                    </p>

                                </div>
                            </div><!-- End testimonial item -->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- ======= Skills Section ======= -->

        <!-- ======= Services Section ======= -->
        <section id="staffs" class="services section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>OUR STAFFS</h2>

                </div>
                <div class="row">
                    @foreach ($staff as $nstaff)
                        <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                            <div class="icon"> <img src="{{ asset('public/Staff/' . $nstaff->photo) }}  "
                                    class=" rounded-circle" alt="" style=" height:74px; width: 74px;"></div>
                            <h4 class="title"><a href="">{{ $nstaff->name }}</a></h4>
                            <p class="description">
                                <i class="bi bi-chevron-right"></i> <strong>Designation:</strong>
                                <span>{{ $nstaff->designation }} </span></br>
                                {{-- <i class="bi bi-chevron-right"></i> <strong>Mobile No:</strong>
                                <span>{{ $nstaff->mobile_no }} </span></br> --}}
                                <i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ $nstaff->email }}
                                </span></br>
                                <i class="bi bi-chevron-right"></i> <strong>Home District:</strong>
                                <span>{{ $nstaff->home_dis }} </span></br>

                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Resume Section ======= -->
        {{-- <section id="resume" class="resume">
            <div class="container">
                <div class="section-title">
                    <h2>OUR STUDENTS</h2>
                </div>

                <div class="row pt-3 col-md-12 col-sm-12 pb-5">
                    <div class="col-sm-6 text-end"></div>
                    <div class="col-sm-6 text-start fonts">
                        <input class="form-control" id="search" type="search" placeholder="Search.."
                            name="search">
                    </div>
                </div>

                <div class="row">
                    @foreach ($student as $nstudent)
                        @if ($loop->iteration <= 12)
                            <div class="col-lg-3 card" data-aos="fade-up">
                                <div class="pt-1" id="">
                                    <p>
                                        <img src="{{ asset($nstudent->photo) }}" alt="" width="80"
                                            height="80">
                                    </p>
                                    <h4>{{ $nstudent->name }}</h4>
                                    <ul class="ps-2">
                                        <li>Registration No: {{ $nstudent->registration_no }} </li>
                                        <li>Session: {{ $nstudent->session }} </li>
                                        <li>Roll: {{ $nstudent->roll }} </li>
                                        @php
                                            $sclass = DB::table('studen_classes')
                                                ->where('id', '=', $nstudent->studentclass)
                                                ->get();
                                        @endphp

                                        <li>Class: @foreach ($sclass as $nstudentclass)
                                                {{ $nstudentclass->name }}
                                            @endforeach
                                        </li>
                                        <li>Email: {{ $nstudent->email }} </li>
                                        <li>Blood Group: {{ $nstudent->blood_group }}</li>
                                        <li>Mobile No.: {{ $nstudent->mobile_no }} </li>
                                        <li>Home District: {{ $nstudent->home_dis }} </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </section> --}}
        <!-- End Resume Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="gallery" class="portfolio">
            <div class="container">

                <div class="section-title">
                    <h2>Photo Gallery</h2>

                </div>



                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
                    @foreach ($photo_gallery as $nphoto_gallery)
                        <div class="col-lg-4 col-md-4 portfolio-item ">
                            <div class="portfolio-wrap">
                                <img src="{{ asset('public/Photo_gallery/' . $nphoto_gallery->photo) }} "class="img-fluid"
                                    alt="">
                                <div class="portfolio-links">
                                    <a href="{{ asset('public/Photo_gallery/' . $nphoto_gallery->photo) }}"
                                        data-gallery="portfolioGallery" class="portfolio-lightbox"
                                        title="{!! $nphoto_gallery->note !!}"><i class="bx bx-plus"></i></a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- ======= Contact Section ======= -->
        <section id="notice" class="contact section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Notice Board</h2>

                </div>

                <div class="row" data-aos="fade-in">


                    @foreach ($notice as $nnotice)
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="info">
                                <div class="address">

                                    <h4 class="px-0"><a href="/department_notice/{{ $nnotice->id }}">Notice:
                                            {{ $nnotice->title }}</a></h4>
                                    <h6>{{ date('D', strtotime($nnotice->dates)) }}day,
                                        {{ date('d', strtotime($nnotice->dates)) }}
                                        {{ date('F', strtotime($nnotice->dates)) }}
                                        {{ date('Y', strtotime($nnotice->dates)) }}</h6>
                                </div>

                            </div>
                        </div>
                </div>
                </br>
                @endforeach


            </div>
        </section><!-- End Contact Section -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#search').change(function() {
                    var value = $(this).val();
                    if (value) {
                        $.ajax({
                            url: "{{ url('studentsearch') }}/" + value,
                            type: 'GET',
                            cache: false,
                            dataType: "json",
                            success: function(data) {
                                // console.log(data);
                                var output = '<ul>';

                                // Loop through each student in the JSON data
                                $.each(data, function(index, student) {
                                    output += "<li class='text-center'> <img src='" +
                                        student.photo +
                                        "'  width='auto' height='80'></li>";
                                    output += "<li class='text-center'>" + student.name +
                                        "</li>";
                                    output += "<li class='text-center'>" + student.session +
                                        "</li>";
                                    output += "<li class='text-center'>" + student.roll +
                                        "</li>";
                                    output += "<li class='text-center'>" + student.email +
                                        "</li>";
                                    output += "<li class='text-center'>" + student
                                        .blood_group + "</li>";
                                    output += "<li class='text-center'>" + student
                                        .mobile_no + "</li>";
                                    output += "<li class='text-center'>" + student
                                        .home_dis + "</li>";
                                });

                                output += '</ul>';
                                $('#studentsea').html(output);
                            }
                        });
                    }
                });
            });
        </script>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="{{ asset('public/departmentassets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/typed.js/typed.min.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('public/departmentassets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('public/departmentassets/js/main.js') }}"></script>

</body>

</html>
