<?php

namespace App\Http\Controllers;
use App\Models\TeacherCouncil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class TeacherCouncilController extends Controller
{
   
    public function index()
    {
         $data = TeacherCouncil::orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->get();
        return view('backend.teachercouncil', compact('data'));
    }

    
    public function store(Request $request)
    { $fileName = '';
        $emp = TeacherCouncil::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('teacherCouncil/'), $fileName);
        $photoName = 'public/teacherCouncil/'.$fileName;
            if($request->id>0)
            {

                $imagePath = public_path('teacherCouncil/' . $emp->photo);
                if(File::exists($imagePath)){
                // unlink($imagePath);
                }

            }

        }
        else {
            $photoName = $emp->photo;
        }

         TeacherCouncil::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
             'photo' =>$photoName,
            'email' => $request->email,
            'designation' => $request->designation,
            'academicdesignation' => $request->academicdesignation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'from' => $request->from,
            'to' => $request->to,
            'mobile_no' => $request->mobile_no,
           
           
            
        ]);
        if($request->id!=0){
            return redirect('teachercouncil')->with('message', 'Updated successfully!!!');

        }
        else{
            return redirect('teachercouncil')->with('message', 'Inserted successfully!!!');
        }
    }

    
    public function edit($id)
    {
         $data = TeacherCouncil::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        TeacherCouncil::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
