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
            <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
                <div class="row ">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title py-3">
                                <h2>List Of Sports Teacher</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                            <table id="datatable-responsive"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">SL</th>
                                                        <th class="text-center">Photo</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Designation</th>
                                                        <th class="text-center">Mobile No.</th>
                                                        <th class="text-center">Email</th>
                                                        <th class="text-center">From</th>
                                                        <th class="text-center">To</th>
                                                        <th class="text-center">Blood Group</th>
                                                        <th class="text-center">Home District</th>
                                                    </tr>
                                                </thead>
                                                <tbody> @php($i = 1)
                                                    @foreach ($data as $ndata)
                                                        <tr>
                                                            <td class="text-center">{{ $i++ }}</td>
                                                            <td class="text-center"><img
                                                                    src="{{ asset('sportsteacher/' . $ndata->photo) }} "
                                                                    alt="" width="80" height="80"> </td>
                                                            <td class="text-center">{{ $ndata->name }}</td>
                                                            <td class="text-center">{{ $ndata->designation }} </td>
                                                            <td class="text-center">{{ $ndata->mobile_no }} </td>
                                                            <td class="text-center">{{ $ndata->email }} </td>
                                                            <td class="text-center">{{ $ndata->first_join }} </td>
                                                            <td class="text-center">{{ $ndata->present_join }} </td>
                                                            <td class="text-center">{{ $ndata->blood_group }}</td>
                                                            <td class="text-center">{{ $ndata->home_dis }} </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </section>
@endsection
