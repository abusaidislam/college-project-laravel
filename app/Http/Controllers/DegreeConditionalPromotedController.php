<?php

namespace App\Http\Controllers;

use App\Models\DegreeClass;
use App\Models\ConditionalPromotedFee;
use Illuminate\Http\Request;

class DegreeConditionalPromotedController extends Controller
{
    public function index()
    {  // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = ConditionalPromotedFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->orderBy('session','desc')->orderBy('exam_type','asc')->get();
        return view('backend.degree_condition_promoted_fee', compact('data','classname'));
    }

  
   public function store(Request $request)
    { 
        $depart_id = 40;
        $depart_name = 'Department of Degree';  
       ConditionalPromotedFee::updateOrCreate([
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
            return redirect('degree-conditional-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-conditional-fee')->with('message', 'Inserted successfully!!!');
        }
     
    }



    public function edit($id)
    {
         $data = ConditionalPromotedFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        ConditionalPromotedFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   

    
}
