<?php

namespace App\Http\Controllers;

use App\Models\ExamName;
use App\Models\ExamSeatcard;
use Illuminate\Http\Request;
use App\Models\CourseName;
class ExamSeatcardController extends Controller
{
   
    public function index()
    {   $examname = ExamName::orderBy('id', 'desc')->get();
        $data = ExamSeatcard::orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        return view('backend.seat_card', compact('data','examname','course_name'));
    }

    
  
    public function store(Request $request)
    {
          
  
      ExamSeatcard::updateOrCreate([
            'id' => $request->id ],
        [
            'student_name' => $request->student_name,
            'exam_name' => $request->exam_name,
            'roll' => $request->roll,
            'registration' => $request->registration,
            'course_name' => $request->course_name,
            
        ]);
        if($request->id!=0){
            return redirect('seat_card')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('seat_card')->with('massage', 'Inserted successfully!!!');
    }
    }

   
    public function seat_card()
    {  }

    
    public function edit( $id)
    {
        $data = ExamSeatcard::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        ExamSeatcard::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
