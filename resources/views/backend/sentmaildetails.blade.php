@extends('layouts.paapp')
@section('content')
<style type="text/css">.fa-download:hover {
    color: red;
}</style>
<div class="right_col" role="main">
  

<div class="page-title ">
        


      </div></br>
   @foreach ($details as $ndata)
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
             <div class="pt-2" style="font-size: 20px; font-weight: bold;  ">{{$ndata->subject}}<span class="media-meta pull-right" style="font-size:15px;">{{ date('M', strtotime( $ndata->created_at));}} {{ date('d', strtotime( $ndata->created_at));}}, {{date('Y', strtotime( $ndata->created_at));}}</span></div>
            

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">


               <div >
          
                       <div class="pt-1" style="font-size: 15px; font-weight: bold;  ">{{Auth::user()->name}} ( {{$ndata->sender}} )</div>
                         <div class="pb-3"  style="font-size: 15px; font-weight: bold; color:red; ">To: {{$ndata->receiver}}</div>
                         @if($ndata->mail!=0)
                           <div class="border p-3 mb-2 text-start " style="background: #f9f9f9;">{!!$ndata->mail!!} </div>@endif
                          @if(($ndata->files!="")||($ndata->file1!="")||($ndata->file2!="")||($ndata->file3!="")||($ndata->file4!=""))
                     <?php 
$ext = pathinfo($ndata->files, PATHINFO_EXTENSION);
$ext1 = pathinfo($ndata->file1, PATHINFO_EXTENSION);
$ext2 = pathinfo($ndata->file2, PATHINFO_EXTENSION);
$ext3 = pathinfo($ndata->file3, PATHINFO_EXTENSION);
$ext4 = pathinfo($ndata->file4, PATHINFO_EXTENSION);
              ?>

               
  <p><b> Attachment.</b></p>

  <div class="row">  
   @if(($ext=='jpg' ) || ($ext=='jpeg ') || ($ext=='png')|| ($ext=='gif')) 
   <div class="m-2"> <a href="{{ asset('public/Internal_mail/'.$ndata->files) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <img src="{{ asset('public/Internal_mail/'.$ndata->files) }}" alt="Internal_mail" width="104" height="142">
</a></div>
     @elseif($ext=='pdf' )   
    
 <div class="m-2"><a href="{{ asset('public/Internal_mail/'.$ndata->files) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <iframe src="{{ asset('public/Internal_mail/'.$ndata->files) }}" alt="Internal_mail" width="104" height="142"></iframe></a>
</div>                 
 
@endif 


                @if(($ext1=='jpg' ) || ($ext1=='jpeg ') || ($ext1=='png')|| ($ext1=='gif')) 

   <div class="m-2" > <a href="{{ asset('public/Internal_mail/'.$ndata->file1) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <img src="{{ asset('public/Internal_mail/'.$ndata->file1) }}" alt="Internal_mail" width="104" height="142">
</a></div>
     @elseif($ext1=='pdf' )   
     
 <div class="m-2"><a href="{{ asset('public/Internal_mail/'.$ndata->file1) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <iframe src="{{ asset('public/Internal_mail/'.$ndata->file1) }}" alt="Internal_mail" width="104" height="142"></iframe></a>
</div>                 
 
@endif



                @if(($ext2=='jpg' ) || ($ext2=='jpeg ') || ($ext2=='png')|| ($ext2=='gif')) 

   <div class="m-2"> <a href="{{ asset('public/Internal_mail/'.$ndata->file2 )}}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <img src="{{ asset('public/Internal_mail/'.$ndata->file2) }}" alt="Internal_mail" width="104" height="142">
</a></div>
     @elseif($ext2=='pdf' )   
      
 <div class="m-2"><a href="{{ asset('public/Internal_mail/'.$ndata->files2) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <iframe src="{{ asset('public/Internal_mail/'.$ndata->files2) }}" alt="Internal_mail" width="104" height="142"></iframe></a>
</div>                 
 
@endif 



                @if(($ext3=='jpg' ) || ($ext3=='jpeg ') || ($ext3=='png')|| ($ext3=='gif')) 
 
   <div class="m-2"> <a href="{{ asset('public/Internal_mail/'.$ndata->file3) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <img src="{{ asset('public/Internal_mail/'.$ndata->file3) }}" alt="Internal_mail" width="104" height="142">
</a></div>
     @elseif($ext3=='pdf' )   
     
 <div class="m-2"><a href="{{ asset('public/Internal_mail/'.$ndata->file3) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <iframe src="{{ asset('public/Internal_mail/'.$ndata->file3) }}" alt="Internal_mail" width="104" height="142"></iframe></a>
</div>                 
 
@endif




                @if(($ext4=='jpg' ) || ($ext4=='jpeg ') || ($ext4=='png')|| ($ext4=='gif')) 
  
   <div class="m-2"> <a href="{{ asset('public/Internal_mail/'.$ndata->file4 )}}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <img src="{{ asset('public/Internal_mail/'.$ndata->file4) }}" alt="Internal_mail" width="104" height="142">
</a></div>
     @elseif($ext4=='pdf' )   
    
 <div class="m-2"><a href="{{ asset('public/Internal_mail/'.$ndata->file4) }}" download><i style="position: absolute; bottom:1; left:1; color:#black;" class="fa fa-download"></i>
  <iframe src="{{ asset('public/Internal_mail/'.$ndata->file4) }}" alt="Internal_mail" width="104" height="142"></iframe></a>
</div>                 
 
@endif
</div>
     @endif




           </div>             

               
            

            </div>
          </div>
        </div>
      </div>

    


          </div>
        </div>  @endforeach
      </div>
    </div>





    <script type="text/javascript">

        $(document).ready(function() {


           $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
               })



           });


         $('#createNew').click(function () {
               $('#ajaxModel').modal('show');
               $('#modelHeading').html("Create New");
               $('#dform').trigger("reset");
               $('#saveBtn').html('Save');
               $('#id').val('');


           });


           /*------------------------------------------
           --------------------------------------------
           Click to Edit Button
           --------------------------------------------
           --------------------------------------------*/
           $('body').on('click', '#edit', function () {
             var id = $(this).data('id');

             $.get("{{ route('snoticelist.index') }}" +'/' + id +'/edit', function (data) {
                  $('#ajaxModel').modal('show');
                 $('#modelHeading').html("Edit");
                 $('#saveBtn').html('Update');
                 $('#id').val(data.id);
                 $('#title').val(data.title);
                 $('#date').val(data.date);
                 $('#place').val(data.place);
                 $('#time').val(data.time);
                  $('#details').summernote('code', data.details);
        }); });





/*------------------------------------------
           --------------------------------------------
           Delete ndataInfo Code
           --------------------------------------------
           --------------------------------------------*/
           $('body').on('click', '#delete', function () {

               var id = $(this).data("id");
               confirm("Are You sure want to delete !");

               $.ajax({
                   type: "DELETE",
                   url:'snoticelist/'+id ,
                   success: function (data) {
                       window.location='snoticelist'
                   }

               });
           });

$('#closemodal').click(function() {
    $('#ajaxModel').modal('hide');
});





</script>

@endsection
