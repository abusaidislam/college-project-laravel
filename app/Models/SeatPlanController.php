<?php

namespace App\Http\Controllers;
use App\Models\SeatPlan;
use Illuminate\Http\Request;

class SeatPlanController extends Controller
{
     public function index()
    {  
  
       $data = SeatPlan::orderBy('id', 'desc')->get();
       return view('backend.exam_seatplan', compact('data'));
   
        
    }

    
  
    public function store(Request $request)
    {

    $examsetup = SeatPlan::updateOrCreate([
            'id' => $request->id ],
        [
            'nofbench' => $request->nofbench,
            'nofrow' => $request->nofrow,
            'starting_roll' => $request->starting_roll,
            'ending_roll' => $request->ending_roll,
          
            
              'dates' => $request->dates,
        ]);
 
        if($request->id!=0){
            return redirect('exam_seatplan')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('exam_seatplan')->with('massage', 'Inserted successfully!!!');
    }
    
    }

   
    
    public function edit( $id)
    {
        $data = SeatPlan::find($id);
        return response()->json($data);
    }

    
 
   
    public function destroy($id)
    {
        SeatPlan::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
