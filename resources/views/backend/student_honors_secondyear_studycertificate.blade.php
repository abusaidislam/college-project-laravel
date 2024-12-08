@extends('layouts.department')
@section('content')
    {{-- <div class="right_col" role="main"> --}}
        <style>
            .sans {
                font-family: sans-serif, 'Open Sans';
            }

            .bold {
                font-weight: bold;
            }

            .block {
                display: block;
            }

            .underline {
                border-bottom: 1px solid #777;
                padding: 5px;
                margin-bottom: 15px;
            }

            .margin-0 {
                margin: 0;
            }

            .padding-0 {
                padding: 0;
            }

            .pm-empty-space {
                height: 40px;
                width: 100%;
            }

            body {
                padding: 20px 0;
                background: #ccc;
            }

         
            /* .pm-certificate-container {
                position: relative;
                width: 960px;
                height: 600px;
                background-image: url('{{ asset('public/tetimonialjolshap/a.png') }}');
                background-size: cover;
                padding: 30px;
                color: #333;
                font-family: 'Open Sans', sans-serif;
                box-shadow: 0 0 5px rgba(0, 0, 0, .5);
            } */
            .pm-certificate-container {
                position: relative;
                width: 960px;
                height: 600px;
                background-color: #ffffff;
                border: 2px solid rgb(36, 31, 32); 
                /* padding: 30px; */
                font-family: 'Open Sans', sans-serif;
                box-shadow: 0 0 5px rgba(0, 0, 0, .5);
            }
            .outer-border {
                width: 794px;
                height: 594px;
                position: absolute;
                left: 50%;
                margin-left: -397px;
                top: 50%;
                margin-top: -297px;
                border: 2px solid #fff;
            }

            .inner-border {
                width: 730px;
                height: 530px;
                position: absolute;
                left: 50%;
                margin-left: -365px;
                top: 50%;
                margin-top: -265px;
                border: 2px solid #fff;
            }

            .pm-certificate-border {
                position: relative;
                width: 821px;
                height: 520px;
                padding: 0;
                left: 50%;
                margin-left: -404px;
                top: 50%;
                margin-top: -260px;
            }

            .jolshapimage img {
                opacity: 0.1;
            }

            .pm-certificate-block {
                width: 650px;
                height: 200px;
                position: relative;
                left: 50%;
                margin-left: -325px;
                /* top: 70px; */
                margin-top: 0;
            }

            .pm-certificate-header {
                margin-bottom: 10px;
            }

            .boderbottomstyle {
                border-bottom: 2px dotted rgb(125, 112, 112);

                .underline {
                    margin-bottom: 5px;
                }
            }

            .pm-certificate-footer {
                width: 650px;
                height: 100px;
                position: relative;
                left: 50%;
                margin-left: -325px;
                bottom: -105px;
            }
        </style>

        <body>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn" style="margin-top:-100px; margin-left:10px">
                        <a class="btn btn-sm btn-success" href="javascript:void(0)" id="download"><i class="fa fa-download"
                                style="font-size:18px"> Download</i></a>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="color: red">
                        <b style="font-size: 16px"> Select Gender*:</b>
                    </span>
                    <span>
                        <div class="" style="margin: -35px 0px 0px 250px">
                            <div class="col-sm-9">
                                <select class="form-control" id="gender2" name="gender">
                                    <option class="" value="" selected>--Choose One--</option>
                                    <option class="" value="Male">Male</option>
                                    <option class="" value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="row">
            </div><br><br><br>
            <div class="container pm-certificate-container testimonial" style="margin-top: 70px">
                {{-- <div class="outer-border"></div>
                <div class="inner-border"></div> --}}
                <div class="pm-certificate-border col-xs-12">
                    <div class="row pm-certificate-header">
                        <div class="col-md-1 text-center">
                            <img src="{{ asset('public/library_card/' . $basic->photo) }}" alt="" srcset=""
                                width="90" height="100" style="margin: 20px 0px 0px 100px">
                        </div>
                        <div class="col-md-11 text-center"><br>
                            <h5>
                                Government Saadat College Karatia, Tangail.
                            </h5>
                            <h3 style="margin-top: 10px">
                                <strong>{{ $depart_name }}</strong>
                            </h3>
                        </div>
                    </div>
                    <div class="row jolshapimage">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <img src="{{ asset('public/tetimonialjolshap/collegelogo.jpeg') }}" alt=""
                                srcset="" width="180" height="200" style="margin: 70px 0px -20px 0px">
                        </div>
                        <div class="col-md-4"></div>

                    </div>
                    <div class="row" style="margin-top: -275px">
                        <div class="pm-certificate-block">
                            <div class="row" style="border-bottom: 2px solid black;">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6" style="text-align: right">
                                    <h6>
                                        <strong>Phone:0921-62559(College)</strong>
                                    </h6>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px">
                                <div class="col-md-6">
                                    Reference No: <span class="boderbottomstyle">{{ rand(10000, 99999) }}</span></span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <span> Date: <span class="boderbottomstyle">{{ date('d-m-Y') }}</span></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px">
                                <div class="col-md-12 text-center">
                                    <h5>
                                        <span style="border-style: double; border-radius: 5px;padding:3px">
                                            <b>Study Certificate</b>
                                        </span>
                                    </h5>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-justify">
                                    <span class="block cursive" style="font-size: 14px; line-height: 1.8;">This is to
                                        certify
                                        that <b>{{ $ndata->student_name ?? '.......................' }},
                                        </b>
                                        <span id="sonOrDaughter"></span> of
                                        <b>{{ $studentndata->father_name ?? '........................................' }}
                                        </b>
                                        and <b>{{ $studentndata->mather_name ?? '......................................' }},
                                        </b>
                                        is a student of <b>{{ $className->name ?? '...................................' }}
                                        </b>
                                        in <b>{{ $departlastName }}
                                        </b>
                                        of this college bearing class Roll No
                                        <b>{{ $ndata->roll ?? '................' }}
                                        </b>
                                        Regi. No <b>{{ $ndata->registration_no ?? '......................' }},
                                        </b>
                                        of Session <b>{{ $ndata->session_year ?? '.....................' }}
                                        </b>
                                        under National University. <span id="heOrShe"></span> bears a good moral
                                        character. To the best of my
                                        knowledge, <span id="heorshe"></span> is not take part in any activity subversive
                                        of
                                        the State or of College discipline.
                                        <br><br>
                                        <p style="font-size: 14px">
                                            I wish <span id="himOrHer"></span> every success in life.
                                        </p>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7"><!-- LEAVE EMPTY --></div>
                                <div class="col-md-5 text-center">
                                    <img src="{{ asset('public/library_card/' . ($headsigniture ? $headsigniture->signature : '......................')) }}"
                                        alt="" srcset="" width="200" height="40"
                                        style="margin: -30px 0px 0px 0px">

                                    <p>Head of the Department<br>
                                        {{ $depart_name }}<br>
                                        Govt. Saadat College
                                        Karatia, Tangail.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </body>
        <script>
            $(document).ready(function() {
                $('#gender2').on('change', function() {
                    var selectedGender = $(this).val();
                    $('#gender').val(selectedGender);

                    // Update HTML content based on gender
                    if (selectedGender === 'Male') {
                        $('#sonOrDaughter').text('Son');
                        $('#heOrShe').text('He');
                        $('#heorshe').text('he');
                        $('#himOrHer').text('him');
                    } else if (selectedGender === 'Female') {
                        $('#sonOrDaughter').text('Daughter');
                        $('#heorshe').text('she');
                        $('#himOrHer').text('Her');
                    }
                });
            });
        </script>
        <script>
            document.getElementById('download').addEventListener('click', function() {
                var options = {
                    margin: 5,
                    filename: 'honors_secondyear_study_certificate.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'landscape'
                    }
                };
                var element = document.querySelector('.testimonial');
                html2pdf(element, options);
            });
        </script>
    @endsection
