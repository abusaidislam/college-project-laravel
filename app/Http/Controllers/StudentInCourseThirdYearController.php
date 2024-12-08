<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\StudentIncourseMarks;
use App\Models\StudentHonoursThirdYear;
use PDF;
class StudentInCourseThirdYearController extends Controller
{
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');
       
        $studentclass = StudenClass::where('id', 3)->first();
        $studentsession = StudentHonoursThirdYear::select('session_year')->where('class_id', 3)->distinct()->limit(10)->get();
        $StudentIncourse = StudentIncourseMarks::where('depart_id', '=', $depart_id)->where('class_id',$studentclass->id)->orderby('years','desc')->get();;
        $Course   = CourseName::where('depart_id', '=',$depart_id)->where('class_id', $studentclass->id)->orderBy('name','asc')->get();
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentincoursethirdyear', compact('depart_id','studentsession','StudentIncourse','depart_name','studentclass','Course'));
    
    }

 
    public function store(Request $request)
    {
        $depart_id = $request->depart_id;
    $depart_name = Session::get('depart_name');
    $name = $request->name;
    $incourse_type = $request->incourse_type;
    $student_id = $request->sid;
    $written_marks = $request->marks;
    $atten_day = $request->day;
    $classId = $request->classId;
    $class_year = $request->student_class_year;
    $year = $request->year;
    $courseCode = $request->subject;
    $dataInserts = [];
    
    for ($i = 0; $i < count($written_marks); $i++) {
        
        if ($atten_day[$i] >= 90) {
            $marknum = 5;
        } elseif ($atten_day[$i] >= 80 && $atten_day[$i] < 90) {
            $marknum = 4;
        } elseif ($atten_day[$i] >= 75 && $atten_day[$i] < 80) {
            $marknum = 3;
        } elseif ($atten_day[$i] >= 60 && $atten_day[$i] < 75) {
            $marknum = 2;
        } elseif ($atten_day[$i] >= 50 && $atten_day[$i] < 60) {
            $marknum = 1;
        } else {
            $marknum = 0;
        }

        $total_result = $written_marks[$i] + $marknum;
        
        $arrayElement = ($incourse_type == 1)
            ? [
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
                'written1st_marks' => $written_marks[$i],
                'name' => $name[$i],
                'class_id' => $classId,
                'years' => $year,
                'course_code' => $courseCode,
                'atten1st_marks' => $marknum,
                'total1st_result' => $total_result,
                'student_class_year' => $class_year,
            ]
            : [
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
                'written2nd_marks' => $written_marks[$i],
                'name' => $name[$i],
                'class_id' => $classId,
                'years' => $year,
                'course_code' => $courseCode,
                'atten2nd_marks' => $marknum,
                'total2nd_result' => $total_result,
                'student_class_year' => $class_year,
            ];
        
        $dataInserts[] = $arrayElement;
    }
    
        foreach ($dataInserts as $dataInsert) {
            StudentIncourseMarks::updateOrCreate(
                [
                    'student_id' => $dataInsert['student_id'],
                    'class_id' => $dataInsert['class_id'],
                    'depart_id' => $dataInsert['depart_id'],
                    'course_code' => $dataInsert['course_code'],
                ],
                $dataInsert
            );
        }
    
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        if ($dataInserts) {
            if ($request->id != 0) {
                return redirect('third-year-incourse-mark')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('third-year-incourse-mark')->with('message', 'Inserted successfully!!!');
            }
        } else {
            return redirect('third-year-incourse-mark')->with('message', 'Error!!!');
        }
    }
    
    public function edit($id)
    {
        $data = StudentIncourseMarks::find($id);
        return response()->json($data); 
    }

    public function getIncourseThird(Request $request){
        $userid         = $request->userid;
        $data = explode('/', $userid);  
        $class_id = $data[0]; 
        $class_year = $data[1]; 
        $depart_id    = Session::get('depart_id');
        $Students =DB::table('student_honours_third_years')
                        ->where('depart_id', $depart_id)
                        ->where('class_id', $class_id)
                        ->where('session_year', $class_year)
                        ->orderBy('registration_no','asc')
                        ->get();
                $trList           = [];
                foreach ($Students as $value) {
                $trList[] = '<tr>
                <td align="center">'. $value->id .'</td>
                <td align="center">
                <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->student_name .'" required="">
                </td> 
                <input type="hidden" name="sid[]" value="'. $value->id .'" >
                <td align="center">
                <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter (0-15) Marks" value="" required="">
                </td>
                <td align="center">
                <input type="text" class="form-control" id="day" name="day[]" placeholder="Enter Atten.Day " value="" required="">
                </td>
                </tr>';         
                }
        return $trList;
     }
    
     public function ThirdYearExportToPDF(Request $request)
     {
        $class = $request->classId;
        $classSession = $request->classSession;
        $depart_id = $request->depart_id;
        $subject = $request->subject;
        $data = StudentIncourseMarks::where('class_id', $class)
             ->where('student_class_year', $classSession)
             ->where('depart_id', $depart_id)
             ->where('course_code', $subject)
             ->orderBy('student_id','asc')
             ->get();
        
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }

        $pdf = PDF::loadView('backend.studentincourse_third_year_pdf', ['data' => $data,'depart_id' => $depart_id,'subject' => $subject,'class' => $class]);
        return $pdf->stream('document.pdf');
     }



}
