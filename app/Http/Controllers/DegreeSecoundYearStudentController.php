<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\DegreeOfHead;
use App\Models\LibraryLogo;
use App\Models\DegreeStudentIdCardNote;
use App\Models\DegreeSecoundYearStudent;
use App\Models\DegreeFirstYearStudent;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DegreeSecoundYearImport;
use Illuminate\Validation\Rule;
use import;

class DegreeSecoundYearStudentController extends Controller
{
    public function index()
    {   

        $data = DegreeSecoundYearStudent::where('class_id',2)->orderBy('session_year', 'desc')->get();
        $studentclass = DegreeClass::where('id',2)->orderBy('id','asc')->get();
        $session = DegreeSecoundYearStudent::select('session_year')->where('class_id', 2)->orderBy('session_year', 'desc')->distinct()->get();
        return view('backend.degreesecoundyearstudent', compact('data','studentclass','session'));
    }

    public function degreesecoundYearImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new DegreeSecoundYearImport,request()->file('file'));
    
       return redirect('degree-secound-year-students')->with('message', 'Inserted successfully!!!');
       
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
            Rule::unique('degree_secound_year_students')->ignore($request->id), // Ignore the current record
            'max:200',
        ],
      
    
    ]);
   

   
    $student = DegreeSecoundYearStudent::updateOrCreate(
        ['id' => $request->id],
        [

            'class_id' => $request->studentclass,
            'student_name' => $request->student_name,
            'roll' => $request->roll,
            'session_year' => $request->session,
            'registration_no' => $request->registration_no,
          
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('degree-secound-year-students')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-secound-year-students')->with('message', 'Inserted successfully!!!');
        }
    } else {
        return redirect('degree-secound-year-students')->with('message', 'Error!!!');
    }
}


    public function edit($id)
    {
         $data = DegreeSecoundYearStudent::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        DegreeSecoundYearStudent::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
        
    }

    public function DegreeSecondCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeSecoundYearStudent::find($id);
        $data = DegreeStudentIdCardNote::all();
        return view('backend.degreesecondyear_idcard_single', compact('basic','ndata','data' ));
    }
    public function DegreeSecondYearIdcard(Request $request)
    {
    
      $studentsession = $request->studentsession;
      
      $ndata = DegreeSecoundYearStudent::where('session_year', $studentsession)->get();
      $basic = LibraryLogo::where('id',5)->first(); 
      $data = DegreeStudentIdCardNote::orderBy('id','asc')->get();
      return view('backend.degreesecondyear_idcard', compact('basic','ndata','data' ));
    }
    public function degreeSecondYearStudyCertificate($id)
    { 
        $degree = DegreeOfHead::orderBy('name','desc')->first(); 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeSecoundYearStudent::where('id',$id)->first();
        $studentdata = DegreeFirstYearStudent::where('registration_no', $ndata->registration_no)->where('session', $ndata->session_year)->first();
        $className = DegreeClass::where('id',$ndata->class_id)->first();
        return view('backend.degreesecondyear_studycertificate', compact('basic','className','ndata','degree','studentdata' ));
    }
}
