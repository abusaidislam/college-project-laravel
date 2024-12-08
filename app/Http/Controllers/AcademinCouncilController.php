<?php

namespace App\Http\Controllers;
use App\Models\AcademinCouncil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class AcademinCouncilController extends Controller
{
   
    public function index()
    {
         $data = AcademinCouncil::orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->get();
        return view('backend.academiccouncil', compact('data'));
    }

    public function store(Request $request)
    {     $fileName = '';
        $emp = AcademinCouncil::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('academiccouncil/'), $fileName);
        $photoName = 'public/academiccouncil/'.$fileName;
            if($request->id>0)
            {

                $imagePath = public_path('academiccouncil/' . $emp->photo);
                if(File::exists($imagePath)){
                unlink($imagePath);
                }

            }

        }
        else {
            $photoName = $emp->photo ?? "0";
        }

        AcademinCouncil::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
             'department' => $request->department,
             'mobile_no' => $request->mobile_no,
             'bcs_batch' => $request->bcs_batch,
           'photo' => $photoName,
            
        ]);
        if($request->id!=0){
            return redirect('academiccouncils')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('academiccouncils')->with('message', 'Inserted successfully!!!');
    }
    }

    
    public function edit($id)
    {
        $data = AcademinCouncil::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
         AcademinCouncil::find($id)->delete();
        return response()->json();
    }
}
