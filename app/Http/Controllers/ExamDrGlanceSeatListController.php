<?php

namespace App\Http\Controllers;

use App\Models\RoomNo;
use App\Models\ExamDrSeatSeating;
use App\Models\BuldingName;
use App\Models\GlanceSeatPlan;
use Illuminate\Http\Request;
use App\Models\ExamName;
use App\Models\ExamDrRoutine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamDrGlanceSeatListController extends Controller
{
    public function index()
    {  
        $authID = Auth::id();
        $data = RoomNo::orderBy('title', 'asc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $bulding = BuldingName::orderBy('id', 'asc')->get();
        $bulding_info = BuldingName::orderBy('id', 'asc')->first();
        $room_info = RoomNo::where('building_id', $bulding_info->id)->get();
        $seat_plan_info = ExamDrSeatSeating::distinct()->where('user_id',$authID)->get(['room_num','collegee_name','subject_name','starting_roll','rending_rolloll']);
        
        return view('backend.dr_exam_glance_seat_plan', compact('seat_plan_info','bulding_info','bulding','room_info','data','examname'));

        
    }
    public function drExamNameData($id)
    {
        $Examroutine = DB::table('exam_dr_routines')->where('exam_id',$id)->orderBy('id','asc')->get();
         return json_encode($Examroutine);
    }

    public function drGlanceExamList(Request $request)
    {
        
        // return($request);
        $authID = Auth::id();
        $examname = ExamName::where('user_id',$authID)->where('id',$request->exam_name)->orderBy('id', 'desc')->first();
        $exam_date = ExamDrRoutine::where('id', $request->exam_date)->first();
        $bulding = BuldingName::orderBy('id', 'asc')->get();
        $bulding_info = BuldingName::orderBy('id', 'asc')->first();
        $room_info = RoomNo::where('building_id', $bulding_info->id)->get();
        $seat_plan_info = ExamDrSeatSeating::distinct()->where('exam_year',$request->exam_name)->where('exam_routin_id',$request->exam_date)->where('user_id',$authID)->get(['room_num','collegee_name','subject_name','starting_roll','rending_rolloll']);
        
        return view('backend.dr_exam_seat_list', compact('seat_plan_info','bulding_info','bulding','room_info','examname','exam_date'));
       
    }
    public function store(Request $request)
    {
        // dr_exam_seat_list
    $examsetup = GlanceSeatPlan::updateOrCreate([
            'id' => $request->id ],
        [
            'class_name' => $request->exam_name,
            'bulding' => $request->buldingname,
            'room' => $request->roomno,
            'starting_roll' => $request->starting_roll,
             'ending_roll' => $request->ending_roll,
            
              'dates' => $request->dates,
        ]);
 
        if($request->id!=0){
            return redirect('exam_glance_seat_plan')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('exam_glance_seat_plan')->with('message', 'Inserted successfully!!!');
    }
    
    }

   
    
    public function edit( $id)
    {
        $data = GlanceSeatPlan::find($id);
        return response()->json($data);
    }

    
 
   
    public function destroy($id)
    {
        GlanceSeatPlan::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
