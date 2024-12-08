<?php

namespace App\Http\Controllers;
use App\Models\CourseName;
use App\Models\DegreeCourse;
use App\Models\ExamRoutine;
use App\Models\ExamName;
use App\Models\RoutineTimeSloat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
class ExamRoutineController extends Controller
{
   
    public function index()

    {   
        $authID = Auth::id();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $CourseName  = CourseName::orderby('id','asc')->get();
        $degreeCourseName  = DegreeCourse::orderby('id','asc')->get();
        $data   = ExamRoutine::where('user_id',$authID)->orderby('id','desc')->get();
        return view('backend.exam_routine',compact('CourseName','degreeCourseName','data','examname','authID'));
    }

    public function store(Request $request)
    {
        $authID = Auth::id();
        $data = [
            'user_id' => $authID,
            'exam_id' => $request->exam_name,
            'date' => $request->date,
            'day' => $request->day,
        ];
    
        if ($request->has('first_subject')) {
            $data['first_sub'] = implode(',', $request->first_subject);
        }
        if ($request->has('second_subject')) {
            $data['second_sub'] = implode(',', $request->second_subject);
        }
    
        ExamRoutine::updateOrCreate(['id' => $request->id], $data);
    
        if ($request->id != 0) {
            return redirect('examroutine')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('examroutine')->with('message', 'Inserted successfully!!!');
        }
    }
    

    public function edit( $id)
    {
        $data = ExamRoutine::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        ExamRoutine::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }

    public function examRoutineView(Request $request) {
        $authID = Auth::id();
        $examid = $request->exam_name;
        $data   = ExamRoutine::where('user_id',$authID)->where('exam_id',$examid)->orderby('id','desc')->get();
        $routine_time   = RoutineTimeSloat::where('user_id',$authID)->where('exam_name',$examid)->orderby('id','asc')->first();
        return view('backend.exam_routine_view',compact('data','routine_time'));
    }

    public function examroutinePdf(){
        $data   = ExamRoutine::orderby('id','asc')->get();
        $routine_time   = RoutineTimeSloat::orderby('id','asc')->first();

       
        $pdf = PDF::loadview('backend.exam_routine_view',compact('data','routine_time'));
        return $pdf->download('Exam_Rotine.pdf');
 
    }
}
