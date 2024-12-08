<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\DegreeFourthYearStudent;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DegreeFourthYearImport;
use Illuminate\Validation\Rule;
use import;

class DegreeFourthYearStudentController extends Controller
{
    public function index()
    {   

        $data = DegreeFourthYearStudent::where('class_id',4)->orderBy('session_year', 'desc')->get();
        $studentclass = DegreeClass::where('id',4)->orderBy('id','asc')->get();

        return view('backend.degreefourthyearstudent', compact('data','studentclass'));
    }

    public function degreeFourthYearImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new DegreeFourthYearImport,request()->file('file'));
    
       return redirect('degree-fourth-year-students')->with('massage', 'Inserted successfully!!!');
       
    }
   


public function store(Request $request)
{
    
    $validated = $request->validate([
        
        'studentclass' => 'required',
        'roll' => 'required',
        'student_name' => 'required',
        'session' => 'required',
        'class_year_session' => 'required',
        'registration_no' => [
            'required',
            Rule::unique('degree_fourth_year_students')->ignore($request->id), // Ignore the current record
            'max:200',
        ],
        'register_roll' => 'required',
      
    
    ]);
   

//    $fileName = '';
//    $emp = Student::find($request->id);
//    if ( $request->photo)
//    {
//        $fileName = time().'.'.$request->photo->getClientOriginalExtension();
   
//        $request->photo->move(public_path('student/'), $fileName);
   
//        if($request->id>0)
//        {
   
//            $imagePath = public_path('student/' . $emp->photo);
//            if(File::exists($imagePath)){
//                unlink($imagePath);
//            }
   
//        }
   
//    }
//    else {
//        $fileName = $emp->photo;
//    }
   
    $student =  DegreeFourthYearStudent::updateOrCreate(
        ['id' => $request->id],
        [

            'class_id' => $request->studentclass,
            'student_name' => $request->student_name,
            'roll' => $request->roll,
            'session_year' => $request->session,
            'class_year' => $request->class_year_session,
            'registration_no' => $request->registration_no,
            'register_rollID' => $request->register_roll,
          
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('degree-fourth-year-students')->with('massage', 'Updated successfully!!!');
        } else {
            return redirect('degree-fourth-year-students')->with('massage', 'Inserted successfully!!!');
        }
    } else {
        return redirect('degree-fourth-year-students')->with('massage', 'Error!!!');
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
         $data =     DegreeFourthYearStudent::find($id);
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
            DegreeFourthYearStudent::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
        
    }
    
}
