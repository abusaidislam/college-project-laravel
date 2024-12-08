<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ClassScheduleController extends Controller
{
    public function index()
    { 
        $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = ClassSchedule::where('depart_id', '=', $depart_id)->get();
        Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
        return view('backend.class_schedules', compact( 'data'));
    }


    public function store(Request $request)
    {
        try {
             

      ClassSchedule::updateOrCreate([
            'id' => $request->id ],
        [
            'depart_id' => $request->depart_id,
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
        if($request->id!=0){
            return redirect('department-class_schedules')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('department-class_schedules')->with('message', 'Inserted successfully!!!');
    }
} catch (\Exception $e) {
    return redirect('department-class_schedules')->with('error', 'The form was not filled up completely!!!');

}
    }




    public function edit($id)
    {
       $data = ClassSchedule::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        ClassSchedule::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
