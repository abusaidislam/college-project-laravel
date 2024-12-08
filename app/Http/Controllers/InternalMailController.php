<?php

namespace App\Http\Controllers;
use App\Models\internal_mail;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class InternalMailController extends Controller
{
      
    public function index()
    {
 $data = DB::table('internal_mails')
            ->where('sender', '=', Auth::user()->email)->orderBy('id', 'desc')->paginate(10);
      
      
        return view('backend.sentinternal_mails', compact('data'));

        
    }
public function inbox()
    {
 $data = DB::table('internal_mails')
            ->where('receiver', '=', Auth::user()->email)->paginate(10);
      
      
        return view('backend.inboxinternal_mails', compact('data'));

        
    }
   
    public function store(Request $request)
    { 
       
     $fileName = '';
        $emp = Internal_mail::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('Internal_mail/'), $fileName);



}



   
$fileName1 = '';
  if ( $request->photo1)
{
    $fileName1 ='1'.time().'.'.$request->photo1->getClientOriginalExtension();

    $request->photo1->move(public_path('Internal_mail/'), $fileName1);

    


    }

  $fileName2 = '';
  if ( $request->photo2)
{
    $fileName2 = '2'.time().'.'.$request->photo2->getClientOriginalExtension();

    $request->photo2->move(public_path('Internal_mail/'), $fileName2);


    }


     $fileName3 = '';
  if ( $request->photo3)
{
    $fileName3 = '3'.time().'.'.$request->photo3->getClientOriginalExtension();

    $request->photo3->move(public_path('Internal_mail/'), $fileName3);

   
}

 $fileName4 = '';
  if ( $request->photo4)
{
    $fileName4 = '4'.time().'.'.$request->photo4->getClientOriginalExtension();

    $request->photo4->move(public_path('Internal_mail/'), $fileName4);

    
}



 if(($request->alldepartment)==1)
        {
          $department = Department::orderBy('id', 'asc')->get(); 
foreach ($department as $ndepartment) {
     internal_mail::Create([
        
        
             'subject' => $request->subject,
             'sender' => Auth::user()->email,
             'files' => $fileName,
              'receiver' => $ndepartment->email,
            'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'status' => 0,
              'mail' => $request->mail,
            
        ]);
}


        }

else{  if(explode(',', $request->receiver)!=0){
     
$var = $request->receiver;
$array = explode(',', $var);
foreach ($array as $values)
{
internal_mail::updateOrCreate([
            'id' => $request->id ],
        [
             'subject' => $request->subject,
             'sender' => Auth::user()->email,
             'files' => $fileName,
             'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'receiver' => $values,
              'internal_mails' => $request->internal_mails,
              'status' => 0,
              'mail' => $request->mail
            
        ]); 
}
      } 
  

     
else{


       internal_mail::updateOrCreate([
            'id' => $request->id ],
        [
             'subject' => $request->subject,
             'sender' => Auth::user()->email,
             'files' => $fileName,
             'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'receiver' => $request->receiver,
              'internal_mails' => $request->internal_mails,
              'status' => 0,
              'mail' => $request->mail
            
        ]);   


}}

 
  
      return redirect('sentinternal_mails')->with('message', 'Sent Email successfully!!!');
    }




 

   
    public function edit($id)
    {
         $data = internal_mail::find($id);
          return response()->json($data);
       // return view('backend.editinternal_mails', compact('data'));
    }

   
    public function status($id)
    {

        $user = internal_mail::find($id);
       
       if($user->status==0)
        {  internal_mail::where('id', $id)->update(['status' => 1]);
       
}
     
       return response()->json(['success'=>' Successfully ']);
    }


public function sentmaildetails($id)
    {
$details =internal_mail::where('id', $id)->get();
 return view('backend.sentmaildetails', compact('details'));
}


public function department_inboxinternal()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
         $depart_value = DB::table('departments')
            ->where('id', '=', $depart_id)->get();
       foreach ($depart_value as $ndepart_value) {     
 $data = DB::table('internal_mails')
  ->where('receiver', '=', $ndepart_value->email)->latest()->paginate(10);
          
      }
       Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
        return view('backend.departmentinboxinternal_mails', compact('data'));

        
    }

