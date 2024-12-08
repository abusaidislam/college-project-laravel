@extends('layouts.department')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Masters Final Year Student Edit Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="container">
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                @csrf
                                                <table id="editable" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Register Roll</th>
                                                            <th>Student Name</th>
                                                            <th>Roll</th>
                                                            <th>Regi No.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($studentEditData as $row)
                                                            <tr>
                                                                <td>{{ $row->id }}</td>
                                                                <td>{{ $row->name }}</td>
                                                                <td>{{ $row->roll }}</td>
                                                                <td>{{ $row->registration_no }}</td>
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


                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                }
            });

            $('#editable').Tabledit({
                url: '{{ route('masterstabledit.action') }}',
                dataType: "json",
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'name'],
                        [2, 'roll'],
                        [3, 'registration_no']
                    ]
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id).remove();
                    }
                }
            });

        });
    </script>
@endsection
