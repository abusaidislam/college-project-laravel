@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <h2>Froms Manage</h2>
                <div class="x_title">
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            @foreach ($alldata as $nalldata)
                                <li> <a style="font-size:15px;" href=" {{ $nalldata->id }}">{{ $nalldata->title }}</a></li>
                            @endforeach
                        </div>
                        <div class="col-sm-12  col-md-9 ">
                            <div class="text-center">
                                <h2>{{ $data->title }}</h2>
                            </div>
                            <iframe src="{{ asset('public/forms/' . $data->file) }}" width="700px" height="500px"></iframe>
                        </div>

                    </div>

                </div>
            </div>
        </div>



    </div>
@endsection
