<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\LibraryLogo;
use App\Models\DepartmentStudnetNote;
use App\Models\StudentSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentInfoImport;
use App\Imports\StudentHonoursSecountYearImport;
use Illuminate\Validation\Rule;
use import;
class StudentController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = Student::where('depart_id', '=', $depart_id)->where('class_typeof', 1)->where('studentclass',1)->orderBy('session', 'desc')->get();
        $session = Student::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 1)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 1)->where('id',1)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.studentmanage', compact('data','session','depart_value','studentclass'));
    }
    public function StudentImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new StudentInfoImport,request()->file('file'));
    
       return redirect('honours-first-year-students')->with('massage', 'Inserted successfully!!!');
       
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
        'register_roll' => 'required',
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
 
    $request->validate([
        'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
    ]);

    $class_typeof = StudenClass::select('type_of')->where('id', $request->studentclass)->first();
    $depart_id = $request->depart_id;
    $depart_name = Session::get('depart_name');

    
            $fileName = '';
            $emp = Student::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('student/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('student/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
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
            'register_roll' => $request->register_roll,
            'session' => $request->session,
            'roll' => $request->roll,
            'registration_no' => $request->registration_no,
            'department' => $depart_name,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('honours-first-year-students')->with('massage', 'Updated successfully!!!');
        } else {
            return redirect('honours-first-year-students')->with('massage', 'Inserted successfully!!!');
        }
    } else {
        return redirect('honours-first-year-students')->with('massage', 'Error!!!');
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
  

 public function StudentCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',7)->first(); 
        $ndata = Student::find($id);
        $data = DepartmentStudnetNote::all();
        return view('backend.firstyear_idcardsingle.blade.php', compact('basic','ndata','data' ));
    }

     
public function HonoursFirstYearIDCard(Request $request)
{

  $studentsession = $request->studentsession;
  $ndata = Student::where('session', $studentsession)->get();
  $basic = LibraryLogo::where('id',7)->first(); 
  $data = DepartmentStudnetNote::orderBy('id','asc')->get();
  return view('backend.student_honours_firstyear_idcard', compact('basic','ndata','data' ));
}

public function honorsFirstYearStudyCertificate($id)
{ 
    $depart_id = Session::get('depart_id');
    $depart_name = Session::get('depart_name');
    $departlastName = str_replace("Department of ", "", $depart_name);
    $basic = LibraryLogo::where('id',7)->first(); 
    $headsigniture = LibraryLogo::where('id',7)->where('depart_id', '=', $depart_id)->first(); 
    $ndata = Student::find($id);
    $className = StudenClass::where('type_of', 1)->where('id',1)->first();
    return view('backend.student_honors_firstyear_studycertificate', compact('basic','className','ndata','depart_name','headsigniture','departlastName' ));
}
}
