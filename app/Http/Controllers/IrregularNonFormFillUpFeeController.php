<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\IrregularNonFormFillUpFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;

class IrregularNonFormFillUpFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = IrregularNonFormFillUpFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentcourse_irregular_nonformfillup_fee', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
       $depart_id = $request->depart_id;
       $depart_name = Session::get('depart_name');
       IrregularNonFormFillUpFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $request->depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);

       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('irregular-nonform-fillup-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('irregular-nonform-fillup-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('irregular-nonform-fillup-fee')->with('error', 'The form was not filled up completely!!!');

        // }
    }

    public function edit($id)
    {
         $data = IrregularNonFormFillUpFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        IrregularNonFormFillUpFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }


    public function StudentClassSession($id){  
        $data = [];
    
        if ($id == 1) {
            $data['sessions'] = DB::table('students')->select('session')->distinct()->orderBy('session', 'desc')->get(); 
        } else if($id == 2) {
            $data['sessions'] = DB::table('student_honours_secound_years')->select('session_year as session')->distinct()->orderBy('session_year', 'desc')->get();
        } else if($id == 3) {
            $data['sessions'] = DB::table('student_honours_third_years')->select('session_year as session')->distinct()->orderBy('session_year', 'desc')->get();
        } else if($id == 4) {
            $data['sessions'] = DB::table('student_honours_fourth_years')->select('session_year as session')->distinct()->orderBy('session_year', 'desc')->get(); 
        } else if($id == 5) {
            $data['sessions'] = DB::table('student_preliminary_to_masters')->select('session')->distinct()->orderBy('session', 'desc')->get(); 
        } else {
            $data['sessions'] = DB::table('student_masters_finals')->select('session')->distinct()->orderBy('session', 'desc')->get(); 
        }
    
        return response()->json($data);
    }
    
    
   
}
