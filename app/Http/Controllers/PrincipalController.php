<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\principal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\internal_mail;
use App\Models\Department;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = principal::orderBy('id', 'desc')->get();
        return view('backend.principalinfo', compact('data'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);

         $fileName = '';
        $emp = principal::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('principal/'), $fileName);
        $principal_images ='public/principal/'.$fileName;

            if($request->id>0)
            {

                $imagePath = public_path('principal/' . $emp->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }

            }

        }
        else {
            $principal_images = $emp->photo ?? "0";
        }
      principal::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $principal_images,
            'designation' => $request->designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
            'th' => $request->th,
            'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,

        ]);
        if($request->id!=0){
            return redirect('principaleinfo')->with('message', 'Updated successfully!!!');

        }
        else{
            return redirect('principaleinfo')->with('message', 'Inserted successfully!!!');
        }
    }

    public function edit($id)
    {
        $data = principal::find($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
         principal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }

    public function sent()
    {
    $data = DB::table('internal_mails')
                ->where('sender', '=', Auth::user()->email)->orderBy('id', 'desc')->paginate(10);
        return view('backend.principalsentinternal_mails', compact('data'));
    }
    public function inbox()
    {
    $data = DB::table('internal_mails')
                ->where('receiver', '=', Auth::user()->email)->paginate(10);
        
       return view('backend.principal_inbox',compact('data'));

    }

    public function emailStore(Request $request)
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

 
  
      return redirect('principalsentinternal_mails')->with('message', 'Sent Email successfully!!!');
    }

    public function details($id)
    {
$details =internal_mail::where('id', $id)->get();
 return view('backend.principalsentmaildetails', compact('details'));
}
public function distroy($id)
{
    $details = internal_mail::find($id);
    
    if ($details) {
        $details->delete();
        
        return redirect('principalsentinternal_mails')->with('message', 'Email Deleted successfully!!!');
    } else {
        return redirect('principalsentinternal_mails')->with('message', 'Email not found!');
    }
}
public function inboxdistroy($id)
{
    $details = internal_mail::find($id);
    
    if ($details) {
        $details->delete();
        
        return redirect('principal_inboxinternal_mails')->with('message', 'Email Deleted successfully!!!');
    } else {
        return redirect('principal_inboxinternal_mails')->with('message', 'Email not found!');
    }
}

}
