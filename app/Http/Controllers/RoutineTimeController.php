<?php

namespace App\Http\Controllers;
use App\Models\RoutineTimeSloat;
use App\Models\ExamName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoutineTimeController extends Controller
{
  
    public function index()
    {
        $authID = Auth::id();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $data   = RoutineTimeSloat::where('user_id',$authID)->orderby('id','asc')->get();
        return view('backend.routine_time',compact('data','authID','examname'));
    }
 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authID = Auth::id();
        RoutineTimeSloat::updateOrCreate([
            'id' => $request->id ],
        [
            'user_id' => $authID,
            'exam_name' => $request->exam_name,
            'time_1' => $request->time1,
            'time_2' => $request->time2,
            'time_3' => $request->time3,
            'time_4' => $request->time4,
            
        ]);
        if($request->id!=0){
            return redirect('routinetime')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('routinetime')->with('message', 'Inserted successfully!!!');
    }
    }

   
    public function edit( $id)
    {
        $data = RoutineTimeSloat::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        RoutineTimeSloat::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }

}
