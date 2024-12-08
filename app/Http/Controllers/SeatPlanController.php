<?php

namespace App\Http\Controllers;
use App\Models\SeatPlan;
use App\Models\RoomNo;
use App\Models\Student;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\Department;
use App\Models\ExamName;
use App\Models\ExamRoutine;
use App\Models\DegreeClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
class SeatPlanController extends Controller
{
     public function index()
    {  
  //table a data show
       $authID = Auth::id();
       $seatplandata = SeatPlan::where('user_id',$authID)->orderBy('id', 'desc')->get();
       $data = RoomNo::orderBy('id', 'asc')->get();
       $student = Student::orderBy('id', 'asc')->get();
       $depart_info = Department::orderBy('id', 'asc')->get();
       $degree_info = User::where('id', 17)->first();
       $seatplans = SeatPlan::orderBy('id', 'asc')->get();     
       $room_details = RoomNo::where('id',6)->first();
       $seat_details = SeatPlan::where('room_num',$room_details->id)->orderBy('id', 'asc')->get();
       $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
       return view('backend.exam_seatplan', compact('data','examname','room_details','seat_details','student','depart_info','degree_info','seatplans','seatplandata'));
        
    }
    public function departExamShowSeatPlan(Request $request)
    {
        
        // return($request);
        $authID = Auth::id();
        $exam_info = ExamName::where('id', $request->exam_name)->first();
        $exam_date = ExamRoutine::where('id', $request->duty_date)->first();
        $room_details = RoomNo::where('id', $request->room_num)->first();
        $College_Seatdetails = SeatPlan::select('depart_id','exam_id','exam_routin_id')->where('user_id',$authID)->where('room_num', $room_details->id)->where('exam_id',$request->exam_name)->where('exam_routin_id',$request->duty_date)->orderBy('depart_id', 'asc')->distinct()->get();
        
        $seat_details = SeatPlan::where('user_id',$authID)->where('room_num', $room_details->id)->where('exam_id',$request->exam_name)->where('exam_routin_id',$request->duty_date)->orderBy('id', 'asc')->get();
        // $seat_details = SeatPlan::where('user_id',$authID)->where('room_num', $room_details->id)->orderBy('id', 'asc')->get();
        $seat_info = SeatPlan::where('user_id',$authID)->where('room_num', $room_details->id)->orderBy('id', 'asc')->first();
        $room_num = RoomNo::where('id', $request->room_num)->first();
    
        // $unique_depart_ids = $seat_details->pluck('depart_id')->unique();
        $unique_ = $seat_details->pluck('starting_roll')->unique();
        $students_per_bench = $room_details->student_per_bench;
    
        $rows = [];
        for ($i = 0; $i < $room_details->total_row; $i++) {
            $row = [];
            for ($j = 0; $j < $room_details->total_bench_per_col; $j++) {
                $students = [];
                foreach ($unique_ as $depart) {
                    // $dept_seat_plan = ExamDrSeatSeating::where('room_num', $room_details->id)->where('exam_year',$request->exam_name)->where('exam_routin_id',$request->duty_date)->orderBy('id', 'asc')->get();
                    $dept_seat_plan = SeatPlan::where('room_num', $room_details->id)->where('starting_roll',$depart)->orderBy('id', 'asc')->get();
                    $students[] = $dept_seat_plan->pluck('roll')->toArray();
                }
                $row[] = [
                    'science' => $students[0][$i * $room_details->total_bench_per_col + $j] ?? null,
                    'arts' => $students[1][$i * $room_details->total_bench_per_col + $j] ?? null,
                    'commerce' => $students[2][$i * $room_details->total_bench_per_col + $j] ?? null,
                ];
            }
            $rows[] = $row;
        }
       
            return view('backend.exam_seatplan_show', compact('room_details','seat_details', 'seat_info', 'room_num','College_Seatdetails', 'rows','exam_info','exam_date'));
       
    }
    public function departExamSeatCard(Request $request)
    {
        try {
            $authID = Auth::id();
            $exam_info = ExamName::where('id', $request->exam_name)->first();
            $exam_date = ExamRoutine::where('id', $request->duty_date)->first();
            $room_details = RoomNo::where('id', $request->room_num)->first();
            $SeatCarddetails = SeatPlan::where('user_id', $authID)
                ->where('room_num', $room_details->id)
                ->where('exam_id', $request->exam_name)
                ->where('exam_routin_id', $request->duty_date)
                ->orderBy('depart_id', 'asc')
                ->get();
        
            return view('backend.exam_seatcard_show', compact('room_details', 'SeatCarddetails', 'exam_info', 'exam_date'));
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Seat Plan Not Exist!!!');
        }
    }
    // public function showSeatPlan($room_num){

