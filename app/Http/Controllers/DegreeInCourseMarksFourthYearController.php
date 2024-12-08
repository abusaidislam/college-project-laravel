<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\DegreeIncourseMarks;
use App\Models\DegreeFourthYearStudent;
use PDF;

class DegreeInCourseMarksFourthYearController extends Controller
{
    public function index()
    {

        $studentclass = DegreeClass::where('id', 4)->first();
        $studentsession = DegreeFourthYearStudent::select('session_year')->where('class_id', 4)->distinct()->get();
        $StudentIncourse = DegreeIncourseMarks::where('class_id',$studentclass->id)->orderby('years','desc')->get();;
        return view('backend.degree_incourse_mark_fourthyear', compact('StudentIncourse','studentclass','studentsession'));
      }



    public function store(Request $request)
    {

    $name = $request->name;
    $incourse_type = $request->incourse_type;
    $student_id = $request->sid;
    $written_marks = $request->marks;
    $atten_day = $request->day;
    $classId = $request->classId;
    $class_year = $request->student_class_year;
    $year = $request->year;
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
                'written1st_marks' => $written_marks[$i],
                'name' => $name[$i],
                'class_id' => $classId,
                'years' => $year,
                'atten1st_marks' => $marknum,
                'total1st_result' => $total_result,
                'student_class_year' => $class_year,
            ]
            : [
                'student_id' => $student_id[$i],
                'written2nd_marks' => $written_marks[$i],
                'name' => $name[$i],
                'class_id' => $classId,
                'years' => $year,
                'atten2nd_marks' => $marknum,
                'total2nd_result' => $total_result,
                'student_class_year' => $class_year,
            ];
        
        $dataInserts[] = $arrayElement;
    }
    
        foreach ($dataInserts as $dataInsert) {
            DegreeIncourseMarks::updateOrCreate(
                [
                    'student_id' => $dataInsert['student_id'],
                    'class_id' => $dataInsert['class_id']
                ],
                $dataInsert
            );
        }
        if ($dataInserts) {
            if ($request->id != 0) {
                return redirect('degree-fourth-year-incourse-mark')->with('massage', 'Updated successfully!!!');
            } else {
                return redirect('degree-fourth-year-incourse-mark')->with('massage', 'Inserted successfully!!!');
            }
        } else {
            return redirect('degree-fourth-year-incourse-mark')->with('massage', 'Error!!!');
        }
        
    }
    
   
    public function edit($id)
    {
        $data = DegreeIncourseMarks::find($id);
        return response()->json($data);   //
    }

 

    public function degreeIncourseFourth(Request $request){
        $userid         = $request->userid;
        $data = explode('/', $userid);  
        $class_id = $data[0]; 
        $class_year = $data[1]; 
        $Students = DB::table('degree_fourth_year_students')
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
           <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Marks " value="" required="">
           </td>
           <td align="center">
           <input type="text" class="form-control" id="day" name="day[]" placeholder="Enter Atten.Day " value="" required="">
           </td>
          </tr>';         
        }
      
        return $trList;
     }
    
     public function degreeFourthYearExportToPDF(Request $request)
     {
         $class = $request->classId;
         $classSession = $request->classSession;
         
       $data = DegreeIncourseMarks::where('class_id', $class)
             ->where('student_class_year', $classSession)
             ->get();
         
         if ($data->isEmpty()) {
             return view('backend.show_incourse_error');
         }
         
         $pdf = PDF::loadView('backend.degreeincourse_fourth_year_pdf', ['data' => $data]);
         return $pdf->stream('document.pdf');
     }

}
