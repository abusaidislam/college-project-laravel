@extends('layouts.master')
@section('content')
    <section id="master" class=" master bg-white allfont">

        <div class="row  p-5">
            <div class="col-sm-4 text-end"></div>

            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">


                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap "
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-center bg-success text-light">

                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Session</th>
                                        <th>Year</th>
                                        <th>Publish Date</th>
                                        <th>Download</th>
                                </thead>
                                <tbody id="list"> @php($i = 1)
                                    @foreach ($data as $ndata)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $ndata->title }}</td>

                                            <td>{{ $ndata->department }} </td>

                                            <td>{{ $ndata->session }} </td>
                                            <td><?php $studentclass = DB::table('studen_classes')
                                                ->where('id', '=', $ndata->year)
                                                ->get(); ?> @foreach ($studentclass as $nstudentclass)
                                                    {{ $nstudentclass->name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $ndata->publish_date }} </td>
                                            <td><a href="{{ asset('public/academic/' . $ndata->details) }} " Download><i
                                                        class="fa fa-download" aria-hidden="true"></i></a> <a
                                                    href="{{ asset('public/academic/' . $ndata->details) }}"><i
                                                        class='fas fa-file-image'></i></td>



                                        </tr>
                                    @endforeach
                                    @foreach ($degreedata as $item)
                                        {{-- @dd($item); --}}
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>Department of Degree </td>
                                            <td>{{ $item->session }} </td>
                                            <td><?php $stuclass = DB::table('degree_classes')
                                                ->where('id', '=', $item->year)
                                                ->get(); ?> @foreach ($stuclass as $class)
                                                    {{ $class->name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $item->publish_date }} </td>
                                            <td><a href="{{ asset('public/academic/' . $item->details) }} " Download><i
                                                        class="fa fa-download" aria-hidden="true"></i></a> <a
                                                    href="{{ asset('public/academic/' . $item->details) }}"><i
                                                        class='fas fa-file-image'></i></td>



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
