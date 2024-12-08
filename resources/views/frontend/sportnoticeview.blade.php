
@extends('layouts.master')
@section('content')
   <section id="" class=" bg-white  "  >
    <div class="row mx-1">  

 <div class=" col-md-3   col-sm-6 pt-3 p-0 m-0 pb-5  bg-dark " >
    @foreach ($sidemenu as $nsidemenu)  <div class=" ps-2">
    <i class="fa fa-caret-right"style="color:#089647; font-size:20px;"></i> <a  class=" text-light fw-bold text-uppercase " style="font-size:13px; font-family: Times new roman;   " href="{{url('/'.$nsidemenu->route)}}" >{{$nsidemenu->title}}</a> <hr>  </div> @endforeach 

</div>
 <div class="col-md-9  col-sm-9  border p-0 m-0 pb-5 ">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h4><span class="sucontainer bg-white bheading">Sports Notice Board </span></h4>
      
          </div>
    
        <div class="ftco-search">
                    <div class="row">
          
              <div class="col-md-12 tab-wrap">
                
                <div class="tab-content" id="v-pills-tabContent">

                  <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">  @foreach ($data as $ndata)
                    <div class="speaker-wrap ftco-animate d-flex">
                     
                        <div class="text pl-md-5">
       <div class="row bo ">
    <div class="col-lg-1 col-sm-2  event-teaser text-right"><div class=" event--content">
            <div class="  col event--date-box">
                    <div>{{ date('M', strtotime( $ndata->date));}} <div class="event--day nowrap">{{ date('d', strtotime( $ndata->date));}}</div></div>
</div></div> </div>
    <div class="col-lg-5 col-sm-5 pt-3 event--info"> 
               
                <div class="event--details">
                    <div class="event--times"><i class="fas fa-clock"></i> {{$ndata->time}}</div>
                                            <div class="event--location"><i class="fas fa-map-marker-alt"></i> {{$ndata->place}} </div>
                                    </div>
            </div> 
</div>  
                            
                            
                            <h2><a href="#">{{$ndata->title}}</a></h2>
                            <p style="font-size:10px;">{!!$ndata->details!!} </p>
                          
                        </div>
                    </div> @endforeach
             
                   
                  </div>

                
                   
                  
                  
                 
                </div>
              </div>
            </div>
        </div>
            </div>
     </div>
        





        </section>
 @endsection
 