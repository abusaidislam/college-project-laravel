<?php

namespace App\Http\Controllers;

use App\Models\StudentPreliminaryToMasters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\LibraryLogo;
use App\Models\DepartmentStudnetNote;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentPreliminaryToMasertsImport;
use Illuminate\Validation\Rule;
use import;

class StudentPreliminaryToMastersController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = StudentPreliminaryToMasters::where('depart_id', '=', $depart_id)->where('class_typeof', 2)->where('studentclass',5)->orderBy('session', 'desc')->get();
        $session = StudentPreliminaryToMasters::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 2)->where('id',5)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.student_preliminaryto_master', compact('data','session','depart_value','studentclass'));
    }

    public function preliminaryStudentImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new StudentPreliminaryToMasertsImport,request()->file('file'));
    
       return redirect('preliminary-masters-students')->with('massage', 'Inserted successfully!!!');
       
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
    $emp = StudentPreliminaryToMasters::find($request->id);
    
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

    $student = StudentPreliminaryToMasters::updateOrCreate(
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
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('preliminary-masters-students')->with('massage', 'Updated successfully!!!');
        } else {
            return redirect('preliminary-masters-students')->with('massage', 'Inserted successfully!!!');
        }
    } else {
        return redirect('preliminary-masters-students')->with('massage', 'Error!!!');
    }
}

  
    public function edit($id)
    {
         $data = StudentPreliminaryToMasters::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        StudentPreliminaryToMasters::find($id)->delete();

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
    
public function PreliminaryStudentCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',7)->first(); 
        $ndata = StudentPreliminaryToMasters::find($id);
        $data = DepartmentStudnetNote::all();
        return view('backend.student_perliminary_idcard_single', compact('basic','ndata','data' ));
    }

     
public function StudentPreliminaryIDCard(Request $request)
{

  $studentsession = $request->studentsession;
  $ndata = StudentPreliminaryToMasters::where('session', $studentsession)->get();
  $basic = LibraryLogo::where('id',7)->first(); 
  $data = DepartmentStudnetNote::orderBy('id','asc')->get();
  return view('backend.student_perliminary_idcard', compact('basic','ndata','data' ));
}

public function PreliminaryStudyCertificate($id)
{ 
    $depart_id = Session::get('depart_id');
    $depart_name = Session::get('depart_name');
    $departlastName = str_replace("Department of ", "", $depart_name);
    $basic = LibraryLogo::where('id',7)->first(); 
    $headsigniture = LibraryLogo::where('id',7)->where('depart_id', '=', $depart_id)->first(); 
    $ndata = StudentPreliminaryToMasters::find($id);
    $className = StudenClass::where('type_of', 2)->where('id',5)->first();
    return view('backend.student_preliminary_studycertificate', compact('basic','className','ndata','depart_name','headsigniture','departlastName' ));
}

}
