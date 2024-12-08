<?php

namespace App\Http\Controllers;
use App\Models\DegreeClass;
use App\Models\ImprovementFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DegreeImprovementController extends Controller
{
    public function index()
    {  // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = ImprovementFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->orderBy('session','desc')->orderBy('exam_type','asc')->get();
        return view('backend.degree_improvement_fee', compact('data','classname'));
    }

  
   public function store(Request $request)
    { 
        $depart_id = 40;
        $depart_name = 'Department of Degree';  
       ImprovementFee::updateOrCreate([
            'id' => $request->id ],
        [
             'exam_type' => $request->exam_type,
             'depart_id' => $depart_id,
             'dname' => $depart_name,
             'session' => $request->session,
             'class_id' => $request->class_id,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);

        if($request->id!=0){
            return redirect('degree-improvement-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-improvement-fee')->with('message', 'Inserted successfully!!!');
        }
     
    }



    public function edit($id)
    {
         $data = ImprovementFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        ImprovementFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
}
