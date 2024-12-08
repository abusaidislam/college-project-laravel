<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\StudentSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentInfoImport;
use Illuminate\Validation\Rule;
use import;

class StudentMastersController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = Student::where('depart_id', '=', $depart_id)->where('class_typeof', 2)->orderBy('session', 'desc')->get();
        $studentclass = StudenClass::where('type_of', 2)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.student_master_manage', compact('data','depart_value','studentclass'));
    }

    public function StudentImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new StudentInfoImport,request()->file('file'));
    
       return redirect('masters-students')->with('massage', 'Inserted successfully!!!');
       
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'father_name' => 'required',
        'mather_name' => 'required',
        'father_mobile' => 'required',
        'email' => 'required|email',
        'studentclass' => 'required',
        'roll' => 'required',
        'session' => 'required',
        'registration_no' => [
            'required',
            Rule::unique('students')->ignore($request->id), // Ignore the current record
            'max:200',
        ],
        'mobile_no' => 'required',
        'blood_group' => 'required',
        'home_dis' => 'required',
    
    ]);
    if ($request->hasFile('photo')) {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
    }

    $class_typeof = StudenClass::select('type_of')->where('id', $request->studentclass)->first();
    $depart_id = $request->depart_id;
    $depart_name = Session::get('depart_name');
    

   $fileName = '';
   $emp = Student::find($request->id);
   if ( $request->photo)
   {
       $fileName = time().'.'.$request->photo->getClientOriginalExtension();
   
       $request->photo->move(public_path('student/'), $fileName);
   
       if($request->id>0)
       {
   
           $imagePath = public_path('student/' . $emp->photo);
           if(File::exists($imagePath)){
               unlink($imagePath);
           }
   
       }
   
   }
   else {
       $fileName = $emp->photo;
   }
   
    $student = Student::updateOrCreate(
        ['id' => $request->id],
        [
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mather_name' => $request->mather_name,
            'father_mobile' => $request->father_mobile,
            'email' => $request->email,
            'depart_id' => $request->depart_id,
            'photo' => $fileName,
            'studentclass' => $request->studentclass,
            'class_typeof' => $class_typeof->type_of,
            'roll' => $request->roll,
            'session' => $request->session,
            'department' => $depart_name,
            'registration_no' => $request->registration_no,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]
    );

    $studentId = $student->id;
    $session_year = $student->session;
    $class_name = $student->studentclass;
    $depart_id = $student->depart_id;
    $class_typeof = $student->class_typeof;
    
    $StudentSession = [
        'stu_id' => $studentId,
        'session_year' => $session_year,
        'class_year' => $session_year,
        'class_name' => $class_name, 
        'class_typeof' => $class_typeof, 
        'depart_id' => $depart_id, 
    
    ];

    StudentSession::updateOrCreate(['stu_id' => $studentId], $StudentSession);

    Session::put('depart_id', $depart_id);
    Session::put('depart_name', $depart_name);

    if ($student) {
        if ($request->id != 0) {
            return redirect('masters-students')->with('massage', 'Updated successfully!!!');
        } else {
            return redirect('masters-students')->with('massage', 'Inserted successfully!!!');
        }
    } else {
        return redirect('masters-students')->with('massage', 'Error!!!');
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
         $data = Student::find($id);
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
        Student::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
