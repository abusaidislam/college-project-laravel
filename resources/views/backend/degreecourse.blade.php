@extends('layouts.degreeapp')
@section('title', 'Course Information |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course Information</h2>
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
                                                <th>Class Name</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Marks</th>
                                                <th>Credit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list">
                                            @foreach ($data as $ndata)
                                            @php
                                            $className = DB::table('degree_classes')
                                            ->where('id', $ndata->class_id)
                                            ->first();
                                            @endphp
                                            <tr>

                                                <td>{{ $className ? $className->name : '' }}</td>
                                                <td>{{ $ndata->course_code }}</td>
                                                <td>{{ $ndata->name }}</td>
                                                <td>{{ $ndata->marks }}</td>
                                                <td>{{ $ndata->credit }}</td>
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

                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" name="form" class="form-horizontal modal-lg"
                                        action="{{ route('degree-course.store') }}" enctype="multipart/form-data">
                                        @csrf()

                                        <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="department " class="col-sm-12 control-label">Class Name</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="sclass" name="sclass">
                                                    <option class="" value="" selected>--Select --</option>
                                                    @foreach ($class as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('sclass')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-12 control-label">Course Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Course Name" value="{{ old('name') }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="course_code" class="col-sm-12 control-label">Course Code</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="course_code"
                                                    name="course_code" placeholder="Enter Course Code"
                                                    value="{{ old('course_code') }}">
                                                @error('course_code')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="marks" class="col-sm-12 control-label">Marks</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="marks" name="marks"
                                                    placeholder="Enter Subject Marks" value="{{ old('marks') }}">
                                                @error('marks')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit" class="col-sm-12 control-label">Credit</label>
                                            <div class="col-sm-12">
                                                <input type="number" class="form-control" id="credit" name="credit"
                                                    placeholder="Enter Credit Number" value="{{ old('credit') }}">
                                                @error('credit')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" col-sm-offset-2 col-sm-10 my-2">

                                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
                                            <button type="button" class="btn btn-danger" id="closemodal"
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

            $.get("{{ route('degree-course.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#sclass').val(data.class_id);
                $('#course_code').val(data.course_code);
                $('#credit').val(data.credit);
                $('#marks').val(data.marks);
                $('#department').val(data.department);

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
                        url: 'degree-course/' + id,
                        success: function(data) {
                            window.location = 'degree-course';
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