    //      $room_details = RoomNo::where('id',$room_num)->first();
    //     $seat_details = SeatPlan::where('room_num',$room_details->id)->orderBy('id', 'asc')->get();
    //     //create-data
    //     $seat_info = SeatPlan::where('room_num',$room_details->id)->orderBy('id', 'asc')->first();
    //     $room_num = RoomNo::where('id',$room_num)->first();
    
    //     $unique_depart_ids = $seat_details->pluck('depart_id')->unique();
    //     foreach ($unique_depart_ids as $depart) {
    //         if ($depart == 1) {
    //             $dept1 = $depart;
    //         } elseif ($depart == 2) {
    //             $dept2 = $depart;
    //         } elseif ($depart == 3) {
    //             $dept3 = $depart;
    //         }
    //     }


    //     if ($room_details->student_per_bench == 1) {
    //         $dept_1 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept1)->orderBy('id', 'asc')->get();
    //         $scienceStudents = $dept_1->pluck('roll')->toArray();
    //     } elseif ($room_details->student_per_bench == 2) {
    //         $dept_1 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept1)->orderBy('id', 'asc')->get();
    //         $dept_2 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept2)->orderBy('id', 'asc')->get();
    //         $scienceStudents = $dept_1->pluck('roll')->toArray();
    //         $artsStudents = $dept_2->pluck('roll')->toArray();
    //     } elseif ($room_details->student_per_bench == 3) {
    //         $dept_1 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept1)->orderBy('id', 'asc')->get();
    //         $dept_2 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept2)->orderBy('id', 'asc')->get();
    //         $dept_3 = SeatPlan::where('room_num',$room_details->id)->where('depart_id', $dept3)->orderBy('id', 'asc')->get();
    //         $scienceStudents = $dept_1->pluck('roll')->toArray();
    //         $artsStudents = $dept_2->pluck('roll')->toArray();
    //         $commerceStudents = $dept_3->pluck('roll')->toArray();
    //     }
     
    //     $rows = [];
    //     if ($room_details->student_per_bench == 1) {
    //         for ($i = 0; $i < $room_details->total_row; $i++) {
    //             $row = [];
    //             for ($j = 0; $j < $room_details->total_bench_per_col; $j++) {
    //                 $row[] = [
    //                     'science' => $scienceStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                 ];
    //             }
    //             $rows[] = $row;
    //         }
    //     } elseif ($room_details->student_per_bench == 2) {
    //         for ($i = 0; $i < $room_details->total_row; $i++) {
    //             $row = [];
    //             for ($j = 0; $j < $room_details->total_bench_per_col; $j++) {
    //                 $row[] = [
    //                     'science' => $scienceStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                     'arts' => $artsStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                 ];
    //             }
    //             $rows[] = $row;
    //         }
    //     } elseif ($room_details->student_per_bench == 3) {
    //         for ($i = 0; $i < $room_details->total_row; $i++) {
    //             $row = [];
    //             for ($j = 0; $j < $room_details->total_bench_per_col; $j++) {
    //                 $row[] = [
    //                     'science' => $scienceStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                     'arts' => $artsStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                     'commerce' => $commerceStudents[$i*$room_details->total_bench_per_col + $j] ?? null,
    //                 ];
    //             }
    //             $rows[] = $row;
    //         }
    //     }
       
