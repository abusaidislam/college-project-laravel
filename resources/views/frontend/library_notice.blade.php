@extends('layouts.master')
@section('content')
    <section id="" class=" bg-white  ">
        <div class="row mx-1">

            <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark ">
                @foreach ($sidemenu as $nsidemenu)
                    <div class=" ps-2">
                        <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                            class=" text-light fw-bold text-uppercase "
                            style="font-size:13px; font-family: Times new roman;   "
                            href="{{ url('/' . $nsidemenu->route) }}">{{ $nsidemenu->title }}</a>
                        <hr>
                    </div>
                @endforeach

            </div>
            <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">
                <div class="row pt-3  col-md-12  col-sm-12 text-center">
                    <h2>Library Notice Board </h2>
                </div>
                <div class="x_content pt-3 ">
                    <div class="row  pb-5 ">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-responsive"
                                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Publish Date</th>
                                            <th class="text-center">Photo/Document</th>
                                            <th class="text-center">Action</th>

                                    </thead>
                                    <tbody> <?php $i = 0; ?>
                                        @foreach ($data as $ndata)
                                            <?php $i++; ?>
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td class="">{{ $ndata->title }} </td>
                                                <td class="text-center">{{ $ndata->date }} </td>
                                                @if (pathinfo($ndata->photo, PATHINFO_EXTENSION) === 'pdf')
                                                    <td>
                                                        <object data="{{ asset('public/library/' . $ndata->photo) }}"
                                                            type="application/pdf" width="100" height="100">

                                                        </object>

                                                    </td>
                                                @else
                                                    <td>
                                                        <img src="{{ asset('public/library/' . $ndata->photo) }}"
                                                            alt="" width="100" height="100">

                                                    </td>
                                                @endif
                                                <td> <a href="{{ asset('public/library/' . $ndata->photo) }}"
                                                        class="btn btn-info" download>
                                                        Download PDF
                                                    </a> <a href="{{ asset('public/library/' . $ndata->photo) }}"
                                                        target="_blank" class="btn btn-info ">
                                                        view</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-5">
                </div>


            </div>

    </section>
@endsection
