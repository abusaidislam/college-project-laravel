<?php

namespace App\Http\Controllers;
use App\Models\RoomNo;
use App\Models\BuldingName;
use App\Models\GlanceSeatPlan;
use Illuminate\Http\Request;
use App\Models\ExamName;
class GlanceSeatPlanController extends Controller
{
    public function index()
    {  
   $examname = ExamName::orderBy('id', 'asc')->get();
     $buldingname = BuldingName::orderBy('id', 'asc')->get();
    $roomno = RoomNo::orderBy('id', 'asc')->get();
       $data = GlanceSeatPlan::orderBy('id', 'desc')->get();
       return view('backend.exam_glance_seat_plan', compact('data','roomno','examname','buldingname'));
   
        
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
            return redirect('exam_glance_seat_plan')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('exam_glance_seat_plan')->with('massage', 'Inserted successfully!!!');
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
