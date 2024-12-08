@extends('layouts.department')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <h4 class="text-success text-center">{{ Session::get('massage') }}</h4>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Honours First Year Student Edit Information</h2>
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
            $.get("{{ route('honours-first-year-students.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#studentclass').val(data.studentclass);
                $('#father_name').val(data.father_name);
                $('#mather_name').val(data.mather_name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#mobile_no').val(data.mobile_no);
                $('#father_mobile').val(data.father_mobile);
                $('#blood_group').val(data.blood_group);
                $('#home_dis').val(data.home_dis);
                $('#register_roll').val(data.register_roll);
                $('#session').val(data.session);
                $('#roll').val(data.roll);
                $('#photo').val(data.photo);
            })
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
                    url: 'honours-first-year-students/' + id,
                    success: function(data) {
                        window.location = 'honours-first-year-students'
                    }

                });
            }
            return false;
        });
        $('#closemodal').click(function() {
            $('#ajaxModel').modal('hide');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        $('#createNew1').click(function() {
            $('#ajaxModel1').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });
        $('#closemodal1').click(function() {
            $('#ajaxModel1').modal('hide');
        });

        // $('#close').click(function() {
        //     $('#ajaxModel1').modal('hide');

        // });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        $('#createNew2').click(function() {
            $('#ajaxModel2').modal('show');
            $('#modelHeading').html("Create New");
            $('#form').trigger("reset");
            $('#saveBtn').html('Save');
            $('#id').val('');
        });
        $('#closemodal2').click(function() {
            $('#ajaxModel2').modal('hide');
        });

        // $('#close').click(function() {
        //     $('#ajaxModel1').modal('hide');

        // });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                }
            });

            $('#editable').Tabledit({
                url: '{{ route('tabledit.action') }}',
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
