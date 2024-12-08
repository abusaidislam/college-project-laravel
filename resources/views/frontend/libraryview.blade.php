<!DOCTYPE html>
<html lang="en">

<head>

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
                    <div class="row p-4 pb-3">
                        <div class="col-sm-4 text-end">
                            <h3 class="allfont">List Of Personnel </h3>
                        </div>
                        <div class="col-sm-6 text-start fonts">
                            <input class="form-control" style="width:50%" type="search" name="search" id="search"
                                placeholder="Search.......">
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
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Designation</th>
                                                    <th class="text-center">Mobile No.</th>
                                                    <th class="text-center">First join</th>
                                                    <th class="text-center">Present join</th>
                                                    <th class="text-center">Blood Group</th>
                                                    <th class="text-center">Email</th>
                                                    <th>Home District</th>
                                                </tr>
                                            </thead>
                                            <tbody> @php($i = 1)
                                                @foreach ($data as $ndata)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td class="text-center"><img
                                                                src="{{ asset('public/librain/' . $ndata->photo) }} "
                                                                alt="" width="80" height="80"> </td>
                                                        <td class="text-center">{{ $ndata->name }}</td>
                                                        <td class="text-center">{{ $ndata->designation }} </td>
                                                        <td class="text-center">{{ $ndata->mobile_no }} </td>
                                                        <td class="text-center">{{ $ndata->first_join }} </td>
                                                        <td class="text-center">{{ $ndata->present_join }} </td>
                                                        <td class="text-center">{{ $ndata->blood_group }} </td>
                                                        <td class="text-center">{{ $ndata->email }} </td>
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
                </div>
            </div>
        </section>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script>
            var baseUrl = "{{ asset('') }}";
        </script>
        <script>
            $(document).ready(function() {
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $.ajax({
                        url: "{{ url('librainansearch') }}",
                        type: 'GET',
                        data: {
                            'search': value
                        },
                        success: function(data) {
                            output = "<tr>";
                            $.each(data, function(key, value) {
                                output += "<td>" + value.id + "</td>";

                                // Use the baseUrl variable to construct the image URL
                                output += "<td> <img src='" + baseUrl + 'public/librain/' +
                                    value.photo +
                                    "'  width='100' height='80'></td>";

                                output += "<td>" + value.name + "</td>";
                                output += "<td>" + value.designation + "</td>";
                                output += "<td> " + value.mobile_no + "</td>";
                                output += "<td> " + value.first_join + "</td>";
                                output += "<td> " + value.present_join + "</td>";
                                output += "<td>" + value.blood_group + "</td>";
                                output += "<td>" + value.email + "</td>";
                                output += "<td>" + value.home_dis + "</td></tr>";
                            });
                            $('tbody').html(output);
                        }
                    })
                });
            });
        </script>
    @endsection
