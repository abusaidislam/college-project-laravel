<?php

namespace App\Http\Controllers;
use App\Models\ExamMasterDutyRoster;
use App\Models\CourseName;
use App\Models\ExamName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
class ExamMasterDutyRosterEditableController extends Controller
{
    public function ExamMasterEditData( $title )
    {  
        // return$title;
        $authID = Auth::id();
        $examInfo = ExamName::where('user_id',$authID)->where('title',$title)->first();
        $exam_id = ExamName::where('user_id',$authID)->where('title',$title)->first();
        $dataa = ExamMasterDutyRoster::where('exam_id',$exam_id->id)->where('user_id',$authID)->orderBy('id', 'asc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        return view('backend.exam_master_duty_roster_editabel', compact('dataa','authID','examInfo','course_name','examname'));
    }
    function ExamMasterEditDataAction(Request $request)
 
    {
        $datesArray = json_encode($request->attendance);
        ExamMasterDutyRoster::updateOrCreate([
            'id' => $request->rowid ],
        [
            'duty_date' => $datesArray,        
        ]);
        
        return response()->json(['message' => 'Data saved successfully.']);
  }
 
  public function masterDutyRosterExportToPDF(Request $request)
  {
     $exam_id = $request->exam_id;
     $authID = Auth::id();
     $examInfo = ExamName::where('user_id',$authID)->where('id',$exam_id)->first();
     $data = ExamMasterDutyRoster::where('exam_id', $exam_id)->get();
      if ($data->isEmpty()) {
          return view('backend.show_incourse_error');
      }
      $pdf = PDF::loadView('backend.exam_master_pdf', ['data' => $data, 'examInfo' => $examInfo, 'authID' => $authID]);
      $pdf->setPaper('landscape');
      return $pdf->stream('document.pdf');
  }
}
