<?php

namespace App\Http\Controllers;
use App\Models\ExamName;
use App\Models\ExamRoutine;
use App\Models\CourseName;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamAttendenceController extends Controller
{
    
    public function index()

    {
       $examname = ExamName::orderBy('id', 'desc')->get();
       $data = Student::orderBy('id', 'desc')->get();
       $couse_name = CourseName::orderBy('id', 'asc')->get();
       $exam_routine   = ExamRoutine::orderby('id','asc')->get()->take(9);
    //    return($exam_routine);
        return view('backend.exam_attendence', compact('data','examname','exam_routine','couse_name'));
    }

    
  
    public function store(Request $request)
    {
          $fileName = '';
        $emp = Exam_attendence::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('Exam_committee/'), $fileName);
//$principal_images ='public/Exam_committee/'.$fileName;
$images1 ='Exam_committee/'.$fileName;

    if($request->id>0)
    {

        $imagePath = public_path('Exam_committee/' . $emp->photo);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }

    }

}
else {
    $images1 = $emp->photo;
}
  
      Exam_attendence::updateOrCreate([
            'id' => $request->id ],
        [
            'student_name' => $request->student_name,
            'exam_name' => $request->exam_name,
            'roll' => $request->roll,
            'registration' => $request->registration,
            'course_name' => $request->course_name,
             'photo' => $images1,
        ]);
        if($request->id!=0){
            return redirect('exam_attendence')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('exam_attendence')->with('massage', 'Inserted successfully!!!');
    }
    }

   
    
    public function edit( $id)
    {
        $data = Exam_attendence::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        Exam_attendence::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
