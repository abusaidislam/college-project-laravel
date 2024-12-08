<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\LibraryLogo;
use App\Models\DepartmentStudnetNote;
use App\Models\StudentHonoursThirdYear;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentHonoursThirdYearImport;
use Illuminate\Validation\Rule;
use import;

class StudentHonoursThirdYearController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = StudentHonoursThirdYear::where('depart_id', '=', $depart_id)->where('class_typeof', 1)->where('class_id',3)->orderBy('session_year', 'desc')->get();
        $studentclass = StudenClass::where('type_of', 1)->where('id',3)->orderby('id','asc')->get();
        $depart_value = Department::all();
        $session = StudentHonoursThirdYear::select('session_year')->where('depart_id', '=', $depart_id)->where('class_typeof', 1)->orderBy('session_year', 'desc')->distinct()->get();
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.student_honours3rdYear_manage', compact('data','depart_value','studentclass','session'));
    }

    public function thirdYearStudentImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new StudentHonoursThirdYearImport,request()->file('file'));
    
       return redirect('honours-third-year-students')->with('massage', 'Inserted successfully!!!');
       
    }
   


public function store(Request $request)
{
    
    $validated = $request->validate([
        
        'studentclass' => 'required',
        'roll' => 'required',
        'student_name' => 'required',
        'session' => 'required',
        'registration_no' => [
            'required',
            Rule::unique('student_honours_third_years')->ignore($request->id), // Ignore the current record
            'max:200',
        ],      
    
    ]);
   

    $class_typeof = StudenClass::select('type_of')->where('id', $request->studentclass)->first();
    $depart_id = $request->depart_id;
    $depart_name = Session::get('depart_name');
    
   
    $student = StudentHonoursThirdYear::updateOrCreate(
        ['id' => $request->id],
        [

            'depart_id' => $request->depart_id,
            'class_id' => $request->studentclass,
            'class_typeof' => $class_typeof->type_of,
            'student_name' => $request->student_name,
            'roll' => $request->roll,
            'session_year' => $request->session,
            'registration_no' => $request->registration_no,
          
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('honours-third-year-students')->with('massage', 'Updated successfully!!!');
        } else {
            return redirect('honours-third-year-students')->with('massage', 'Inserted successfully!!!');
        }
    } else {
        return redirect('honours-third-year-students')->with('massage', 'Error!!!');
    }
}


    public function edit($id)
    {
         $data = StudentHonoursThirdYear::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        StudentHonoursThirdYear::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
        
    }

 public function ThirdStudentCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',7)->first(); 
        $ndata = StudentHonoursThirdYear::find($id);
        $data = DepartmentStudnetNote::all();
        return view('backend.student_honours_thirdyear_idcard_single', compact('basic','ndata','data' ));
    }

public function HonoursThirdYearIDCard(Request $request)
{
    
  $studentsession = $request->studentsession;
  $ndata = StudentHonoursThirdYear::where('session_year', $studentsession)->get();
  $basic = LibraryLogo::where('id',7)->first(); 
  $data = DepartmentStudnetNote::orderBy('id','asc')->get();
  return view('backend.student_honours_thirdyear_idcard', compact('basic','ndata','data' ));
}   

public function honorsThirdYearStudyCertificate($id)
{ 
    $depart_id = Session::get('depart_id');
    $depart_name = Session::get('depart_name');
    $departlastName = str_replace("Department of ", "", $depart_name);
    $basic = LibraryLogo::where('id',7)->first(); 
    $headsigniture = LibraryLogo::where('id',7)->where('depart_id', '=', $depart_id)->first(); 
    $ndata = StudentHonoursThirdYear::where('id', $id)->first();
    $studentndata = Student::where('registration_no',$ndata->registration_no)->where('depart_id', '=', $depart_id)->first();
    $className = StudenClass::where('type_of', 1)->where('id',3)->first();
    return view('backend.student_honors_thirdyear_studycertificate', compact('basic','className','ndata','depart_name','headsigniture','departlastName','studentndata' ));
}
}
