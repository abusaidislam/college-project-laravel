@extends('frontend.administrationlayout')
@section('administrationcontent')
    <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
        <div class="row pt-3  col-md-12  col-sm-12 pb-4">
            <div class="col-sm-12 text-center">
                <h3 class="allfont"><span style="border-bottom: 3px solid rgb(41, 206, 227)">TEACHER COUNCIL HONOUR
                        BOARD</span></h3>
            </div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="example" class="display nowrap table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr class="headdata">
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Designation</th>
                                    <th>Academic Designation</th>
                                    <th>Department</th>
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
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                            </thead>
                            <tbody> @php($i = 1)
                                @foreach ($data as $ndata)
                                    <tr class="headdata">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ndata->name }}</td>
                                        <td> <img src="{{ asset($ndata->photo) }}" alt="" width="100"
                                                height="80"> </td>
                                        <td>{{ $ndata->designation }} </td>
                                        <td>{{ $ndata->academicdesignation }} </td>
                                        <td>{{ $ndata->department }} </td>
                                        <td>{{ $ndata->bcs_batch }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col border-end">{{ $ndata->from }} - {{ $ndata->to }} </div>

                                            </div>
                                        </td>
                                        <td>{{ $ndata->mobile_no }} </td>
                                        <td>{{ $ndata->email }} </td>
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
