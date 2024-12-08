<?php

namespace App\Http\Controllers;

use App\Models\CourseName;
use App\Models\ExamDrRoutine;
use App\Models\ExamRoutine;
use App\Models\ExamName;
use App\Models\RoutineTimeSloat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class ExamDrRoutineController extends Controller
{
    
     public function index()

     {   
         $authID = Auth::id();
         $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
         $CourseName  = CourseName::orderby('id','asc')->get();
         $data   = ExamDrRoutine::where('user_id',$authID)->orderby('id','asc')->get();
         return view('backend.dr_exam_routine',compact('CourseName','data','examname','authID'));
     }
 
     public function store(Request $request)
     {
         $authID = Auth::id();
         ExamDrRoutine::updateOrCreate([
             'id' => $request->id ],
         [
             'user_id' => $authID,
             'exam_id' => $request->exam_name,
             'date' => $request->date,
             'day' => $request->day,
             'exam_time' => $request->exam_time,
             'course_name' => strtoupper($request->course_name),
             'course_code' => $request->course_code,
            
         ]);
         if($request->id!=0){
             return redirect('dr_exam_routine')->with('message', 'Updated successfully!!!');
 
         }
     else{
         return redirect('dr_exam_routine')->with('message', 'Inserted successfully!!!');
     }
     }
 
     public function edit( $id)
     {
         $data = ExamDrRoutine::find($id);
         return response()->json($data);
     }
 
     
   
    
     public function destroy($id)
     {
        ExamDrRoutine::find($id)->delete();
 
         return response()->json(['success'=>' Successfully deleted .']);
     }
 
     
   
 }
 