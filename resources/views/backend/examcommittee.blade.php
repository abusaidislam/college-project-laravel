@php
    $userType = DB::table('users')
        ->where('id', $authID)
        ->first();
@endphp

@extends($userType->usertype == 7 ? 'layouts.examapp' : 'layouts.drexamapp')
@section('title', 'Exam Committee Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Exam Committee Information</h2>
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
                                <div class="card-box table-responsive bg-light">
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Exam Name</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Academic Designation</th>
                                                <th>BCS_Batch</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $ndata)
                                                @php
                                                    $examname = DB::table('exam_names')
                                                        ->where('id', $ndata->examname_id)
                                                        ->where('user_id', $ndata->user_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td><img src="{{ asset('public/Exam_committee/' . $ndata->photo) }} "
                                                            alt="" width="80" height="80"> </td>
                                                    <td>{{ $examname ? $examname->title : '' }}</td>
                                                    <td>{{ $ndata->name }}</td>
                                                    <td>{{ $ndata->designation }} </td>
                                                    <td>{{ $ndata->academic_designation }} </td>
                                                    <td>{{ $ndata->bcs_batch }} th </td>
                                                    <td>{{ $ndata->mobile_no }} </td>
                                                    <td>{{ $ndata->email }} </td>
                                                    <td>{{ $ndata->home_dis }} </td>
                                                    <td><button type="button" id="edit" data-id="{{ $ndata->id }}"
                                                            class="btn btn-sm btn-info">Edit</button>
                                                        <button type="button" id="delete" data-id="{{ $ndata->id }}"
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
                            <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                action="{{ route('examcommittee.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Name" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter mail" value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-12 control-label">Name of Exam</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="examname_id" id="examname_id">
                                                    <option value="" selected>--select--</option>
                                                    @foreach ($data1 as $ndata1)
                                                        <option value="{{ $ndata1->id }}">{{ $ndata1->title }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-3 control-label">Mobile No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    placeholder="Enter Mobile No." value="" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="designation" class="col-sm-2 control-label">Designation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="designation" name="designation"
                                                    placeholder="Enter Designation" value="" required="">
                                            </div>
                                        </div>


                                       
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="department" class="col-sm-12 control-label">Academic Designation</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="academic_designation"
                                                    name="academic_designation" placeholder="Enter Academic Designation"
                                                    value="" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="bcs_batch" class="col-sm-2 control-label">BCS_Batch</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="bcs_batch" name="bcs_batch"
                                                    placeholder="Enter BCS_Batch" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">

                                        </div>

                                        <div class="form-group">
                                            <label for="home_dis" class="col-sm-12 control-label">Home District</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="home_dis" name="home_dis"
                                                    placeholder="Enter Home District" required="">
                                            </div>
                                        </div>

                                        @php $currentYear =  date('Y'); @endphp
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-3 control-label"> year</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="year" name="year" required>
                                                    <option class="" value="0" selected>--Select --</option>
                                                    @for ($i = 2000; $i < 2050; $i++)
                                                        <option value="{{ $i }}"
                                                            @if ($currentYear == $i) selected @endif>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="photo" class="col-sm-12 control-label">Photo
                                                (Dimensions:530x650, Max-Size:200kb)</label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    placeholder="Enter Photo" value="">
                                                <span class="text-danger">
                                                    @error('photo')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                    <button type="button" class="btn btn-danger" id="closemodal" aria-label="Close">
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
            $('#dform').trigger("reset");
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

            $.get("{{ route('examcommittee.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#academic_designation').val(data.academic_designation);
                $('#bcs_batch').val(data.bcs_batch);
                $('#examname_id').val(data.examname_id);
                $('#mobile_no').val(data.mobile_no);
                $('#home_dis').val(data.home_dis);
                $('#photo').val(data.photo);
            });
        });





        /*------------------------------------------
                   --------------------------------------------
                   Delete ndataInfo Code
                   --------------------------------------------
                   --------------------------------------------*/
        $('body').on('click', '#delete', function() {
            var id = $(this).data("id");
            Swal.fire(sweetAlertConfirmation).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: 'examcommittee/' + id,
                        success: function(data) {
                            window.location = 'examcommittee';
                            const Toast = Swal.mixin(toastConfiguration);
                            Toast.fire({
                                icon: "success",
                                title: "Deleted Successfully!!!"
                            });
                        }
                    });
                }
            });
            return false;
        });

        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
@endsection
