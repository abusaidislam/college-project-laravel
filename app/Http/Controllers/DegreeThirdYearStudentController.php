<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\LibraryLogo;
use App\Models\DegreeOfHead;
use App\Models\DegreeFirstYearStudent;
use App\Models\DegreeStudentIdCardNote;
use App\Models\DegreeThirdYearStudent;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DegreeThirdYearImport;
use Illuminate\Validation\Rule;
use import;

class DegreeThirdYearStudentController extends Controller
{
    public function index()
    {   

        $data = DegreeThirdYearStudent::where('class_id',3)->orderBy('session_year', 'desc')->get();
        $studentclass = DegreeClass::where('id',3)->orderBy('id','asc')->get();
        $session = DegreeThirdYearStudent::select('session_year')->where('class_id', 3)->orderBy('session_year', 'desc')->distinct()->get();
        return view('backend.degreethirdyearstudent', compact('data','studentclass','session'));
    }

    public function degreeThirdYearImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new DegreeThirdYearImport,request()->file('file'));
    
       return redirect('degree-third-year-students')->with('message', 'Inserted successfully!!!');
       
    }
   


public function store(Request $request)
{
    // return $request->all();
    $validated = $request->validate([
        
        'studentclass' => 'required',
        'roll' => 'required',
        'student_name' => 'required',
        'session' => 'required',
        'registration_no' => [
            'required',
            Rule::unique('degree_third_year_students')->ignore($request->id), // Ignore the current record
            'max:200',
        ],     
    
    ]);
   

    $student =  DegreeThirdYearStudent::updateOrCreate(
        ['id' => $request->id],
        [

            'class_id' => $request->studentclass,
            'student_name' => $request->student_name,
            'roll' => $request->roll,
            'registration_no' => $request->registration_no,
            'final_cgpa' => $request->final_cgpa,
            'held_year' => $request->held_year,
            'gender' => $request->gender,
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('degree-third-year-students')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-third-year-students')->with('message', 'Inserted successfully!!!');
        }
    } else {
        return redirect('degree-third-year-students')->with('message', 'Error!!!');
    }
}

    /** 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data =     DegreeThirdYearStudent::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            DegreeThirdYearStudent::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
        
    }

    public function DegreeThirdCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeThirdYearStudent::find($id);
        $data = DegreeStudentIdCardNote::all();
        return view('backend.degreethirdyear_idcard_single', compact('basic','ndata','data' ));
    }
    public function DegreeThirdYearIdcard(Request $request)
    {
    
      $studentsession = $request->studentsession;
      
      $ndata = DegreeThirdYearStudent::where('session_year', $studentsession)->get();
      $basic = LibraryLogo::where('id',5)->first(); 
      $data = DegreeStudentIdCardNote::orderBy('id','asc')->get();
      return view('backend.degreethirdyear_idcard', compact('basic','ndata','data' ));
    }

    public function degreeThirdYearStudyCertificate($id)
    { 
        $degree = DegreeOfHead::orderBy('name','desc')->first(); 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeThirdYearStudent::where('id',$id)->first();
        $studentdata = DegreeFirstYearStudent::where('registration_no', $ndata->registration_no)->where('session', $ndata->session_year)->first();
        $className = DegreeClass::where('id',$ndata->class_id)->first();
        return view('backend.degreethirdyear_studycertificate', compact('basic','className','ndata','degree','studentdata' ));
    }
    public function degreeTestimonial($id)
    { 
        $degree = DegreeOfHead::orderBy('name','desc')->first(); 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeThirdYearStudent::where('id',$id)->first();
        $sessionParts = explode('-', $ndata->session_year);
        $endYear = $sessionParts[1] ?? '';

        $studentdata = DegreeFirstYearStudent::where('registration_no', $ndata->registration_no)->where('session', $ndata->session_year)->first();
        $className = DegreeClass::where('id',$ndata->class_id)->first();
        return view('backend.degree_testimonial', compact('basic','className','ndata','degree','studentdata','endYear' ));
    }
    
}
