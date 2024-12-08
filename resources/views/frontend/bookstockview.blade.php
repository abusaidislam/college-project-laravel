@extends('layouts.master')
@section('content')
    <section class=" bg-white">
        <div class="row mx-1 ">
            <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 bg-dark ">
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
                        <h3 class="allfont">Book Stock </h3>
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
                                                <th class="text-center">Photo</th>
                                                <th class="text-center">Book Name</th>
                                                <th class="text-center">Author</th>
                                                <th class="text-center">Publication</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Number Of Books</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td class="text-center"><img
                                                            src="{{ asset('public/library_book/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td class="text-center">{{ $ndata->book_name }}</td>
                                                    <td class="text-center">{{ $ndata->author }} </td>
                                                    <td class="text-center">{{ $ndata->publiction }} </td>
                                                    <td class="text-center">{{ $ndata->price }} </td>
                                                    <td class="text-center">{{ $ndata->number_of_copies }} </td>
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
                    url: "{{ url('librarybookstock') }}",
                    type: 'GET',
                    data: {
                        'search': value
                    },
                    success: function(data) {
                        output = "<tr>";
                        $.each(data, function(key, value) {


                            // Use the baseUrl variable to construct the image URL
                            output += "<td> <img src='" + baseUrl +
                                'public/library_book/' +
                                value.photo +
                                "'  width='100' height='80'></td>";

                            output += "<td>" + value.book_name + "</td>";
                            output += "<td>" + value.author + "</td>";
                            output += "<td> " + value.publiction + "</td>";
                            output += "<td> " + value.price + "</td>";
                            output += "<td>" + value.number_of_copies + "</td></tr>";
                        });
                        $('tbody').html(output);
                    }
                })
            });
        });
    </script>
@endsection
