<?php

namespace App\Http\Controllers;
use App\Models\RoomNo;
use App\Models\SeatPlan;
use App\Models\BuldingName;
use App\Models\GlanceSeatPlan;
use Illuminate\Http\Request;
use App\Models\ExamName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GlanceSeatPlanController extends Controller
{
    public function index()
    {  
        $authID = Auth::id();        
        $bulding = BuldingName::orderBy('id', 'asc')->get();
        $bulding_info = BuldingName::orderBy('id', 'asc')->first();
        // $room_info = RoomNo::orderBy('id', 'asc')->get();
        $room_info = RoomNo::where('building_id', $bulding_info->id)->get();
        $seat_plan_info = SeatPlan::where('user_id',$authID)->distinct()->get(['room_num','starting_roll','rending_rolloll']);
        return view('backend.exam_glance_seat_plan', compact('seat_plan_info','bulding_info','bulding','room_info'));
        
    }

    public function store(Request $request)
    {

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
