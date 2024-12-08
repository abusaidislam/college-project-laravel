@extends('layouts.app')
@section('title', 'Basic Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Basic Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <span class="input-group-btn">
                                    <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Create New </a>
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
                                                <th>No.</th>
                                                <th>Institute Name</th>
                                                <th>Institute Title</th>
                                                <th>LOGO</th>Title
                                                <th>citizen</th>
                                                <th>Principal Office</th>
                                                <th> Arts</th>
                                                <th>Science</th>
                                                <th>Portal</th>
                                                <th> Social Science</th>
                                                <th> Business </th>
                                                <th>Mail</th>
                                                <th>Links</th>
                                                <th>Current users</th>
                                                <th>bangabandhu</th>
                                                <th>golden_jubilee</th>
                                                <th>Class_s</th>
                                                <th>bus_s</th>
                                                <th>Journal</th>
                                                <th>Forms</th>
                                                <th>APA</th>
                                                <th>NIS</th>
                                                <th>Innovation</th>
                                                <th>Elearning</th>
                                                <th>Mobile No.</th>
                                                <th>Facebook Link</th>
                                                <th>Twitter Link</th>
                                                <th>What'app Link</th>
                                                <th>Skype Link</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                                <tr id="row_list{{ $ndata->id }}">
                                                    <td>{{ $ndata->id }}</td>
                                                    <td>{{ $ndata->company_name }}</td>
                                                    <td>{{ $ndata->company_email }} </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->logo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td> <img src="{{ asset('public/basic/' . $ndata->citizen) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->principaloffice) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td> <img src="{{ asset('public/basic/' . $ndata->arts) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->science) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->portal) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->socialscience) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->business) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->mail) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->links) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->currentusers) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->bangabandhu) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->golden_jubilee) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->Class_s) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->bus_s) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->Journal) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->forms) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->apa) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->nis) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->innovation) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td><img src="{{ asset('public/basic/' . $ndata->elearning) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->facebook }} </td>
                                                    <td>{{ $ndata->twitter }} </td>
                                                    <td>{{ $ndata->instragram }} </td>
                                                    <td>{{ $ndata->skype }} </td>
                                                    <td><button type="button" id="edit"
                                                            data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>



                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" id="ajaxModel" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal"
                                        action="{{ route('basicinfo.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Institute Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Institute Name" value="" maxlength="50"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label">Institute Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    placeholder="Institute Title" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12 control-label"><strong>Institute Address
                                                    :</strong></label>
                                            <textarea class="summernote" placeholder="Enter Address" id="address"name="address"></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-12 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile_no"
                                                    name="mobile_no" placeholder="Enter Mobile No." value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-12 control-label">Facebook Link</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="fbl" name="fbl"
                                                    placeholder="Enter Facebook Link" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="department" class="col-sm-12 control-label">Twitter Link </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="twl" name="twl"
                                                    placeholder="Enter Twitter Link" value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-12 control-label">What'app Link</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="whl" name="whl"
                                                    placeholder="Enter What'app Link" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-12 control-label">Skype Link</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="skl" name="skl"
                                                    placeholder="Enter Skype Link" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="apa" class="col-sm-12 control-label">APA</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="apa" name="apa"
                                                    placeholder="Enter APA" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nis" class="col-sm-12 control-label">NIS</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="nis" name="nis"
                                                    placeholder="Enter NIS" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="innovation" class="col-sm-12 control-label">Innovation</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="innovation"
                                                    name="innovation" placeholder="Enter innovation" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="elearning" class="col-sm-12 control-label">Elearning</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="elearning"
                                                    name="elearning" placeholder="Enter elearning" value="">
                                            </div>
                                        </div>
                                </div>
                             
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">

                                            <label for="photo" class="col-sm-12 control-label">LOGO</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="Citizen Charter" class="col-sm-12 control-label">Citizen
                                                Charter</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="citizen" name="citizen"
                                                    placeholder="Enter Citizen Charter" value="">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="bangabandhu" class="col-sm-12 control-label">Principal
                                                Office</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="principaloffice"
                                                    name="principaloffice" value="">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="golden_jubilee" class="col-sm-12 control-label">Arts</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="arts" name="arts"
                                                    value="">


                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <label for="Class_s" class="col-sm-12 control-label">science</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="sciencescience"
                                                    name="science" value="">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="bus_s" class="col-sm-12 control-label">Online Portal</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="portal" name="portal"
                                                    value="">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="Journal" class="col-sm-12 control-label">Social Science</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="socialscience"
                                                    name="socialscience" value="">


                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <label for="Citizen Charter" class="col-sm-12 control-label"> Mail</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="mail" name="mail"
                                                    value="">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="Citizen Charter" class="col-sm-12 control-label"> Business</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="business"
                                                    name="business" value="">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="Citizen Charter" class="col-sm-12 control-label">Quick
                                                Links</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="links"
                                                    name="links">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="bangabandhu" class="col-sm-12 control-label">Forms</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="forms" id="forms" name="forms">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="golden_jubilee" class="col-sm-12 control-label">Current
                                                users</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="currentusers"
                                                    name="currentusers">


                                            </div>
                                        </div>



                                        <div class="form-group">

                                            <label for="bangabandhu" class="col-sm-12 control-label">bangabandhu</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="bangabandhu"
                                                    name="bangabandhu" placeholder="Enter bangabandhu" value="">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="golden_jubilee"
                                                class="col-sm-12 control-label">golden_jubilee</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="golden_jubilee"
                                                    name="golden_jubilee" placeholder="Enter golden_jubilee"
                                                    value="">


                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <label for="Class_s" class="col-sm-12 control-label">Class_s</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="Class_s" name="Class_s"
                                                    placeholder="Enter Class_s" value="">


                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="bus_s" class="col-sm-12 control-label">bus_s</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="bus_s" name="bus_s"
                                                    placeholder="Enter bus_s" value="">


                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="Journal" class="col-sm-12 control-label">Journal</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="Journal" name="Journal"
                                                    placeholder="Enter Journal" value="">


                                            </div>
                                        </div>
                                       
                                    </div> 
                               
                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="close"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                close
                                            </button>
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
</div>

    <script type="text/javascript">
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })






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
                $.get("{{ route('basicinfo.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit");
                    $('#saveBtn').html('Update');
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.company_name);
                    $('#email').val(data.company_email);
                    $('#address').summernote('code', data.address);
                    $('#mobile_no').val(data.mobile_no);
                    $('#fbl').val(data.facebook);
                    $('#twl').val(data.twitter);
                    $('#whl').val(data.instragram);
                    $('#skl').val(data.skype);
                    $('#photo').val(data.logo);

                })
            });



            /*------------------------------------------
            --------------------------------------------
            Delete ndataInfo Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '#delete', function() {

                var id = $(this).data("id");
                var name = $(this).data("name");
                confirm("Are You sure want to delete !" + name);

                $.ajax({
                    type: "DELETE",
                    url: 'administration/' + id,
                    success: function(data) {
                        window.location = 'administration'
                    }

                });
            });


        });


        $('#close').click(function() {
            $('#ajaxModel').modal('hide');

        });
    </script>
@endsection
