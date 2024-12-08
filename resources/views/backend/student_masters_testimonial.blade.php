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
            .pm-certificate-container {
                position: relative;
                width: 960px;
                height: 700px;
                background-image: url('{{ asset('public/tetimonialjolshap/12.png') }}');
                background-size: cover;
                padding: 30px;
                font-family: 'Open Sans', sans-serif;
                box-shadow: 0 0 5px rgba(0, 0, 0, .5);
            }

            /* .pm-certificate-container {
                position: relative;
                width: 960px;
                height: 600px;
                background-color: #ffffff;
                border: 2px solid rgb(36, 31, 32); 
                font-family: 'Open Sans', sans-serif;
                box-shadow: 0 0 5px rgba(0, 0, 0, .5);
            } */
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
                    </span><br>
                </div>
            </div>
            <div class="row">
            </div><br><br><br>
            <div class="container pm-certificate-container testimonial" style="margin-top: 40px">
                {{-- <div class="outer-border"></div>
                <div class="inner-border"></div> --}}
                <div class="pm-certificate-border col-xs-12">
                    <div class="row pm-certificate-header" style="margin-top:-10px">
                        <div class="col-md-1 text-center">
                            <img src="{{ asset('public/library_card/' . $basic->photo) }}" alt="" srcset=""
                                width="90" height="100" style="margin:0px 0px 0px 100px">
                        </div>
                        <div class="col-md-11 text-center" style="margin-top:-10px">
                            <h5>
                                People's Republic of Bangladesh <br>
                                <span>Office of the Principal</span>
                            </h5>
                            <h3 style="margin-top: -8px">
                                <strong>Government Saadat College</strong><br><span style="font-size: 20px">Karatia,
                                    Tangail.</span>
                            </h3> <br>

                        </div>
                    </div>
                    <div class="row jolshapimage">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <img src="{{ asset('public/tetimonialjolshap/collegelogo.jpeg') }}" alt=""
                                srcset="" width="180" height="200" style="margin: 60px 0px -20px 0px">
                        </div>
                        <div class="col-md-4"></div>

                    </div>
                    <div class="row" style="margin-top: -275px">
                        <div class="pm-certificate-block">

                            <div class="row" style="margin-top:0px">
                                <div class="col-md-4"></div>
                                <div class="col-md-5 text-center">
                                    <h5 style="border-style: double; border-radius: 5px;padding:3px">
                                        <span>
                                            <b>Testimonial <br> Character Certificate</b>
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row" style="margin-top:0px">
                                <div class="col-md-6">
                                    Reference No: <span class="boderbottomstyle">{{ rand(10000, 99999) }}</span></span>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <span> Date: <span class="boderbottomstyle">{{ date('d-m-Y') }}</span></span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-justify">
                                    <span class="block cursive" style="font-size: 14px; line-height:2;">This is to certify
                                        that <b>{{ $ndata->name ?? '......................' }},
                                        </b>
                                        {{ $ndata->gender == 'Male' ? 'Son' : 'Daughter' }} of
                                        <b>{{ $ndata->father_name ?? '....................................' }}
                                        </b>
                                        and <b>{{ $ndata->mather_name ?? '....................................' }},
                                        </b>
                                        bearing Registration No. <b>{{ $ndata->registration_no ?? '' }},
                                        </b>
                                        Roll No. <b>{{ $ndata->roll ?? '......................' }}
                                        </b>
                                        of Session <b>{{ $ndata->session ?? '........................' }}
                                        </b>
                                        had been a student of the <b>{{ $depart_name }},
                                        </b>
                                        Govt. Saadat College, Karatia, Tangail.
                                        {{ $ndata->gender == 'Male' ? 'He' : 'She' }} Passed the
                                        <b>{{ $departlastName }}</b> Examination in <b>Master's</b> in
                                        <b>{{ $endYear ?? '.........' }}</b>
                                        under National
                                        University held in
                                        <b>{{ $ndata->held_year ?? '...............' }}</b>.
                                        {{ $ndata->gender == 'Male' ? 'He' : 'She' }} obtained CGPA
                                        <b>{{ $ndata->final_cgpa ?? '...............' }}</b> on the scale of 4.00.
                                        <p></p>
                                        <p style="font-size: 14px">
                                            To the best of my knowledge, {{ $ndata->gender == 'Male' ? 'he' : 'she' }}
                                            did not take part in any activity subversive of
                                            the State or of College discipline.
                                            {{ $ndata->gender == 'Male' ? 'He' : 'She' }} bears a good moral character. I
                                            wish
                                            {{ $ndata->gender == 'Male' ? 'Him' : 'Her' }} every success in life.

                                        </p>


                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-7"><!-- LEAVE EMPTY --></div>
                                <div class="col-md-5 text-center">
                                    <img src="{{ asset('public/library_card/' . $headsigniture->signature) }}"
                                        alt="" srcset="" width="200" height="40"
                                        style="margin: -30px 0px 0px 0px">
                                    <p>Principal <br>
                                        Government Saadat College <br>
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
            document.getElementById('download').addEventListener('click', function() {
                // Options for PDF generation
                var options = {
                    margin: 5,
                    filename: 'masters_testimonial.pdf',
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

                // Element to be converted to PDF
                var element = document.querySelector('.testimonial');

                // Generate PDF
                html2pdf(element, options);
            });
        </script>
    @endsection
