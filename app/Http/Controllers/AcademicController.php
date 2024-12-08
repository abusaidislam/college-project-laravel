<?php

namespace App\Http\Controllers;
 use App\Models\academic;
  use App\Models\StudenClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class AcademicController extends Controller
{
    
    public function index()
    {
        $data = academic::where('type', 1)->orderBy('id', 'desc')->get();
        return view('backend.academic', compact('data'));
    }

  
    public function store(Request $request)
    {
         
        $fileName = '';
        $emp = academic::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('academic/'), $fileName);
$fileName1 ='public/academic/'.$fileName;
    if($request->id>0)
    {

        $imagePath = public_path( $emp->details);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName1 = $emp->details??"0";
}

      academic::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'type' => 1,
             'details' => $fileName1,
            
            
        ]);
        if($request->id!=0){
            return redirect('academicmanage')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('academicmanage')->with('message', 'Inserted successfully!!!');
    }
    }

    
    public function edit($id)
    {
       $data = academic::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        academic::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
 public function syllabusmanage()
    { $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
          $data = DB::table('academics')
            ->where('depart_id', '=', $depart_id)->get();
  $studentclass = StudenClass::orderBy('id', 'asc')->get();
 
  Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
        return view('backend.syllabusmanage', compact('data','studentclass'));
}
  public function syllabusereate(Request $request)
    {$depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
         
        $fileName = '';
        $emp = academic::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('academic/'), $fileName);
$fileName1 ='public/academic/'.$fileName;
    if($request->id>0)
    {

        $imagePath = public_path( $emp->details);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName1 = $emp->details??"0";
}

      academic::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'year' => $request->year,
            'session' => $request->session,
            'publish_date' => $request->publish_date,
            'type' => 2,
             'department' =>$depart_name,
              'depart_id' => $depart_id,
             'details' => $fileName1,
            
            
        ]);
        if($request->id!=0){
            return redirect('department-syllabus')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('department-syllabus')->with('message', 'Inserted successfully!!!');
    }
    }
}
