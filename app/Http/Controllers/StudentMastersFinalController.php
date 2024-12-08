<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\LibraryLogo;
use App\Models\DepartmentStudnetNote;
use App\Models\StudentMastersFinal;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentMasertsFinalImport;
use Illuminate\Validation\Rule;
use import;

class StudentMastersFinalController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = StudentMastersFinal::where('depart_id', '=', $depart_id)->where('class_typeof', 2)->where('studentclass',6)->orderBy('session', 'desc')->get();
        $session = StudentMastersFinal::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 2)->where('id',6)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.student_masters_final', compact('data','session','depart_value','studentclass'));
    }

    public function preliminaryStudentImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new StudentMasertsFinalImport,request()->file('file'));
    
       return redirect('masters-Final-students')->with('massage', 'Inserted successfully!!!');
       
    }
    
public function store(Request $request)
{
    // return $request->all();
    $validated = $request->validate([
        'name' => 'required',
        'father_name' => 'required',
        'mather_name' => 'required',
        'father_mobile' => 'required',
        'email' => 'required|email',
        'studentclass' => 'required',
        'register_roll' => 'required',
        'session' => 'required',
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
    $emp = StudentMastersFinal::find($request->id);
    
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
        $fileName = $emp->photo;
    }
   
    $student = StudentMastersFinal::updateOrCreate(
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
            'department' => $depart_name,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
            'final_cgpa' => $request->final_cgpa,
            'held_year' => $request->held_year,
            'gender' => $request->gender,
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('masters-Final-students')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('masters-Final-students')->with('message', 'Inserted successfully!!!');
        }
    } else {
        return redirect('masters-Final-students')->with('message', 'Error!!!');
    }
}

  
    public function edit($id)
    {
         $data = StudentMastersFinal::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        StudentMastersFinal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
    public function studentSessionData($session)
    {
        $depart_id = Session::get('depart_id');
        $student_info = DB::table('students')
        ->where('session', $session)
        ->where('depart_id', $depart_id)
        ->where('class_typeof', 1)
        ->get();
    return response()->json($student_info);
    }
    
    public function updateStudentData(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $session = $request->input('session');
        $roll = $request->input('roll');
        $registration_no = $request->input('registration_no');
        $studentclass = $request->input('studentclass');
        return response()->json(['message' => 'Data updated successfully']);
    }
    public function studentData(Request $request){

        $depart_id = Session::get('depart_id');
        $student_info = DB::table('students')
        ->where('session', $request->stu_session)
        ->where('depart_id', $depart_id)
        ->where('class_typeof', 1)
        ->get();
        return view('backend.student_editable', compact('student_info'));
    }
    

public function MasterfinalStudentCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',7)->first(); 
        $ndata = StudentMastersFinal::find($id);
        $data = DepartmentStudnetNote::all();
        return view('backend.student_masterfinal_idcard_single', compact('basic','ndata','data' ));
    }

     
public function StudentMasterfinalIDCard(Request $request)
{

  $studentsession = $request->studentsession;
  $ndata = StudentMastersFinal::where('session', $studentsession)->get();
  $basic = LibraryLogo::where('id',7)->first(); 
  $data = DepartmentStudnetNote::orderBy('id','asc')->get();
  return view('backend.student_masterfinal_idcard', compact('basic','ndata','data' ));
}

public function MasterfinalStudyCertificate($id)
{ 
    $depart_id = Session::get('depart_id');
    $depart_name = Session::get('depart_name');
    $departlastName = str_replace("Department of ", "", $depart_name);
    $basic = LibraryLogo::where('id',7)->first(); 
    $headsigniture = LibraryLogo::where('id',7)->where('depart_id', '=', $depart_id)->first(); 
    $ndata = StudentMastersFinal::find($id);
    $className = StudenClass::where('type_of', 2)->where('id',6)->first();
    return view('backend.student_masterfinal_studycertificate', compact('basic','className','ndata','depart_name','headsigniture','departlastName' ));
}
public function mastersTestimonial($id)
{ 
    $depart_id = Session::get('depart_id');
    $depart_name = Session::get('depart_name');
    $departlastName = str_replace("Department of ", "", $depart_name);
    $basic = LibraryLogo::where('id',7)->first(); 
    $headsigniture = LibraryLogo::where('id',7)->where('depart_id', '=', $depart_id)->first(); 
    $ndata = StudentMastersFinal::find($id);
    $sessionParts = explode('-', $ndata->session);
    $endYear = $sessionParts[1] ?? '';
    $className = StudenClass::where('type_of', 2)->where('id',6)->first();
    return view('backend.student_masters_testimonial', compact('basic','headsigniture','depart_name','departlastName','className','ndata','endYear' ));
}

}