    //     return view('backend.exam_seat_plan_show', compact('room_details','seat_details','seat_info','room_num','rows'));
    // }
    /////////////simplify code /////////////////////////////
    public function showSeatPlan($room_num)
{
    $room_details = RoomNo::where('id', $room_num)->first();
    $seat_details = SeatPlan::where('room_num', $room_details->id)->orderBy('id', 'asc')->get();
    $seat_info = SeatPlan::where('room_num', $room_details->id)->orderBy('id', 'asc')->first();
    $room_num = RoomNo::where('id', $room_num)->first();

    // $unique_depart_ids = $seat_details->pluck('depart_id')->unique();
    $unique_ = $seat_details->pluck('starting_roll')->unique();
    $students_per_bench = $room_details->student_per_bench;

    $rows = [];
    for ($i = 0; $i < $room_details->total_row; $i++) {
        $row = [];
        for ($j = 0; $j < $room_details->total_bench_per_col; $j++) {
            $students = [];
            foreach ($unique_ as $depart) {
                $dept_seat_plan = SeatPlan::where('room_num', $room_details->id)->where('starting_roll',$depart)->orderBy('id', 'asc')->get();
                $students[] = $dept_seat_plan->pluck('roll')->toArray();
            }
            $row[] = [
                'science' => $students[0][$i * $room_details->total_bench_per_col + $j] ?? null,
                'arts' => $students[1][$i * $room_details->total_bench_per_col + $j] ?? null,
                'commerce' => $students[2][$i * $room_details->total_bench_per_col + $j] ?? null,
            ];
        }
        $rows[] = $row;
    }
   
        return view('backend.exam_seat_plan_show', compact('room_details', 'seat_details', 'seat_info', 'room_num', 'rows'));
   
}

