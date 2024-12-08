@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>
            <div class="page-title">
                <div class="title_left">
                    <span class="input-group-btn">
                        <a class="btn btn-success my-2" href="javascript:void(0)" id="createNew"> Create New </a>
                    </span>
                </div>


            </div>





            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Manage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>User Type</th>
                                                <th>Password</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $basic)
                                                <tr id="row_list{{ $basic->id }}">
                                                    <td>{{ $basic->id }}</td>
                                                    <td>{{ $basic->name }}</td>
                                                    <td>{{ $basic->email }} </td>
                                                    <td>{{ $basic->phone }} </td>
                                                    <td>

                                                        @if ($basic->usertype == 0)
                                                            <span>Admin</span>
                                                        @endif
                                                        @if ($basic->usertype == 1)
                                                            <span>Adminisistration</span>
                                                        @endif
                                                        @if ($basic->usertype == 2)
                                                            <span>Principal</span>
                                                        @endif

                                                        @if ($basic->usertype == 3)
                                                            <span>Result</span>
                                                        @endif
                                                        @if ($basic->usertype == 4)
                                                            <span>Library</span>
                                                        @endif
                                                        @if ($basic->usertype == 5)
                                                            <span>Hostel</span>
                                                        @endif
                                                        @if ($basic->usertype == 6)
                                                            <span>Sports</span>
                                                        @endif
                                                        @if ($basic->usertype == 7)
                                                            <span>Arts Faculties </span>
                                                        @endif
                                                        @if ($basic->usertype == 8)
                                                            <span>Science Faculties</span>
                                                        @endif

                                                        @if ($basic->usertype == 9)
                                                            <span>Social Faculties</span>
                                                        @endif

                                                        @if ($basic->usertype == 10)
                                                            <span>Business Faculties</span>
                                                        @endif

                                                    </td>
                                                    <td>{{ $basic->textpassword }} </td>
                                                    <td><button type="button" id="edit" data-id="{{ $basic->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $basic->id }}"
                                                            class="btn btn-sm btn-danger">Delete</button>


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
                                        action="{{ route('usermanage.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Name" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter mail" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Enter Mobile No" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Enter Address" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Password</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Enter password" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">RePassword</label>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" id="repassword"
                                                    name="repassword" placeholder="Enter RePassword" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">User Type</label>
                                            <div class="col-sm-12">
                                                <select name="usertype" id="usertype">

                                                    <option value="1">Adminisistration</option>
                                                    <option value="2">Principal</option>
                                                    <option value="3">Library</option>
                                                    <option value="4">Hostel</option>
                                                    <option value="5">Sports</option>
                                                    <option value="6">CO-Curricular Activity</option>

                                                    @php($i = 7)
                                                    @foreach ($data1 as $ndata1)
                                                        <option value="{{ $i++ }}">{{ $ndata1->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                                aria-label="Close">
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
            $.get("{{ route('usermanage.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#password').val(data.textpassword);
                $('#repassword').val(data.textpassword);
                $('#usertype').val(data.usertype);

            })
        });
    </script>
@endsection
