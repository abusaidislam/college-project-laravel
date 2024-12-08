 <meta name="_token" content="{{ csrf_token() }}">
 @extends('layouts.master')
 @section('content')
     <section id="" class=" bg-white  ">
         <div class="row mx-1">
             <div class=" col-md-2   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark ">
                 @foreach ($sidemenu as $nsidemenu)
                     <div class=" ps-2">
                         <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                             class=" text-light fw-bold text-uppercase "
                             style="font-size:13px; font-family: Times new roman;   "
                             href="{{ $nsidemenu->id }}">{{ $nsidemenu->name }}</a>
                         <hr>
                     </div>
                 @endforeach
                 <div class=" ps-2">
                     <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a
                         class=" text-light fw-bold text-uppercase "
                         style="font-size:13px; font-family: Times new roman;   "
                         href="{{ url('class_schedules/20') }}">DEPARMENT OF DEGREE</a>
                     <hr>
                 </div>
             </div>

             <div class="col-md-10 col-sm-10">

                 <div class="row ">
                     <table id="" class="table table-striped table-bordered  nowrap">
                         <thead>
                             <tr>

                                 <th width="280px">Day/Time</th>
                                 <th width="280px">9.00--9.45 </th>
                                 <th width="280px">9.45--10.30</th>
                                 <th width="280px">10.30--11.15</th>
                                 <th width="280px">11.15--12.00</th>
                                 <th width="280px">12.00--12.45</th>
                                 <th width="280px">12.45--1.30</th>
                                 <th width="280px">1.30--2.00</th>
                                 <th width="280px">2.00--2.45</th>
                                 <th width="280px">2.45--3.30</th>
                             </tr>
                         </thead>
                         <tbody id="list">
                             @foreach ($data as $ndata)
                                 <tr>
                                     <td>{{ $ndata->day }}

                                     </td>
                                     <td>
                                         <pre>{!! $ndata->fitst !!}</pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->scend }} </pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->third }} </pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->forth }}</pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->fifth }} </pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->sixth }}</pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->seventh }} </pre>
                                     </td>
                                     <td>
                                         <pre>{{ $ndata->eight }} </pre>
                                     </td>
                                     {{-- <td>
                                         <pre>{{ $ndata->nine }} </pre>
                                     </td> --}}

                                 </tr>
                             @endforeach
                         </tbody>
                     </table>

                 </div>

             </div>


     </section>
 @endsection
