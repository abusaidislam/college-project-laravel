<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Saddat College</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="aseset{department/arts/assets/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('department/arts/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Playfair+Display:400,400i,500,500i,600,600i,700,700i&subset=cyrillic"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('department/arts/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('department/arts/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('department/arts/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('department/arts/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('department/arts/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('department/arts/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Lonely - v4.10.0
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-lonely/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="p-0 m-0" style="background: #c9e0d3;">


    <div class="container ">
        <!-- ======= Hero Section ======= -->

        <div class="container border-bottom">
            <div class="row bg-white  pt-0">
                <div class="col-md-3 text-center"><img class="  p-1 mx-auto mb-3" src="{{ asset('basic/logo.png') }}"
                        alt="" style=" height: 150px;"></div>
                <div class="col-md-6 text-center" style="line-height: 15px; font-family: Arial; ">
                    <p style="color:#2f5396; font-size: 20px;">The Government of the Peoples Republic of Bangladesh</p>
                    <h3 style="color:#2f5396; font-family: Arial;  ">Government Saadat College</h3>

                    <p style="color:#2f5396; font-size: 15px;">Karatia, Tangail-1903</p>
                    <p style="color:#2f5396; font-size: 15px;">Established: 1926</p>
                    <p class="text-dark">College Code: 0070, NU Code: 5301, EIIN: 114747</p>
                </div>
                <div class="col-md-3 text-center"><img class="  p-1 mx-auto mb-3" src="{{ asset('basic/logo1.png') }}"
                        alt="" style=" height: 130px;">
                    <p class="text-dark" style="  font-size: 15px;">“আলোকিত মানুষ, আলোকিত</p>
                </div>
            </div>
        </div>
        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">

                <div class="logo">
                    <h1><a href="#">
                            @foreach ($facultys as $nfacultys)
                                {{ $nfacultys->name }}
                            @endforeach
                        </a></h1>

                </div>

                <nav id="navbar" class="navbar ">
                    <ul>
                        <li><a class="nav-link scrollto active" href="/">Home</a></li>
                        <li><a class="nav-link scrollto" href="#about">History</a></li>
                        <li><a class="nav-link scrollto" href="#vision">Vision & Mission</a></li>
                        <li><a class="nav-link scrollto" href="#resume">Teachers </a></li>
                        <li><a class="nav-link scrollto" href="#services">Staff </a></li>

                        <li><a class="nav-link scrollto" href="#students">Students</a></li>
                        <li><a class="nav-link scrollto" href="#contact">contact</a></li>


                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <main id="main">

            <!-- ======= About Section ======= -->
            <section id="about" class="about bg-white pt-0">
                <div class="container">
                    @foreach ($history as $nhistory)
                        <div class="row no-gutters">


                            <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                                <div class="content d-flex flex-column justify-content-center">
                                    <h3>History of {{ $nhistory->history_title }} Department</h3>

                                    <div class="row">


                                        <div class="col-md-12 d-md-flex align-items-md-stretch">
                                            <div class="count-box  ">


                                                <p class=" justify-content-between text-start m-2">



                                                <div class="row">

                                                </div>
                                                <div class="row p-2">
                                                    <img src="{{ asset($nhistory->history_images) }}"
                                                        alt="{{ $nhistory->history_title }}">
                                                </div>
                                                <div class="row p-3"> {{ $nhistory->history_details }}</div>


                                                </p>
                    @endforeach

                </div>



    </div>
    </div>
    </div><!-- End .content-->
    </div>
    </div>

    </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="vision" class="skills section-bg">
        <div class="container">
            @foreach ($visionmission as $nvisionmission)
                <div class="section-title">
                    <h2>Mission & Vision Of {{ $nvisionmission->vision_title }} Department</h2>

                    <div class="row p-2">
                        <img src="{{ asset($nhistory->history_images) }}" alt="{{ $nhistory->history_title }}">
                    </div>
                    <p class="justify-content-between  m-2">{{ $nvisionmission->vision_details }}</p>
                </div>
            @endforeach

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume section-bg">
        <div class="container">
            <h2>Teachers Management </h2>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <table id="datatable-responsive"
                                class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>

                                        <th class="text-center">Photo</th>
                                        <th class="text-center">Name</th>

                                        <th class="text-center">Designation</th>
                                        <th class="text-center">BCS_Batch</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center"> Mobile No.</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Home District</th>

                                    </tr>
                                </thead>
                                <tbody id="list">
                                    @foreach ($teacher as $nteacher)
                                        <tr>
                                            <td class="text-center"><img src="{{ asset($nteacher->photo) }} "
                                                    alt="" width="100" height="80"> </td>
                                            <td class="text-center">{{ $nteacher->name }}</td>

                                            <td class="text-center">{{ $nteacher->designation }} </td>
                                            <td class="text-center">{{ $nteacher->bcs_batch }} th </td>
                                            <td class="text-center"> {{ $nteacher->department }} </td>
                                            <td class="text-center">{{ $nteacher->mobile_no }} </td>
                                            <td>{{ $nteacher->email }} </td>
                                            <td class="text-center">{{ $nteacher->home_dis }} </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>

            </div>
    </section><!-- End Resume Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">


            <h2>Staff Management</h2>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <table id="datatable-responsive"
                                class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>

                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Designation</th>

                                        <th>Department</th>
                                        <th>Mobile No.</th>
                                        <th>Home District</th>

                                    </tr>
                                </thead>
                                <tbody id="list">
                                    @foreach ($staff as $nstaff)
                                        <tr>
                                            <td><img src="{{ asset($nstaff->photo) }} " alt=""
                                                    width="100" height="80"> </td>
                                            <td>{{ $nstaff->name }}</td>
                                            <td>{{ $nstaff->email }} </td>
                                            <td>{{ $nstaff->designation }} </td>

                                            <td>{{ $nstaff->department }} </td>
                                            <td>{{ $nstaff->mobile_no }} </td>
                                            <td>{{ $nstaff->home_dis }} </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>

                    </div>
                </div>
            </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="students" class="students section-bg">
        <div class="container">




            <h2>Students Management</h2>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">




                            <table id="datatable-responsive"
                                class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Registration No</th>
                                        <th>Session</th>
                                        <th>Roll</th>

                                        <th>Class</th>
                                        <th>Mobile No.</th>
                                        <th>Blood Group</th>
                                        <th>Email</th>
                                        <th>Home District</th>



                                    </tr>
                                </thead>
                                <tbody id="list">@php($i = 1)
                                    @foreach ($student as $nstudent)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><img src="{{ asset($nstudent->photo) }} " alt=""
                                                    width="80" height="80"> </td>
                                            <td>{{ $nstudent->name }}</td>
                                            <td>{{ $nstudent->registration_no }} </td>
                                            <td>{{ $nstudent->session }} </td>
                                            <td>{{ $nstudent->roll }} </td>
                                            </td><?php $sclass = DB::table('studen_classes')
                                                ->where('id', '=', $nstudent->studentclass)
                                                ->get(); ?>
                                            <td>
                                                @foreach ($sclass as $nstudentclass)
                                                    {{ $nstudentclass->name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $nstudent->mobile_no }} </td>
                                            <td>{{ $nstudent->blood_group }}</td>
                                            <td>{{ $nstudent->email }} </td>
                                            <td>{{ $nstudent->home_dis }} </td>




                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p></p>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <div class="contact-about">
                        <h3> Saadat College</h3>
                        <p></p>
                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="info">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt"></i>
                            Govt.Saadat College, Karatia, Tangail
                        </div>

                        <div class="d-flex align-items-center mt-4">
                            <i class="bi bi-envelope"></i>
                            <p>info@SaadatCollege.com</p>
                        </div>

                        <div class="d-flex align-items-center mt-4">
                            <i class="bi bi-phone"></i>
                            <p>+880 5589 55488 55</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 col-md-8">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Your Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span> Govt.Saadat College, Karatia, Tangail</span></strong>. All Rights
                Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-lonely/ -->

            </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('department/arts/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('department/arts/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('department/arts/assets/js/main.js') }}"></script>
    </div>
</body>

</html>
