<?php

namespace App\Http\Controllers;
use App\Models\SeminarLibraryCard;
use App\Models\Basic;
use App\Models\Department;
use App\Models\LibraryLogo;
use App\Models\StudenClass;
use App\Models\SeminarCardInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Carbon;

class SeminarLibraryCardController extends Controller
{
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $department = Department::orderBy('id', 'asc')->get();
        $className = StudenClass::orderBy('id', 'asc')->get();
        $data = SeminarLibraryCard::where('department_id',$depart_id)->orderBy('id', 'desc')->get();
        $SeminarCardinfo = SeminarLibraryCard::select(DB::raw('DATE(created_at) as date'))
        ->orderByDesc('date')
        ->distinct()
        ->limit(10)
        ->get();
        return view('backend.seminar_library_card', compact('data','department','className','SeminarCardinfo'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        try {
            $fileName = '';
            $emp = SeminarLibraryCard::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('library_card/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library_card/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
            
    
            SeminarLibraryCard::updateOrCreate([
                'id' => $request->id
            ], [
                'department_id' => $request->department_id,
                'session' => $request->session,
                'class' => $request->class,
                'student_name' => $request->stu_name,
                'roll' => $request->roll,
                'registration' => $request->registration,
                'mobile_no' => $request->mobile_no,
                'blood_group' => $request->blood_group,
                'card_no' => $request->card_no,
                'date' => $request->date,
                'photo' => $fileName,
              
            ]);
          
            if ($request->id != 0) {
                return redirect('seminar-id-card')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('seminar-id-card')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('seminar-id-card')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = SeminarLibraryCard::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = SeminarLibraryCard::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('library_card/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}


    public function seminarCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',6)->first(); 
        $ndata = SeminarLibraryCard::find($id);
        $data = SeminarCardInstruction::all();
        return view('backend.seminar_card_details', compact('basic','ndata','data' ));
    }

 
public function SeminarCardExportToPDF(Request $request)
{

  $date = $request->createddate;
  $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateString();
  
  $ndata = SeminarLibraryCard::whereDate('created_at', $formattedDate)->get();
  $basic = LibraryLogo::where('id',6)->first(); 
  $data = SeminarCardInstruction::all();
  return view('backend.seminar_library_card_pdf', compact('basic','ndata','data' ));
}
        
       

    public function seminarClassInfo($id)
    {
        $depart_id = Session::get('depart_id');
        $sessions = [];
    
        switch ($id) {
            case 1:
                $sessions = DB::table('students')
                    ->select('session','studentclass')
                    ->where('studentclass', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session', 'desc')
                    ->distinct()
                    ->get();
                break;
            case 2:
                $sessions = DB::table('student_honours_secound_years')
                    ->select('session_year','class_id')
                    ->where('class_id', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session_year', 'desc')
                    ->distinct()
                    ->get();
                break;
            case 3:
                $sessions = DB::table('student_honours_third_years')
                    ->select('session_year','class_id')
                    ->where('class_id', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session_year', 'desc')
                    ->distinct()
                    ->get();
                break;
            case 4:
                $sessions = DB::table('student_honours_fourth_years')
                    ->select('session_year','class_id')
                    ->where('class_id', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session_year', 'desc')
                    ->distinct()
                    ->get();
                break;
            case 5:
                $sessions = DB::table('student_preliminary_to_masters')
                    ->select('session','studentclass')
                    ->where('studentclass', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session', 'desc')
                    ->distinct()
                    ->get();
                break;
            case 6:
                $sessions = DB::table('student_masters_finals')
                    ->select('session','studentclass')
                    ->where('studentclass', $id)
                    ->where('depart_id', $depart_id)
                    ->orderBy('session', 'desc')
                    ->distinct()
                    ->get();
                break;
            default:
                break;
        }
    
        return response()->json($sessions);
    }
    
   
     public function seminarStudentInfo(Request $request){
            $userid         = $request->userid;
            $data = explode('/', $userid);  
            $class_id = $data[0]; 
            $class_year = $data[1]; 
            $depart_id    = Session::get('depart_id');
         $student = [];
        switch ($class_id) {
            case 1:
                $student = DB::table('students')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session', $class_year)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            case 2:
                $student = DB::table('student_honours_secound_years')
                    ->where('class_id', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session_year', $class_year)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 3:
                $student = DB::table('student_honours_third_years')
                    ->where('class_id', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session_year', $class_year)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 4:
                $student = DB::table('student_honours_fourth_years')
                    ->where('class_id', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session_year', $class_year)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 5:
                $student = DB::table('student_preliminary_to_masters')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session', $class_year)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            case 6:
                $student = DB::table('student_masters_finals')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('session', $class_year)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            default:
                break;
        }
      
        return json_encode($student);
        
    }
     public function seminarstuallInfo(Request $request){
            $stu_id  = $request->stu_id;
            $data = explode('/', $stu_id);  
            $class_id = $data[0]; 
            $stu_id = $data[1]; 
            $depart_id    = Session::get('depart_id');
         $studentall = [];
        switch ($class_id) {
            case 1:
                $studentall = DB::table('students')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('id', $stu_id)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            case 2:
                $studentall = DB::table('student_honours_secound_years')
                    ->where('student_honours_secound_years.class_id', $class_id)
                    ->where('student_honours_secound_years.depart_id', $depart_id)
                    ->where('student_honours_secound_years.id', $stu_id)
                    ->join('students', 'student_honours_secound_years.registration_no', '=', 'students.registration_no')
                    ->select('student_honours_secound_years.*', 'students.mobile_no', 'students.blood_group')
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 3:
                $studentall = DB::table('student_honours_third_years')
                    ->where('class_id', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('id', $stu_id)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 4:
                $studentall = DB::table('student_honours_fourth_years')
                    ->where('class_id', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('id', $stu_id)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 5:
                $studentall = DB::table('student_preliminary_to_masters')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('id', $stu_id)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            case 6:
                $studentall = DB::table('student_masters_finals')
                    ->where('studentclass', $class_id)
                    ->where('depart_id', $depart_id)
                    ->where('id', $stu_id)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            default:
                break;
        }
      
        return json_encode($studentall);
        
    }
   
       
}