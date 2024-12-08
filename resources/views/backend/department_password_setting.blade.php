@extends('layouts.department')
@section('title', 'Department Setting Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Department Update Setting</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-6">
                                <form method="POST" id="form" name="form" class="form-horizontal"
                                action="{{ route('department_setting.store') }}" enctype="multipart/form-data">
                                @csrf()

                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label"> Department Name </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Department Name" value="{{ $data->name }}"  maxlength="50" required="">
                                    </div>
                                </div>
                               <div class="form-group">
                                        <label for="name" class="col-sm-12 control-label"> Department Code </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="code" name="code"
                                                placeholder="Department Code" value="{{ $data->code }}" readonly required="">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label"> Email / Login Id </label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Id" value="{{ $data->email }}"required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label"> Password </label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" value=""  value="{{ $data->password }}" maxlength="50" required="">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label"> Faculty </label>
                                    <div class="col-sm-12">
                                        <select name="faculty" id="faculty" class="form-control">
                                            <option value="">Select Faculty</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}" {{ $faculty->id == $data->faculty ? 'selected' : '' }}>
                                                    {{ $faculty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class=" col-sm-offset-2 col-sm-10 my-2">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Update</button>
                                    <button type="button" class="btn btn-danger" id="close"
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
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('department_setting.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#faculty').val(data.faculty);

            })
        });


        /*------------------------------------------
        --------------------------------------------
        Delete itemInfo Code
        --------------------------------------------
        --------------------------------------------*/

    });
</script>
@endsection
