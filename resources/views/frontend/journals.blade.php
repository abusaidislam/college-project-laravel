@extends('layouts.master')
@section('content')
    <div class=" bg-white">


        <div class="row mx-1">



            <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark ">
                <div class=" ps-2">
                    <ul style=" list-style: none;">
                        <li> <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                                class=" text-light fw-bold text-uppercase "
                                style="font-size:13px; font-family: Times new roman;"
                                href="journals-of-saadat-college">Journal of Saadat
                                College</a>
                        </li>

                    </ul>
                    <ul style=" list-style: none;">
                        <li> <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                                class=" text-light fw-bold text-uppercase "
                                style="font-size:13px; font-family: Times new roman;   " href="college-magazines">College
                                Magazines</a>
                        </li>
                    </ul>
                    <ul style=" list-style: none;">
                        <li> <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                                class=" text-light fw-bold text-uppercase "
                                style="font-size:13px; font-family: Times new roman;   " href="other-publications">Other
                                Publications</a>
                        </li>
                    </ul>

                    <hr>
                </div>

            </div>

            <div class="col-md-9 col-sm-8">

                <div class="row pt-3  col-md-12  col-sm-12 text-center">
                    <h2>Journal Of Saadat College</h2>


                </div>
                <div class="x_content pt-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">


                                <table id="datatable-responsive"
                                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>

                                            <th class="text-center">Serial No</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Document</th>

                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($journal as $ndata)
                                            <?php $i++; ?>
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>

                                                <td class="text-center">{{ $ndata->title }} </td>
                                                <td class="text-center"><a
                                                        href="{{ asset('public/journal_saadat/' . $ndata->file) }}" download
                                                        class="btn btn-info ">
                                                        <i class="fa fa-download"></i> Download
                                                    </a> <span class="fa fa-view"></span> <a
                                                        href="{{ asset('public/journal_saadat/' . $ndata->file) }}"
                                                        target="_blank" class="btn btn-info ">
                                                        view
                                                    </a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>

                </div>
            </div>








        </div>
    </div>
@endsection
