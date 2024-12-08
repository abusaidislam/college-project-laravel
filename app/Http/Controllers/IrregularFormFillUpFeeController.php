<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\IrregularFormFillUpFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;

class IrregularFormFillUpFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = IrregularFormFillUpFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentcourse_irregular_formfillup_fee', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');

       IrregularFormFillUpFee::updateOrCreate([
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
            return redirect('irregular-form-fillup-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('irregular-form-fillup-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('irregular-form-fillup-fee')->with('error', 'The form was not filled up completely!!!');

        // }
    }

    public function edit($id)
    {
         $data = IrregularFormFillUpFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        IrregularFormFillUpFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }


    public function StudentClassSession($id){  
        $departId = Session::get('depart_id');
        $data = [];
    
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('students')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                break;
            case 2:
                $data['sessions'] = DB::table('student_honours_secound_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get();
                break;
            case 3:
                $data['sessions'] = DB::table('student_honours_third_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get();
                break;
            case 4:
                $data['sessions'] = DB::table('student_honours_fourth_years')->select('session_year as session')->distinct()->where('depart_id', $departId)->orderBy('session_year', 'desc')->get(); 
                break;
            case 5:
                $data['sessions'] = DB::table('student_preliminary_to_masters')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                break;
            default:
                $data['sessions'] = DB::table('student_masters_finals')->select('session')->distinct()->where('depart_id', $departId)->orderBy('session', 'desc')->get(); 
                break;
        }
    
        return response()->json($data);
    }
    
    public function getSession(Request $request) {
        $id = $request->class_id;
        $session = $request->session;
        $data = [];
    
        switch ($id) {
            case 1:
                $data['sessions'] = DB::table('students')->select('session')->distinct()->where('session', $session)->first();
                break;
            case 2:
                $data['sessions'] = DB::table('student_honours_secound_years')->select('session_year as session')->distinct()->where('session_year', $session)->first();
                break;
            case 3:
                $data['sessions'] = DB::table('student_honours_third_years')->select('session_year as session')->distinct()->where('session_year', $session)->first();
                break;
            case 4:
                $data['sessions'] = DB::table('student_honours_fourth_years')->select('session_year as session')->distinct()->where('session_year', $session)->first();
                break;
            case 5:
                $data['sessions'] = DB::table('student_preliminary_to_masters')->select('session')->distinct()->where('session', $session)->first();
                break;
            default:
                $data['sessions'] = DB::table('student_masters_finals')->select('session')->distinct()->where('session', $session)->first();
        }
    
        return response()->json($data);
    }
    
   
}
