<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamName;
use App\Models\ExamSeatcard;
use App\Models\CourseName;
use App\Models\DutyRoaster;
use App\Models\Teacher;
use App\Models\DegreeTeacher;
use App\Models\ExamMasterDutyRoster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class ExamMasterDutyRosterController extends Controller
{
    public function index()
    {
        $authID = Auth::id();
        $dataa = ExamMasterDutyRoster::where('user_id',$authID)->orderBy('exam_id','desc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        $Teacher_name = Teacher::orderBy('id', 'asc')->get();
        $degreeTeacher = DegreeTeacher::orderBy('id', 'asc')->get();
        return view('backend.exam_master_duty_roster', compact('dataa','examname','course_name','Teacher_name','authID','degreeTeacher'));
    }

    public function dutyroatersingle($id){

        $dutyroaster_sigle = DutyRoaster::find($id);
        return view('backend.duty_roaster_single', compact('dutyroaster_sigle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $authID = Auth::id();
      $request->validate([
        'mobile' => ['required', 'regex:/^[0-9]{11}$/'],
    
    ]);

       ExamMasterDutyRoster::updateOrCreate([
              'id' => $request->id ],
          [
              'exam_id' => $request->exam_id,
              'user_id' => $authID,
              'name' => $request->teacher_name ?? $request->name,
              'designation' => $request->designation,
              'department' => $request->department,
              'email' => $request->email,
              'mobile' => $request->mobile,
             
          ]);
          if($request->id!=0){
              return redirect('master-duty-roaster')->with('message', 'Updated successfully!!!');
  
          }
      else{
          return redirect('master-duty-roaster')->with('message', 'Inserted successfully!!!');
      }
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit( $id)
    {
        $data = ExamMasterDutyRoster::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        ExamMasterDutyRoster::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
    public function teacherInfo(Request $request)
    {
 
            $teacherall = DB::table('teachers')
                ->where('name','=', $request->teacher_name)
                ->orderBy('name', 'asc')
                ->get();
            $degreeteacherall = DB::table('degree_teachers')
                ->where('name','=', $request->teacher_name)
                ->orderBy('name', 'asc')
                ->get();
                return json_encode([
                    'teacherall' => $teacherall,
                    'degreeteacherall' => $degreeteacherall,
                ]);
    }
  

}
