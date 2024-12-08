@foreach ($event as $nevent)
<div class="row bo">
    <div class="col-lg-3 event-teaser"><div class=" event--content">
			<div class="  col event--date-box">
                	<div>{{ date('M', strtotime( $nevent->date));}} <div class="event--day nowrap">{{ date('d', strtotime( $nevent->date));}}</div></div>
</div></div> </div>
    <div class="col-lg-9  event--info">	
				<a href="/event/555917" class="event--title">{{$nevent->title}}</a>
				<div class="event--details">
					<div class="event--times"><i class="fas fa-clock"></i> {{$nevent->time}}</div>
	                	                    <div class="event--location"><i class="fas fa-map-marker-alt"></i> {{$nevent->place}} </div>
	                				</div>
			</div> 
</div>       @endforeach






<div class="row ">
    	<div class="col-md-4 row"><div class="icon-box" data-aos="zoom-in-left">
      
            <p class="p-2 m-0 title text-dark bg">Faculty of Social Science</p> 
              <ul> 
              <li>Economics</li>
              <li>Social Work</li>
               <li>Political Science</li>
             </ul> 
             <p class="p-2  mb-2 title text-dark bg">Faculty of Science</p> 
              <ul> 
              <li>Chemistry</li>
              <li>Physics</li>
               <li>ICT</li>
               <li>Zoology</li>
              <li>Botany</li>
               <li>Mathematics</li>
             </ul> 
            
           
            </div></div>   

             <div class="col-md-4"> <div class="icon-box" data-aos="zoom-in-left">
              
              <div class="">
              <p class="p-2 m-0 title text-dark bg">Bangabandhu &<br>
              Liberation War Corner</p>  </div>

                 <div  class="text-center"><a href="/academy/{{$pmassage->id}}"> <img class="border  p-2 mx-auto mb-3"   src="{{asset('upload/bangobandhu.jpg')}}"  style="width: 200px; text-align: center; height: 200px;"></a></div>
          <div>
             জাতির জনক বঙ্গবন্ধু শেখ মুজিবুর রহমান ফরিদপুর জেলার গোপালগঞ্জ মহকুমার (বর্তমানে জেলা) টুঙ্গিপাড়া গ্রামে এক সম্ভ্রান্ত মুসলিম পরিবারে ১৯২০ সালের ১৭ মার্চ জন্মগ্রহণ করেন। <a href="/bongobondhu"> More</a>

               </div>       
             </div> 
             
            </div>
       <div class="col-md-4 "><div class="icon-box" data-aos="zoom-in-left">
         <p class="p-2 m-0 title text-dark bg">Golden Jubilee Corner<br>
              <div  class="text-center"><img class="border  p-2 mx-auto mb-3"   src="{{asset('slide/1670160757.jpg')}}"  style=" text-align: center; height: 200px;"></div>
              <p class="text-center text-dark title">Golden Jubilee Corner</p>
             <p class="text-center font-weight-bold fs-6 text-uppercase"></p>
            </div></div>
           <d iv class="row ">
      <div class="col-md-4 bg-white"><div class="" >
      
            <p class="p-2 m-0 title text-dark bg">Faculty of Social Science</p> 
              <ul> 
              <li>Economics</li>
              <li>Social Work</li>
               <li>Political Science</li>
             </ul> 
             <p class="p-2 m-0 title text-dark bg">Faculty of Science</p> 
              <ul> 
              <li>Chemistry</li>
              <li>Physics</li>
               <li>ICT</li>
               <li>Zoology</li>
              <li>Botany</li>
               <li>Mathematics</li>
             </ul> 
            
           
            </div></div>    <div class="col-md-4"> <div class="icon-box" data-aos="zoom-in-left">
              
              <div class="">
              <p class="p-2 m-0 title text-dark bg">Class Schedule</p>  </div>

                 <div  class="text-center"><a href="/academy/{{$pmassage->id}}"> <img class="border  p-2 mx-auto mb-3"   src="{{asset('upload/bangobandhu.jpg')}}"  style="width: 200px; text-align: center; height: 200px;"></a></div>
          <div>
             জাতির জনক বঙ্গবন্ধু শেখ মুজিবুর রহমান ফরিদপুর জেলার গোপালগঞ্জ মহকুমার (বর্তমানে জেলা) টুঙ্গিপাড়া গ্রামে এক সম্ভ্রান্ত মুসলিম পরিবারে ১৯২০ সালের ১৭ মার্চ জন্মগ্রহণ করেন। <a href="/bongobondhu"> More</a>

               </div>       
             </div> 
             
            </div>
       <div class="col-md-4"><div class="icon-box" data-aos="zoom-in-left">
         <p class="p-2 m-0 title text-dark bg">Bus Schedule<br>
              <div  class="text-center"> <a href="/">Link</a></div>
              <p class="title text-dark bg">Complain Corner</p>
              <br>
             <p class="text-center font-weight-bold fs-6 text-uppercase">
              <div  class="text-center"> <a href="/">Link</a></p>
            </div></div> 

             
    </div>    <p class="p-2 m-0 title text-dark bg">Faculty of Business Studies</p> 
              <ul> 
              <li>Management</li>
              <li>Finance &amp; Banking</li>
               <li>Accounting</li>
               <li>Marketing</li>
              
             </ul> 