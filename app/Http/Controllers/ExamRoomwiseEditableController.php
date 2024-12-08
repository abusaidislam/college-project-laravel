<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExamName;
use App\Models\ExamSeatcard;
use App\Models\CourseName;
use App\Models\DutyRoaster;
use App\Models\ExamRoutine;
use App\Models\Teacher;
use App\Models\Examsetup;
use App\Models\BuldingName;
use App\Models\ExamMasterDutyRoster;
use App\Models\ExamRoomwiseMasterDuty;
use App\Models\ExamRoomwiseMasterDutyRoster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class ExamRoomwiseEditableController extends Controller
{

    public function ExamRoomwiseEditData( $title )
    {  
        $authID = Auth::id();
        $examInfo = ExamName::where('user_id',$authID)->where('title',$title)->first();
        $exam_id = ExamName::where('user_id',$authID)->where('title',$title)->first();
        $dataa = ExamMasterDutyRoster::where('exam_id',$exam_id->id)->where('user_id',$authID)->orderBy('id', 'asc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        return view('backend.exam_roomwise_editable', compact('dataa','examInfo','authID','course_name','examname'));
    }
    
    function ExamRoomWiseEditDataAction(Request $request)
    {
        $ExamMasterData = ExamMasterDutyRoster::where('id', $request->rowid)->first();

$datesArray = $request->attendance;
// Filter out keys with the value of "0"
$filteredDatesArray = array_filter($datesArray, function ($value) {
    return $value !== "0";
});

$datesArray = json_encode($filteredDatesArray);

// Check if the record exists
$existingRecord = ExamRoomwiseMasterDuty::find($request->rowid);

        // If the record exists, update it
        if ($existingRecord) {
        ExamRoomwiseMasterDuty::updateOrCreate(
            ['teacher_masterduty_id' => $request->rowid],
            [
                'teacher_masterduty_id' => $request->rowid,
                // 'user_id' => $ExamMasterData->user_id,
                // 'exam_id' => $ExamMasterData->exam_id,
                // 'duty_date' => $ExamMasterData->duty_date,
                'room_number' => $datesArray,
            ]
        );
        }else{
            ExamRoomwiseMasterDuty::updateOrCreate(
                ['teacher_masterduty_id' => $request->rowid],
                [
                    'teacher_masterduty_id' => $request->rowid,
                    'user_id' => $ExamMasterData->user_id,
                    'exam_id' => $ExamMasterData->exam_id,
                    'duty_date' => $ExamMasterData->duty_date,
                    'room_number' => $datesArray,
                ]
            );
        }
        return response()->json(['message' => 'Data saved successfully.']);
    }
    public function examRoomWiseExportToPDF(Request $request)
    {
        // $building = ExamRoomwiseMasterDutyRoster::select('building_id','duty_date')->where('exam_id', $request->exam_name)->where('duty_date', $request->duty_date)->distinct()->get();
        $building = ExamRoomwiseMasterDutyRoster::select('building_id','duty_date')->where('exam_id', $request->exam_name)->where('duty_date', $request->duty_date)->distinct()->get();
    
        $data = ExamRoomwiseMasterDutyRoster::where('exam_id', $request->exam_name)->where('duty_date',$request->duty_date)->get();
         if ($data->isEmpty()) {
             return view('backend.show_incourse_error');
         }
         $pdf = PDF::loadView('backend.exam_roomwise_pdf', ['data' => $data,'building' => $building]);
         return $pdf->stream('document.pdf');

    }
    // public function examRoomWiseExportToPDF(Request $request)
    // {
    //     $building = Examsetup::select('bulding','duty_date')->where('exam_name', $request->exam_name)->where('duty_date', $request->duty_date)->distinct()->get();
    //     $buildingData = BuldingName::orderBy('building_name','asc')->get();
    //     $ExamDate = ExamRoutine::where('id',$request->duty_date)->first();
    //     $ExamName = ExamName::where('id',$request->exam_name)->first();
    //     $data = ExamRoomwiseMasterDuty::where('exam_id', $request->exam_name)->get();
    //     if ($data->isEmpty()) {
    //         return view('backend.show_incourse_error');
    //     }
    //     $pdf = PDF::loadView('backend.exam_roomwise_pdf', ['data' => $data,'buildingData' => $buildingData,'ExamDate'=>$ExamDate,'ExamName'=>$ExamName]);
    //     $pdf->setPaper('landscape');
    //     return $pdf->stream('document.pdf');
    // }
}
