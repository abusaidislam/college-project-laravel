<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExamName;
use App\Models\ExamSeatcard;
use App\Models\CourseName;
use App\Models\DutyRoaster;
use App\Models\ExamRoutine;
use App\Models\Teacher;
use App\Models\BuldingName;
use App\Models\ExamMasterDutyRoster;
use App\Models\ExamRoomwiseMasterDuty;
use App\Models\ExamRoomwiseMasterDutyRoster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamRoomwiseMasterDutyController extends Controller
{
  
    public function index()
    {
        $authID = Auth::id();
        // $dataa = ExamMasterDutyRoster::where('user_id',$authID)->orderBy('id', 'asc')->get();
        // $roomWiseData = ExamRoomwiseMasterDuty::where('user_id',$authID)->orderBy('id', 'asc')->get();
        $roomWiseDataRoster = ExamRoomwiseMasterDutyRoster::where('user_id',$authID)->orderBy('id', 'asc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        $building_name = BuldingName::orderBy('id', 'asc')->get();
        $routine = ExamRoutine::orderBy('id', 'asc')->get();
        $Teacher_name = Teacher::orderBy('id', 'asc')->get();
        return view('backend.exam_roomwise_master_duty', compact('building_name','authID','roomWiseDataRoster','routine','examname','course_name','Teacher_name'));
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
      ExamRoomwiseMasterDutyRoster::updateOrCreate([
              'id' => $request->id ],
          [
              'exam_id' => $request->exam_id,
              'user_id' => $authID,
              'teacher_masterduty_id' => $request->teacher_name,
              'duty_date' => $request->duty_date,
              'building_id' => $request->building,
              'room_id' => $request->room_num,

          ]);
          if($request->id!=0){
              return redirect('room-wise-master-duty')->with('message', 'Updated successfully!!!');
  
          }
      else{
          return redirect('room-wise-master-duty')->with('message', 'Inserted successfully!!!');
      }
      }

  

    public function edit( $id)
    {
        $data = ExamRoomwiseMasterDutyRoster::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        ExamRoomwiseMasterDutyRoster::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
    public function ExamData(Request $request)
    {
        $authID = Auth::id();
        $userType = DB::table('users')
        ->where('id', $authID)
        ->first();
        if($userType->usertype == 7){
            $Examroutine = DB::table('exam_routines')->where('exam_id',$request->id)->orderBy('date','asc')->get();
            return json_encode($Examroutine);
        }else{
            $Examroutine = DB::table('exam_dr_routines')->where('exam_id',$request->id)->orderBy('date','asc')->get();
            return json_encode($Examroutine);
        }
       
    }
    public function ExamDateInfo(Request $request)
    {
        $ExamMaster = DB::table('exam_master_duty_rosters')->where('exam_id',$request->examData)->orderBy('id','asc')->get();
         return json_encode($ExamMaster);
    }
    public function BuildingData(Request $request)
    {
        $roominfo = DB::table('room_no')->where('building_id',$request->id)->orderBy('title','asc')->get();
         return json_encode($roominfo);
    }
    public function teacherMasterInfo(Request $request)
    {
        $teacherall = DB::table('exam_master_duty_rosters')->where('id',$request->teacher_masterid)->orderBy('id','asc')->get();
        return json_encode($teacherall);
           
    }
//     function ExamMasterRoomWiseEditDataAction(Request $request)
 
//     {
//        return $dutyDate = json_decode($request->examdate);
//     // $datesArray = json_decode($request->attendance, true); // Decode as an associative array

//     ExamRoomwiseMasterDuty::updateOrCreate(
//         ['id' => $request->rowid],
//         [
//             // 'duty_date' => $dutyDate,
//             'teacher_masterduty_id' => $request->rowid,
//             'room_number' => $datesArray,
//         ]
//     );
        
//         return response()->json(['message' => 'Data saved successfully.']);
//   }
    

}
