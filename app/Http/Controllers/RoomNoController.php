<?php

namespace App\Http\Controllers;
use App\Models\RoomNo;
use App\Models\BuldingName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class RoomNoController extends Controller
{
      public function index()
    { 
        $authID = Auth::id();
        $data = DB::table('room_no')
                    ->join('bulding_names', 'room_no.building_id', '=', 'bulding_names.id')
                    ->select('room_no.*','bulding_names.building_name')
                    ->orderBy('id', 'desc')
                    ->get();
        $data_info = BuldingName::orderBy('id', 'desc')->get();
        return view('backend.room_no', compact('data','data_info','authID'));
    }

    public function store(Request $request)
    {
      RoomNo::updateOrCreate([
            'id' => $request->id ],
        [
            'building_id' => $request->building_id,          
            'title' => $request->name,
            'number_bench' => $request->number_bench,          
            'total_bench_per_col' => $request->total_bench_per_col,          
            'student_per_bench' => $request->type,          
            'total_row' => $request->total_row,          
        ]);
        if($request->id!=0){
            return redirect('exam-room_no')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('exam-room_no')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
       $data = RoomNo::find($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
        RoomNo::find($id)->delete();
        return response()->json(['success'=>' Successfully deleted .']);
    }
}
