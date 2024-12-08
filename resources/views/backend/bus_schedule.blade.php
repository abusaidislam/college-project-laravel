@extends('layouts.busapp')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">

                </div>


            </div>

            <div class="col-md-12 col-sm-12  bg-secondary">
                <div class="x_panel">
                    <div class="x_title" style="background:#2a3f54;">
                        <h2 class="text-white">Bus Schedule Manage</h2>
                        <ul class="nav navbar-right panel_toolbox"><span class="input-group-btn">
                                <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                            </span>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">


                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                @foreach ($bus_terminals as $nbus_terminals)
                                                    <th>{{ $nbus_terminals->space_name }}</th>
                                                @endforeach

                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr>
                                                    <td>
                                                        @if ($ndata->sokhipur != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->sokhipur }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->gorai != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->gorai }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->mirjapur != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->mirjapur }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->elenga != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->elenga }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->notunbusstand != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->notunbusstand }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->puratonbusstand != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->puratonbusstand }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->college != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->college }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($ndata->note != 0)
                                                            {{ $ndata->bus_no }}){{ $ndata->note }}
                                                        @endif
                                                    </td>

                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info py-0"><i
                                                                class="fa fa-pencil-square-o p-0"
                                                                aria-hidden="true"></i></button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-danger py-0"><i class="fa fa-trash p-0"
                                                                aria-hidden="true"></i></button>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ Route('bus_schedule.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Bus No</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="bus_no" name="bus_no"
                                                    placeholder="Bus No" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">সখিপুর</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="sokhipur" name="sokhipur"
                                                    value="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">গোড়াই</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="gorai" name="gorai"
                                                    value="">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label"> মির্জাপুর </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mirjapur" name="mirjapur"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">এলেঙ্গা</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="elenga" name="elenga"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">টাঙ্গাইল নতুন
                                                বাসস্ট্যান্ড</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="notunbusstand"
                                                    name="notunbusstand" value="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">টাঙ্গাইল পুরাতন
                                                বাসস্ট্যান্ড</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="puratonbusstand"
                                                    name="puratonbusstand" value="">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label"> কলেজ</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="college" name="college"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Note</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="note" name="note"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary " id="close"
                                                data-bs-dismiss="modal" aria-label="Close">Close</button>

                                        </div>
                                    </form>
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })



        });


        $('#createNew').click(function() {
            $('#ajaxModel').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');

        });



        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ Route('bus_schedule.index') }}" + '/' + id + '/edit', function(data) {


                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#bus_no').val(data.bus_no);
                $('#puratonbusstand').val(data.puratonbusstand);
                $('#note').val(data.note);
                $('#college').val(data.college);
                $('#notunbusstand').val(data.notunbusstand);
                $('#puratonbusstand').val(data.puratonbusstand);
                $('#elenga').val(data.elenga);
                $('#mirjapur').val(data.mirjapur);
                $('#gorai').val(data.gorai);
                $('#sokhipur').val(data.sokhipur);


            });


        });


        /*------------------------------------------
        --------------------------------------------
        Delete ndataInfo Code
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#delete', function() {

            var id = $(this).data("id");

            if (confirm("Are You sure want to delete This!")) {
                $.ajax({
                    type: "DELETE",
                    url: 'bus_schedule/' + id,
                    success: function(data) {
                        window.location = 'bus_schedule'
                    }

                });
            }
            return false;


        });


        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
@endsection
