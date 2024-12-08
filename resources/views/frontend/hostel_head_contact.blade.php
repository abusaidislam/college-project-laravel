@extends('layouts.master')
@section('content')
    <section id="master" class=" bg-white ">
        <div class="row mx-1">
            <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0  bg-dark ">
                @foreach ($sidemenu as $nsidemenu)
                    <div class=" ps-2">
                        <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                            class=" text-light fw-bold text-uppercase "
                            style="font-size:13px; font-family: Times new roman;   "
                            href="{{ $nsidemenu->route }}">{{ $nsidemenu->title }}</a>
                        <hr>
                    </div>
                @endforeach

            </div>

            <div class="col-md-9 col-sm-8">
                <div class="row pt-5 pb-3">
                    <div class="col-sm-8 text-end">
                        <h3 class="allfont">Hostel Head Contact Information </h3>
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
                                                <th>SL</th>
                                                <th class="text-center">Photo</th>
                                                <th class="text-center">Hostel Name</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Department Name</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">Mobile No.</th>


                                            </tr>
                                        </thead>
                                        <tbody> @php($i = 1)
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td class="text-center"><img
                                                            src="{{ asset('public/hostel_card/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td class="text-center">{{ $ndata->hostel_name }}</td>
                                                    <td class="text-center">{{ $ndata->title }}</td>
                                                    @if ($ndata->dept_name == '40')
                                                        <td class="text-center">Department of General</td>
                                                    @else
                                                        <td class="text-center">{{ $ndata->dept_name }}</td>
                                                    @endif
                                                    <td class="text-center">{{ $ndata->designation }} </td>
                                                    <td class="text-center">{{ $ndata->mobile }} </td>
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
    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#search').change(function() {
                var value = $(this).find('option:selected').val();

                if (value) {
                    $.ajax({
                        url: "{{ url('librainansearch') }}/" + value,
                        type: 'GET',
                        cache: false,
                        dataType: "json",
                        success: function(data) {

                            var output = '';

                            for (let i = 0; i < data.length; i++) {
                                output += "<tr>";
                                output += "<td class='text-center'>" + i + "</td>";
                                output += "<td class='text-center'> <img src='librain/" + data[
                                    i].photo + "'  width='auto' height='80'></td>";
                                output += "<td class='text-center'>" + data[i].name + "</td>";
                                output += "<td class='text-center'>" + data[i].designation +
                                    "</td>";
                                output += "<td class='text-center'>" + data[i].mobile_no +
                                    "</td>";

                                output += "<td class='text-center'>" + data[i].first_join +
                                    "</td>";
                                output += "<td class='text-center'>" + data[i].present_join +
                                    "</td>";
                                output += "<td class='text-center'> " + data[i].blood_group +
                                    "</td>";
                                output += "<td class='text-center'>" + data[i].email + "</td>";
                                output += "<td class='text-center'>" + data[i].home_dis +
                                    "</td>";
                                $('tbody').html(output);


                            }
                        }

                    })
                }
            });

        });
    </script>
@endsection
