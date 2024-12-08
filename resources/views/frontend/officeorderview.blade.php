
@extends('frontend.administrationlayout')
@section('administrationcontent')

 <div class="col-md-9  col-sm-9    p-0 m-0 pb-5  ">
 
    <div class="row pt-3  col-md-12  col-sm-12 text-center" > 
              <h2>Office Order Information</h2>
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content pt-3">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">


              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th class="text-center">Serial No</th>
                        <th class="text-center">Issue No</th>
                        <th class="text-center">Subject</th>
                        <th class="text-center">Publish Date</th>
                        <th class="text-center">Document</th>
                       
                </thead>
                <tbody >
<?php $i = 0 ?>
@foreach ($data as $ndata) <?php $i++ ?>
                        <tr>
                         <td class="text-center">{{ $i}}</td>
                        
                         <td class="text-center">{{$ndata->issue_no}}</td>
                        <td class="text-center">{{$ndata->subject}}  </td>
                        <td class="text-center">{{$ndata->publish_date}}  </td>
                        <td class="text-center"><a  href="{{asset('public/upload/'.$ndata->document)}}" download class="btn btn-info ">
         <i class="fa fa-download"></i>Download
        </a>  <a  href="{{asset('public/upload/'.$ndata->document)}}"  target="_blank" class="btn btn-info ">
          view
        </a></td>
                        
                        


                        </tr>
  @endforeach
                </tbody>
              </table>


          
            </div>
          </div>
        </div>
      </div>

        </section>
 @endsection
 


