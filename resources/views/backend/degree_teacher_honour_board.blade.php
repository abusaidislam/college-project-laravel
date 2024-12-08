@extends('layouts.degreeapp')
@section('title', 'Teachers Honour Board Manage |')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Teachers Honour Board Information</h2>
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
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>BCS_Batch</th>
                                                <th>
                                                    <div class="row ">
                                                        <div class="col text-center border-bottom ">Period</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col ">From</div> -
                                                        <div class="col text-center">To</div>
                                                    </div>
                                                </th>
                                                <th>Blood Group</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Home District</th>
                                                <th>Date of Birth</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $ndata)
                                            <tr>
                                                <td><img src="{{ asset('public/teachers/' . $ndata->photo) }} " alt=""
                                                        width="100" height="80"> </td>
                                                <td>{{ $ndata->name }}</td>
                                                @if ($ndata->designation == 1)
                                                <td>Professor</td>
                                                @elseif ($ndata->designation == 2)
                                                <td>Associate Professor</td>
                                                @elseif ($ndata->designation == 3)
                                                <td>Assistant Professor</td>
                                                @elseif ($ndata->designation == 4)
                                                <td>Lecturer</td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>{{ $ndata->bcs_batch }} </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col border-end">{{ $ndata->present_joining }} -
                                                            {{
                                                            \Carbon\Carbon::parse($ndata->updated_at)->format('d-m-Y')
                                                            }}
                                                        </div>

                                                    </div>
                                                </td>

                                                <td>{{ $ndata->blood_group }} </td>
                                                <td>{{ $ndata->mobile_no }} </td>
                                                <td>{{ $ndata->email }} </td>
                                                <td>{{ $ndata->home_dis }} </td>
                                                <td>{{ $ndata->date_of_birth }} </td>

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

            $.get("{{ route('degree-teacher.index') }}" + '/' + id + '/edit', function(data) {
                $('#ajaxModel').modal('show');
                $('#modelHeading').html("Edit");
                $('#saveBtn').html('Update');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#designation').val(data.designation);
                $('#home_dis').val(data.home_dis);
                $('#department').val(data.department);
                $('#bcs_batch').val(data.bcs_batch);
                $('#first_joining').val(data.first_joining);
                $('#present_joining').val(data.present_joining);
                $('#date_of_birth').val(data.date_of_birth);
                $('#rcl_date').val(data.rcl_date);
                $('#blood_group').val(data.blood_group);
                $('#mobile_no').val(data.mobile_no);
                $('#status').val(data.status);

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
                        url: 'degree-teacher/' + id,
                        success: function(data) {
                            window.location = 'degree-teacher';
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