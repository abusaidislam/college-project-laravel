<?php

namespace App\Http\Controllers;
use App\Models\SeatPlan;
use App\Models\ExamName;
use App\Models\DrExamSeatplan;
use App\Models\ExamDrRoutine;
use App\Models\RoomNo;
use App\Models\DRAnalysis;
use App\Models\ExamDrSeatSeating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class DrExamSeatplanController extends Controller
{
 
    public function index()
    {  
       $authID = Auth::id();
       $seatplandata = ExamDrSeatSeating::where('user_id',$authID)->orderBy('id', 'desc')->get();
       $drexamyear = DRAnalysis::select('examname_year')->distinct()->get();
       $data = RoomNo::orderBy('id', 'asc')->get();     
       $room_details = RoomNo::where('id',6)->first();
       $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
       return view('backend.dr_exam_seatplan', compact('data','drexamyear','examname','room_details','seatplandata'));
        
    }
    
    public function examSeatCard(Request $request)
{
    try {
        $authID = Auth::id();
        $exam_info = ExamName::where('id', $request->exam_name)->first();
        $exam_date = ExamDrRoutine::where('id', $request->duty_date)->first();
        $room_details = RoomNo::where('id', $request->room_num)->first();
        $SeatCarddetails = ExamDrSeatSeating::where('user_id', $authID)
            ->where('room_num', $room_details->id)
            ->where('exam_year', $request->exam_name)
            ->where('exam_routin_id', $request->duty_date)
            ->orderBy('collegee_name', 'asc')
            ->get();
    
        return view('backend.dr_exam_seat_card_show', compact('room_details', 'SeatCarddetails', 'exam_info', 'exam_date'));
    } catch (\Exception $e) {
        return redirect()->back()->with('massage', 'Seat Plan Not Exist!!!');
    }
}
 
    public function examShowSeatPlan(Request $request)
{
    
    // return($request);
    $authID = Auth::id();
    $exam_info = ExamName::where('id', $request->exam_name)->first();
    $exam_date = ExamDrRoutine::where('id', $request->duty_date)->first();
    $room_details = RoomNo::where('id', $request->room_num)->first();
    $College_Seatdetails = ExamDrSeatSeating::select('collegee_name','exam_year','exam_routin_id')->where('user_id',$authID)->where('room_num', $room_details->id)->where('exam_year',$request->exam_name)->where('exam_routin_id',$request->duty_date)->orderBy('collegee_name', 'asc')->distinct()->get();
    
    $seat_details = ExamDrSeatSeating::where('user_id',$authID)->where('room_num', $room_details->id)->where('exam_year',$request->exam_name)->where('exam_routin_id',$request->duty_date)->orderBy('id', 'asc')->get();
    $seat_info = ExamDrSeatSeating::where('user_id',$authID)->where('room_num', $room_details->id)->orderBy('id', 'asc')->first();
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
                $dept_seat_plan = ExamDrSeatSeating::where('room_num', $room_details->id)->where('starting_roll',$depart)->orderBy('id', 'asc')->get();
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
   
        return view('backend.dr_exam_seatplan_show', compact('room_details', 'College_Seatdetails','seat_details', 'seat_info', 'room_num', 'rows','exam_info','exam_date'));
   
}

    public function store(Request $request)
    {
        // return($request->all());
        
        $authID = Auth::id();
        for ($i=$request->starting_roll; $i <= $request->ending_roll; $i++) { 
            $examsetup = ExamDrSeatSeating::updateOrCreate(['id' => $request->id ],
            [
                'user_id' => $authID,
                'exam_routin_id' => $request->duty_date,
                'room_num' => $request->room_num,
                'exam_year' => $request->exam_id,
                'collegee_name' => $request->college_name,
                'subject_name' => $request->subject_name,
                'student_type' => $request->type,
                'type' => $request->perBench,
                'total_row' => $request->total_row,
                'roll' => $i,
                'starting_roll' => $request->starting_roll,
                'rending_rolloll' => $request->ending_roll,
            ]);
        }
       
            if (!is_null($request->starting_roll2) && !is_null($request->ending_roll2)) {
                for ($j = $request->starting_roll2; $j <= $request->ending_roll2; $j++) {
                    $examsetup = ExamDrSeatSeating::updateOrCreate(['id' => $request->id],
                        [
                            'user_id' => $authID,
                            'exam_routin_id' => $request->duty_date,
                            'room_num' => $request->room_num,
                            'exam_year' => $request->exam_id,
                            'collegee_name' => $request->college_name2,
                            'subject_name' => $request->subject_name2,
                            'student_type' => $request->type2,
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
                        $examsetup = ExamDrSeatSeating::updateOrCreate(['id' => $request->id ],
                        [
                            'user_id' => $authID,
                            'exam_routin_id' => $request->duty_date,
                            'room_num' => $request->room_num,
                            'exam_year' => $request->exam_id,
                            'collegee_name' => $request->college_name2,
                            'subject_name' => $request->subject_name2,
                            'student_type' => $request->type3,
                            'type' => $request->perBench,
                            'total_row' => $request->total_row,
                            'roll' => $k,
                            'starting_roll' => $request->starting_roll3,
                            'rending_rolloll' => $request->ending_roll3,
                        ]);
                    }

                }
           
        if($request->id!=0){
            return redirect('drexamseatplan')->with('message', 'Updated successfully!!!');

        }else{
                return redirect('drexamseatplan')->with('message', 'Inserted successfully!!!');
        }
    
    
}
   
    
    public function edit( $id)
    {
        $data = ExamDrSeatSeating::find($id);
        return response()->json($data);
    }

    
 
   
    public function destroy($id)
    {
        SeatPlan::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
    public function drExamInfo($examdate_id, $examinfo)
    {
        
        // $drCourseCodeInfo = ExamDrRoutine::select('course_code')->where('id',$examdate_id)->orderBy('id', 'asc')->first();
        $drInfo = DRAnalysis::select('collegecode_name')
        ->where('examname_year', $examinfo)
        ->orderBy('collegecode_name', 'asc')
        ->groupBy('collegecode_name')
        ->get();
        return response()->json($drInfo);

    }
    public function drSubject($subject)
    {
        $typeinfo = DRAnalysis::select('type')->where('subjectcode_name', $subject)
            ->orderBy('type', 'asc')
            ->distinct()
            ->get();
    
        return response()->json($typeinfo);
    }
   
    
    public function drCollegeInfo($college_name)
    {
        
        $drsubjectInfo = DRAnalysis::select('subjectcode_name')->where('collegecode_name',$college_name)->orderBy('subjectcode_name', 'asc')->distinct()->get();
        return response()->json($drsubjectInfo);
        
    }
   
    public function drSubjectInfo($subject_name, $collegeName, $type)
    {
        $drsubjec = ExamDrSeatSeating::where('subject_name', $subject_name)->where('collegee_name', $collegeName)->orderBy('roll', 'asc')->get();
        $countdata = $drsubjec->count();
    
        $drpaperInfodata = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
        $drcoundData = $drpaperInfodata->count();
    
        $total = $drcoundData - $countdata;
    
        $drpaperInfo = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
    
        return response()->json([
            'countdata' => $countdata,
            'drcoundData' => $drcoundData,
            'total' => $total,
            'drpaperInfo' => $drpaperInfo,
        ]);
    }
   
    public function drExamInfoSecound($examdate_id ,$examinfo)
    {
        
        $drInfosecound = DRAnalysis::select('collegecode_name')->where('examname_year', $examinfo)->orderBy('collegecode_name', 'asc')->groupBy('collegecode_name')->get();
        return response()->json($drInfosecound);

    }
    public function drSubjectSecound($subject)
    {
        $typeinfoSecound = DRAnalysis::select('type')->where('subjectcode_name', $subject)->orderBy('type', 'asc')->distinct()->get();
    
        return response()->json($typeinfoSecound);
    }
    public function drCollegeInfoSecound($college_name)
    {
        
        $drsubjectInfoSecound = DRAnalysis::select('subjectcode_name')->where('collegecode_name',$college_name)->orderBy('subjectcode_name', 'asc')->distinct()->get();
        return response()->json($drsubjectInfoSecound);

    }

    public function drSubjectInfoSecound($subject_name, $collegeName, $type)
    {
        $drsubjec = ExamDrSeatSeating::where('subject_name', $subject_name)
            ->where('collegee_name', $collegeName)
            ->orderBy('roll', 'asc')
            ->get();
        $countdata = $drsubjec->count();
    
        $drpaperInfodata = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
        $drcoundData = $drpaperInfodata->count();
    
        $total = $drcoundData - $countdata;
    
        $drpaperInfo = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
    
        return response()->json([
            'countdata' => $countdata,
            'drcoundData' => $drcoundData,
            'total' => $total,
            'drpaperInfo' => $drpaperInfo,
        ]);
    }
    
    public function drExamInfoThird($examdate_id, $examinfo)
    {
        
        $drInfothird = DRAnalysis::select('collegecode_name')->where('examname_year', $examinfo)->orderBy('collegecode_name', 'asc')->groupBy('collegecode_name')->get();
        return response()->json($drInfothird);

    }
    public function drSubjectThird($subject)
    {
        $typeinfoThird = DRAnalysis::select('type')->where('subjectcode_name', $subject)->orderBy('type', 'asc')->distinct()->get();
    
        return response()->json($typeinfoThird);
    }
    public function drCollegeInfoThird($college_name)
    {
        $drsubjectInfoThird = DRAnalysis::select('subjectcode_name')->where('collegecode_name',$college_name)->orderBy('subjectcode_name', 'asc')->distinct()->get();
        return response()->json($drsubjectInfoThird);
    }

    public function drSubjectInfoThird($subject_name, $collegeName, $type)
    {
        $drsubjec = ExamDrSeatSeating::where('subject_name', $subject_name)
            ->where('collegee_name', $collegeName)
            ->orderBy('roll', 'asc')
            ->get();
        $countdata = $drsubjec->count();
    
        $drpaperInfodata = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
        $drcoundData = $drpaperInfodata->count();
    
        $total = $drcoundData - $countdata;
    
        $drpaperInfo = DRAnalysis::where('subjectcode_name', $subject_name)
            ->where('collegecode_name', $collegeName)
            ->where('type', $type)
            ->orderBy('exam_roll', 'asc')
            ->get();
    
        return response()->json([
            'countdata' => $countdata,
            'drcoundData' => $drcoundData,
            'total' => $total,
            'drpaperInfo' => $drpaperInfo,
        ]);
    }


    public function drExamRoutinData($id)
    {
        $Examroutine = DB::table('exam_dr_routines')->where('exam_id',$id)->orderBy('id','asc')->get();
         return json_encode($Examroutine);
    }
   
    public function examSeatPlanDelete(Request $request)
    {
    ExamDrSeatSeating::where('exam_year', $request->exam_name)
            ->where('room_num', $request->room_num)
            ->where('exam_routin_id', $request->duty_date)
            ->delete();

            return redirect('drexamseatplan')->with('message', 'Deleted successfully!!!');

    }
   
   
}


