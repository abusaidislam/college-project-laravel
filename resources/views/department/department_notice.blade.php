 <meta name="_token" content="{{ csrf_token() }}">
 @extends('layouts.master')
 @section('content')
     <section id="" class=" bg-white  ">
         <div class="row mx-1">

             <div class=" col-md-3   col-sm-6 pt-2 p-0 m-0 pb-5  bg-dark ">
                 @foreach ($sidemenu as $nsidemenu)
                     <div class=" ps-2">
                         <i class="fa fa-angle-right"style="color:#ffffff; font-size:20px;"></i> <a
                             class=" text-light fw-bold text-uppercase "
                             style="font-size:13px; font-family: Times new roman;   "
                             href="/department_notice/{{ $nsidemenu->id }}">{{ $nsidemenu->title }}</a>
                         <hr>
                     </div>
                 @endforeach

             </div>

             <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">

                 <div class="x_title">
                     <h2 class="text-center"> Department Notice Board </h2>


                 </div>
                 <div class="x_content">
                     <div class="row mx-5">
                         <div class="col-sm-12 col-lg-12  bg-success text-center text-light fw-bold">
                             @foreach ($notice as $nnotice)
                                 {{ $nnotice->title }}
                             @endforeach
                         </div>

                         <p class="text-end">{{ date('D', strtotime($nnotice->dates)) }}day,
                             {{ date('d', strtotime($nnotice->dates)) }} {{ date('F', strtotime($nnotice->dates)) }}
                             {{ date('Y', strtotime($nnotice->dates)) }}</p>



                         <p class="text-start"> {!! $nnotice->details !!}</p>

                         <hr>
                         <p> <a href="/{{ asset('public/DepartmentNotice/' . $nnotice->document) }}"><i
                                     class="fa fa-file-pdf-o me-3" style="font-size:48px;color:red"></i>
                                 {{ $nnotice->title }} </a></p>
                     </div>
                 </div>
             </div>
             <div class="my-5"></div>
     </section>
 @endsection
