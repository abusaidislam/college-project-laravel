@extends('frontend.administrationlayout')
@section('administrationcontent')

 <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">
 
    <div class="row pt-3  col-md-12  col-sm-12 text-center" > 
        <h3 class="pt-1" >Annual Committees </h3></div>
         
               




    

 
 <div class="x_content">
                <div class="row pt-3">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">


               <div class="col-md-12 col-sm-12 ">
      
            <div class="x_content">  <h5 class="text-center">Buying Committee</h5>
                <div class="row">
                    <div class="col-sm-12">  
                      <div class="card-box ">
                 

              <table id="" class="table table-striped table-bordered " cellspacing="0" width="100%">

                <thead>
                    <tr>

                        <th class="text-center">Photo</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Academic Designation</th>
                        <th class="text-center">BCS_Batch</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Mobile No.</th>
                       
                    </tr>
                </thead>
                <tbody id="list">
     @foreach ($data as $ndata)
                        <tr>
                        <td class="text-center"><img src="{{asset('public/Annual_committees/'.$ndata->photo)}}" alt="" width="80" height="80"> </td>
                        <td class="text-center">{{$ndata->name}}</td>
                        <td class="text-center">{{$ndata->email}}  </td>
                        <td  class="text-center">{{$ndata->designation}}  </td>
                        <td  class="text-center">{{$ndata->academic_designation}}  </td>
                        <td  class="text-center">{{$ndata->bcs_batch}} th </td>
                        <td  class="text-center">{{$ndata->department}}  </td>
                        <td  class="text-center">{{$ndata->mobile_no}}  </td>
                        
                        </tr>
 @endforeach 
                </tbody>
              </table>


            </div>
          </div>
        </div>
      </div>

 

<div>  <h5 class="text-center">Cultural Committee</h5>
                <div class="row">
                    <div class="col-sm-12">  
                      <div class="card-box ">
                 

              <table id="" class="table table-striped table-bordered " cellspacing="0" width="100%">

                <thead>
                    <tr>

                        <th  class="text-center">Photo</th>
                        <th  class="text-center">Name</th>
                        <th  class="text-center">Email</th>
                        <th  class="text-center">Designation</th>
                        <th  class="text-center">Academic Designation</th>
                        <th  class="text-center">BCS_Batch</th>
                        <th  class="text-center">Department</th>
                        <th  class="text-center">Mobile No.</th>
                       
                    </tr>
                </thead>
                <tbody >
     @foreach ($data1 as $ndata1)
                        <tr>
                        <td  class="text-center"><img src="{{asset('public/Annual_committees/'.$ndata1->photo)}}" alt="" width="80" height="80"> </td>
                        <td  class="text-center">{{$ndata1->name}}</td>
                        <td  class="text-center">{{$ndata1->email}}  </td>
                        <td  class="text-center">{{$ndata1->designation}}  </td>
                        <td  class="text-center">{{$ndata1->academic_designation}}  </td>
                        <td  class="text-center">{{$ndata1->bcs_batch}}th</td>
                        <td  class="text-center">{{$ndata1->department}}  </td>
                        <td  class="text-center">{{$ndata1->mobile_no}}  </td>
                         
                       

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
    </div> </div>
</div>
        </section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>



  $(document).ready(function(){

        $('#search').change(function() {
            var value = $(this).find('option:selected').val();
          
            if (value) {
                $.ajax({
                    url: "{{ url('academicsearch') }}/" + value,
                    type: 'GET',
                    cache: false,
                    dataType: "json",
                    success: function(data) {

                        var output = '';
                       
                        
                            output += "<tr>";
                              
                            output += "<td> <img src='" + data.photo + "'  width='100' height='80'></td>";
                            output += "<td>" + data.name + "</td>";
                            output += "<td>" + data.designation + "</td>";
                            output += "<td>" + data.department + "</td>";
                          output += "<td>" + data.bcs_batch + "</td>";
                            output += "<td>" + data.mobile_no + "</td>";
                          output += "<td>" + data.email + "</td>";
                   
                       $('tbody').html(output);


                    }

                })
            }
       });

    });

       
    </script>

   


 @endsection
 