<?php

namespace App\Http\Controllers;
use App\Models\DegreeClassSchedule;
use Illuminate\Http\Request;

class DegreeClassScheduleController extends Controller
{
    public function index()
    { 

        $data = DegreeClassSchedule::orderBy('id','desc')->get();

        return view('backend.degree_class_schedule', compact( 'data'));
    }
    public function store(Request $request)
    {
        try {
            
            DegreeClassSchedule::updateOrCreate([
                'id' => $request->id
            ], [
                'day' => $request->day,
                'fitst' => $request->fitst,
                'scend' => $request->scend,
                'third' => $request->third,
                'forth' => $request->forth,
                'fifth' => $request->fifth,
                'sixth' => $request->sixth,
                'seventh' => $request->seventh,
                'eight' => $request->eight,
                'nine' => $request->nine,
            ]);
    
            if ($request->id != 0) {
                return redirect('degree-class_schedules')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree-class_schedules')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree-class_schedules')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
 
    public function edit($id)
    {
       $data = DegreeClassSchedule::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        DegreeClassSchedule::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
