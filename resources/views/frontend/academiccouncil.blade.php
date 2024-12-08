@extends('frontend.administrationlayout')
@section('administrationcontent')
    <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">
        <div class="row pt-3  col-md-12  col-sm-12 pb-4">
            <div class="col-sm-12 text-center">
                <h3 class="allfont"><span style="border-bottom: 3px solid rgb(41, 206, 227)">ACADEMIC COUNCIL</span>
                </h3>
            </div>
        </div>

        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="example" class="display nowrap table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr class="headdata">
                                    <th class="text-center">Photo</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>BCS_Batch</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($academincouncil != '')
                                    @foreach ($academincouncil as $ndata)
                                        <tr class="headdata">
                                            <td class="text-center"><img src="{{ asset($ndata->photo) }} " alt=""
                                                    width="100" height="80"> </td>
                                            <td class="text-center">{{ $ndata->name }}</td>
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
                                            <td>{{ $ndata->department }} </td>
                                            <td class="text-center">{{ $ndata->bcs_batch }}</td>
                                            <td class="text-center">{{ $ndata->mobile_no }} </td>
                                            <td>{{ $ndata->email }} </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ csrf_field() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
