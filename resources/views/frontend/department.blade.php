<div class="container">
    <div class="container-fluid  py-5">
        <div class="text-center py-3">
                  <h3 class="section-title bg-white text-center  px-2 "> Department </h3>

              </div>

          <div class="row">  
@foreach ($department as $ndepartment)

    
               <div class="col-sm-6 col-md-4 col-lg-3 py-1">
                
                     <div class="option_container">
                        <div class="box rounded-3">
                           <a href="" class="option1">
                        <h4 >  {{$ndepartment->title}}</h4>
                           </a>
                          
                        </div>
                     </div>
                   
                    
               
               </div>

           


    @endforeach
           

           
          </div>

        </div> </div>

 