    public function store(Request $request)
    {
        // return($request->all());
        try {
        $authID = Auth::id();
        for ($i=$request->starting_roll; $i <= $request->ending_roll; $i++) { 
            $examsetup = SeatPlan::updateOrCreate(['id' => $request->id ],
            [
                'user_id' => $authID,
                'exam_routin_id' => $request->duty_date,
                'exam_id' => $request->exam_id,
                'room_num' => $request->room_num,
                'depart_id' => $request->depart_id,
                'session' => $request->session,
                'class_id' => $request->class_id,
                'type' => $request->perBench,
                'total_row' => $request->total_row,
                'roll' => $i,
                'starting_roll' => $request->starting_roll,
                'rending_rolloll' => $request->ending_roll,
            ]);
        }

            if (!is_null($request->starting_roll2) && !is_null($request->ending_roll2)) {
                for ($j = $request->starting_roll2; $j <= $request->ending_roll2; $j++) {
                    $examsetup = SeatPlan::updateOrCreate(['id' => $request->id],
                        [
                            'user_id' => $authID,
                            'exam_routin_id' => $request->duty_date,
                            'exam_id' => $request->exam_id,
                            'room_num' => $request->room_num,
                            'depart_id' => $request->depart_id2,
                            'session' => $request->session2,
                            'class_id' => $request->class_id2,
                            'type' => $request->perBench,
                            'total_row' => $request->total_row,
                            'roll' => $j,
                            'starting_roll' => $request->starting_roll2,
                            'rending_rolloll' => $request->ending_roll2,
                        ]);
                }
            }
       
                if (!is_null($request->starting_roll3) && !is_null($request->ending_roll3)) {
                    for ($k=$request->starting_roll3; $k <= $request->ending_roll3; $k++) { 
                        $examsetup = SeatPlan::updateOrCreate(['id' => $request->id ],
                        [
                            'user_id' => $authID,
                            'exam_routin_id' => $request->duty_date,
                            'exam_id' => $request->exam_id,
                            'room_num' => $request->room_num,
                            'depart_id' => $request->depart_id3,
                            'class_id' => $request->class_id3,
                            'session' => $request->session3,
                            'type' => $request->perBench,
                            'total_row' => $request->total_row,
                            'roll' => $k,
                            'starting_roll' => $request->starting_roll3,
                            'rending_rolloll' => $request->ending_roll3,
                        ]);
                    }

                }
           
        if($request->id!=0){
            return redirect('exam_seatplan')->with('message', 'Updated successfully!!!');

        }else{
                return redirect('exam_seatplan')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('exam_seatplan')->with('error', 'The form was not filled up completely!!!');

    }
    
}
   
    
    public function edit( $id)
    {
        $data = SeatPlan::find($id);
        return response()->json($data);
    }

    
 
   
    public function destroy($id)
    {
        SeatPlan::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   

    public function departExamSeatPlanDelete(Request $request)
    {
        SeatPlan::where('exam_id', $request->exam_name)
        ->where('room_num', $request->room_num)
        ->where('exam_routin_id', $request->duty_date)
        ->delete();

        return redirect('exam_seatplan')->with('message', 'Deleted successfully!!!');
    }
    public function departId($id)
    {

        $class_info = [];
    $degreeClass = [];

    if ($id == 40) {
        $degreeClass = DegreeClass::orderBy('id', 'asc')->get();
    } else {
        $class_info = StudenClass::orderBy('id', 'asc')->get();
    }

    return response()->json([
        'class_info' => $class_info,
        'degreeClass' => $degreeClass,
    ]);

    }

    public function examRoutinData(Request $request)
    {
        $Examroutine = DB::table('exam_routines')->where('exam_id',$request->id)->orderBy('date','asc')->get();
         return json_encode($Examroutine);
    }
    public function classId($id, $depart_id)
    {
        $sessions = [];
        $degreeSession = [];
    
        if ($depart_id == 40) {
            switch ($id) {
                case 1:
                    $degreeSession = DB::table('degree_first_year_students')
                        ->select('session','studentclass')
                        ->where('studentclass', $id)
                        ->orderBy('session', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 2:
                    $degreeSession = DB::table('degree_secound_year_students')
                        ->select('session_year','class_id')
                        ->where('class_id', $id)
                        ->orderBy('session_year', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 3:
                    $degreeSession = DB::table('degree_third_year_students')
                        ->select('session_year','class_id')
                        ->where('class_id', $id)
                        ->orderBy('session_year', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                default:
                    break;
            }
        
        }else{
            switch ($id) {
                case 1:
                    $sessions = DB::table('students')
                        ->select('session','studentclass')
                        ->where('studentclass', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 2:
                    $sessions = DB::table('student_honours_secound_years')
                        ->select('session_year','class_id')
                        ->where('class_id', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session_year', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 3:
                    $sessions = DB::table('student_honours_third_years')
                        ->select('session_year','class_id')
                        ->where('class_id', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session_year', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 4:
                    $sessions = DB::table('student_honours_fourth_years')
                        ->select('session_year','class_id')
                        ->where('class_id', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session_year', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 5:
                    $sessions = DB::table('student_preliminary_to_masters')
                        ->select('session','studentclass')
                        ->where('studentclass', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                case 6:
                    $sessions = DB::table('student_masters_finals')
                        ->select('session','studentclass')
                        ->where('studentclass', $id)
                        ->where('depart_id', $depart_id)
                        ->orderBy('session', 'desc')
                        ->distinct()
                        ->limit(10)
                        ->get();
                    break;
                default:
                    break;
            }
        }
       
        return response()->json([
            'sessions' => $sessions,
            'degreeSession' => $degreeSession,
        ]);
    }
    public function sessionData(Request $request)
    {
        $userid         = $request->userid;
        $depart_id         = $request->depart_id;
        $data = explode('/', $userid);  
        $class_id = $data[0]; 
        $class_year = $data[1]; 
     $student = [];
     $degreeStudent = [];
     if ($depart_id == 40) {
        switch ($class_id) {
            case 1:
                $degreeStudent = DB::table('degree_first_year_students')
                    ->select('register_roll As roll','name')
                    ->where('studentclass', $class_id)
                    ->where('session', $class_year)
                    ->orderBy('session', 'desc')
                    ->get();
                break;
            case 2:
                $degreeStudent = DB::table('degree_secound_year_students')
                    ->where('class_id', $class_id)
                    ->where('session_year', $class_year)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            case 3:
                $degreeStudent = DB::table('degree_third_year_students')
                    ->where('class_id', $class_id)
                    ->where('session_year', $class_year)
                    ->orderBy('session_year', 'desc')
                    ->get();
                break;
            default:
                break;
        }
      
     }else{

        switch ($class_id) {
            case 1:
                $student = DB::table('students')
                    ->select('register_roll As roll','name')
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
     }
    return response()->json([
        'student' => $student,
        'degreeStudent' => $degreeStudent,
    ]);
    }
  
}
