@extends('frontend.administrationlayout')
@section('administrationcontent')
    <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
        <div class="row pt-3  col-md-12  col-sm-12 pb-4">
            <div class="col-sm-12 text-center">
                <h3 class="allfont"><span style="border-bottom: 3px solid rgb(41, 206, 227)">TEACHERS</span></h3>
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
                                    <th>Department</th>
                                    <th>BCS_Batch</th>
                                    <th>First<br>Joining</th>
                                    <th>Present<br>Joining</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Home District</th>
                                    <th>Blood Group</th>
                            </thead>
                            <tbody id="">@php($i = 1)
                                @foreach ($mergedData as $ndata)
                                    <tr class="headdata">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ndata->name }}</td>
                                        <td><img src="{{ asset($ndata->photo) }} " alt="" width="100"
                                                height="80"> </td>
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
                                        @if ($ndata->department == null)
                                            <td>Department of Degree </td>
                                        @else
                                            <td>{{ $ndata->department }} </td>
                                        @endif
                                        <td style="text-align: center">{{ $ndata->bcs_batch }} </td>
                                        <td>{{ $ndata->first_joining }} </td>
                                        <td>{{ $ndata->present_joining }} </td>
                                        <td>{{ $ndata->mobile_no }} </td>
                                        <td>{{ $ndata->email }} </td>
                                        <td>{{ $ndata->home_dis }} </td>
                                        <td>{{ $ndata->blood_group }} </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