public function department_sentinternal()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
     $depart_value = Department::find($depart_id);
       foreach ($depart_value as $ndepart_value) {     
 $data = DB::table('internal_mails')
            ->where('sender', '=', $depart_value->email)->latest()->paginate(10);
      }
       Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.departmentsentinternal_mails', compact('data'));

        
    }
public function department_sentmaildetails($id)
    {  $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');


$details =internal_mail::where('id', $id)->get();
 Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
 return view('backend.department_sentmaildetails', compact('details'));
}


 public function departmentstore(Request $request)
    { 
$depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');

$depart_value = Department:: find($depart_id);

     $fileName = '';
        $emp = Internal_mail::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('Internal_mail/'), $fileName);



}



   
$fileName1 = '';
  if ( $request->photo1)
{
    $fileName1 ='1'.time().'.'.$request->photo1->getClientOriginalExtension();

    $request->photo1->move(public_path('Internal_mail/'), $fileName1);

    


    }

  $fileName2 = '';
  if ( $request->photo2)
{
    $fileName2 = '2'.time().'.'.$request->photo2->getClientOriginalExtension();

    $request->photo2->move(public_path('Internal_mail/'), $fileName2);


    }


     $fileName3 = '';
  if ( $request->photo3)
{
    $fileName3 = '3'.time().'.'.$request->photo3->getClientOriginalExtension();

    $request->photo3->move(public_path('Internal_mail/'), $fileName3);

   
}

 $fileName4 = '';
  if ( $request->photo4)
{
    $fileName4 = '4'.time().'.'.$request->photo4->getClientOriginalExtension();

    $request->photo4->move(public_path('Internal_mail/'), $fileName4);

    
}



 if(($request->alldepartment)==1)
        {
          $department = Department::orderBy('id', 'asc')->where('id', '!=', $depart_id)->get(); 
       
foreach ($department as $ndepartment) {
     internal_mail::Create([
        
        
             'subject' => $request->subject,
             'sender' => $depart_value->email,
            'files' => $fileName,
             'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'receiver' => $ndepartment->email,
              
              'status' => 0,
              'mail' => $request->mail,
            
        ]);
}


        }

else{  if(explode(',', $request->receiver)!=0){
     
$var = $request->receiver;
$array = explode(',', $var);
foreach ($array as $values)
{
internal_mail::updateOrCreate([
            'id' => $request->id ],
        [
             'subject' => $request->subject,
             'sender' => $depart_value->email,
            'files' => $fileName,
             'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'receiver' => $values,
              'internal_mails' => $request->internal_mails,
              'status' => 0,
              'mail' => $request->mail
            
        ]); 
}
      } 
  

     
else{


       internal_mail::updateOrCreate([
            'id' => $request->id ],
        [
             'subject' => $request->subject,
             'sender' =>$depart_value->email,
             'files' => $fileName,
             'file1' => $fileName1,
            'file2' => $fileName2,
            'file3' => $fileName3,
            'file4' => $fileName4,
              'receiver' => $request->receiver,
              'internal_mails' => $request->internal_mails,
              'status' => 0,
              'mail' => $request->mail
            
        ]);   


}}

     

        

      Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
        if($request->id!=0){
             //return response()->json(['massage'=>'Updated successfully!!!']);
            return redirect('departmentsentinternal_mails')->with('message', 'Updated successfully!!!');

        }
    else{
          // return response()->json(['massage'=>'Inserted successfully!!!']);
      return redirect('departmentsentinternal_mails')->with('message', 'Inserted successfully!!!');
    }




    }

    public function distroy($id)
    {
        $details = internal_mail::find($id);
        
        if ($details) {
            $details->delete();
            
            return redirect('departmentsentinternal_mails')->with('message', 'Email Deleted successfully!!!');
        } else {
            return redirect('departmentsentinternal_mails')->with('message', 'Email not found!');
        }
    }
    public function inboxdistroy($id)
    {
        $details = internal_mail::find($id);
        
        if ($details) {
            $details->delete();
            
            return redirect('department-inboxinternal_mails')->with('message', 'Email Deleted successfully!!!');
        } else {
            return redirect('department-inboxinternal_mails')->with('message', 'Email not found!');
        }
    }

}
