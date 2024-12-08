<?php

namespace App\Http\Controllers;
use App\Models\TeacherCouncilHB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class TeacherCouncilHBController extends Controller
{
 
    public function index()
    {
         $data = TeacherCouncilHB::orderBy('id', 'desc')->get();
        return view('backend.teachercouncilhb', compact('data'));
    }

    
    public function store(Request $request)
    {
        $fileName = '';
        $emp = TeacherCouncilHB::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('teacherCouncilhb/'), $fileName);
        $photoName = 'public/teacherCouncilhb/'.$fileName;
            if($request->id>0)
            {

                $imagePath = public_path('teacherCouncilhb/' . $emp->photo);
                if(File::exists($imagePath)){
                // unlink($imagePath);
                }

            }

        }
        else {
            $photoName = $emp->photo ?? "0";
        }

         TeacherCouncilHB::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'academicdesignation' => $request->academicdesignation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'from' => $request->from,
            'to' => $request->to,
            'photo' => $photoName,
           
            
        ]);
        if($request->id!=0){
            return redirect('teachercouncilhb')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('teachercouncilhb')->with('message', 'Inserted successfully!!!');
    }
    }

    
    public function edit($id)
    {
         $data = TeacherCouncilHB::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        TeacherCouncilHB::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
