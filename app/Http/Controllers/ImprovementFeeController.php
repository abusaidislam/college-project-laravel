<?php

namespace App\Http\Controllers;

use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\ImprovementFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;

class ImprovementFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = ImprovementFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->orderBy('session','desc')->orderBy('exam_type','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.student_improvement_fee', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
       $depart_id = $request->depart_id;
       $depart_name = Session::get('depart_name');
       ImprovementFee::updateOrCreate([
            'id' => $request->id ],
        [
             'exam_type' => $request->exam_type,
             'depart_id' => $request->depart_id,
             'dname' => $depart_name,
             'session' => $request->session,
             'class_id' => $request->class_id,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);

       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('improvement-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('improvement-fee')->with('message', 'Inserted successfully!!!');
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
