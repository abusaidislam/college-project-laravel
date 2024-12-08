@extends('frontend.administrationlayout')
@section('administrationcontent')
    <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
        <div class="row pt-3  col-md-12  col-sm-12 pb-4">
            <div class="col-sm-12 text-center">
                <h3 class="allfont"><span style="border-bottom: 3px solid rgb(41, 206, 227)">PRINCIPAL</span>
                </h3>
            </div>
        </div>
        <div class="row pb-5 ">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="" class="table table-striped table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th> &nbsp; &nbsp;&nbsp;Photo &nbsp; &nbsp; &nbsp;</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Th</th>
                                <th>Department</th>
                                <th>BCS_Batch</th>
                                <th>Mobile No.</th>
                                <th>Blood Group</th>
                                <th>Email</th>
                                <th>Home District</th>
                            </tr>
                        </thead>
                        <tbody id="list">
                            @foreach ($principal as $ndata)
                                <tr>
                                    <td class="text-center"><img src="{{ asset($ndata->photo) }} "
                                            style="width: 100px; height: 80px;"> </td>
                                    <td class="text-center">{{ $ndata->name }}</td>
                                    <td class="text-center">{{ $ndata->designation }} </td>
                                    <td class="text-center">{{ $ndata->th }}
                                    </td>
                                    <td class="text-center">{{ $ndata->department }} </td>
                                    <td class="text-center">{{ $ndata->bcs_batch }}</td>
                                    <td class="text-center">{{ $ndata->mobile_no }} </td>
                                    <td class="text-center">{{ $ndata->blood_group }}
                                    </td>
                                    <td class="text-center"> {{ $ndata->email }} </td>
                                    <td class="text-center">{{ $ndata->home_dis }}
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
@endsection
