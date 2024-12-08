<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamName;
use App\Models\ExamSeatcard;
use App\Models\CourseName;
use App\Models\DutyRoaster;
use App\Models\ExamDrRoutine;
use App\Models\ExamMasterDutyRoster;
use App\Models\ExamRoutine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use PDF;
class ExamDutyRoasterController extends Controller
{
    
    public function index()
    {
        $authID = Auth::id();
        $examDate   = ExamDrRoutine::where('user_id',$authID)->orderby('id','asc')->get();
        $dataa = DutyRoaster::orderBy('id', 'desc')->get();
        $data = ExamMasterDutyRoster::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $course_name = CourseName::orderBy('id', 'asc')->get();
        return view('backend.duty_roaster', compact('data','examname','course_name','authID'));
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
       
        DutyRoaster::updateOrCreate([
              'id' => $request->id ],
          [
              'exam_name' => $request->exam_name,
              'name' => $request->name,
              'designation' => $request->designation,
              'department' => $request->department,
              'email' => $request->email,
              'duty_date' => $request->duty_date,
              'duty_time' => $request->duty_time,
              
          ]);
          if($request->id!=0){
              return redirect('examdutyroaster')->with('message', 'Updated successfully!!!');
  
          }
      else{
          return redirect('examdutyroaster')->with('message', 'Inserted successfully!!!');
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
        $data = DutyRoaster::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        DutyRoaster::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }

    public function DutyRosterExportToPDF(Request $request)
    {
       $first_time = Carbon::createFromFormat('H:i', $request->first_time)->format('h:i A');
       $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A');
       $exam_id = $request->exam_id;
       $data = ExamMasterDutyRoster::where('exam_id', $exam_id)->get();
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        $pdf = PDF::loadView('backend.exam_duty_roster_pdf', ['data' => $data,'first_time' => $first_time,'end_time' => $end_time]);
        $pdf->setPaper('landscape');
        return $pdf->stream('document.pdf');
    }

    public function dutyExaminfo($id)
    {
        $authID = Auth::id();
        $examdrDate   = ExamDrRoutine::where('user_id',$authID)->where('exam_id',$id)->orderby('id','asc')->get();
        $examDate   = ExamRoutine::where('user_id',$authID)->where('exam_id',$id)->orderby('id','asc')->get();
        return response()->json([
            'examdrDate' => $examdrDate,
            'examDate' => $examDate,
        ]);
    }
    
    public function dutyRoasterSmsSend(Request $request)
    {
        try {
            $authID = Auth::id();
            $examid = $request->examid;
            $duty_date = $request->duty_date;
            $duty_time = Carbon::createFromFormat('H:i', $request->duty_time)->format('h:i A');
            $examname = ExamName::where('user_id', $authID)->where('id', $examid)->orderBy('id', 'desc')->first();
            $DutyRoasterinfo = ExamMasterDutyRoster::where('user_id', $authID)
                ->where('exam_id', $examid)
                ->where('duty_date', 'like', '%"'.$duty_date.'"%')
                ->orderBy('id', 'asc')
                ->get();
    
            foreach ($DutyRoasterinfo as $data) {
                $mobiledata = $data->mobile;
    
                $url = "https://bulksmsbd.net/api/smsapi";
                $api_key = "CXmOEkgE7RC5tFVCPCW1";
                $senderid = "8809617615439";
                $to_number = $mobiledata;
                $message =  "Dear {$data->name}. Your Exam Duty for {$examname->title} is scheduled at {$duty_time} on {$duty_date}. Thanks for your cooperation.";
    
                $data = [
                    "api_key" => $api_key,
                    "senderid" => $senderid,
                    "number" => $to_number,
                    "message" => $message,
                ];
    
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
            }
    
            return redirect('examdutyroaster')->with('message', 'SMS sent successfully!!!');
        } catch (\Exception $e) {
            return redirect('examdutyroaster')->with('error', 'Failed to sent SMS. Please try again.');
        }
    }
    
    
    public function dutyRoasterAllSmsSend(Request $request)
    {
        try {
        $authID = Auth::id();
        $examId = $request->examId;
        $duty_time = Carbon::createFromFormat('H:i', $request->duty_time)->format('h:i A');
        $examname = ExamName::where('user_id',$authID)->where('id',$examId)->orderBy('id', 'desc')->first();
        $DutyRoasterinfo = ExamMasterDutyRoster::where('user_id', $authID)
            ->where('exam_id', $examId)
            ->orderby('id', 'asc')
            ->get();

        foreach ($DutyRoasterinfo as $data) {
            $mobiledata = $data->mobile;
            $decodedData = json_decode($data->duty_date, true);
            $dateKeys = array_keys($decodedData);
            $dateString = implode(', ', $dateKeys);

               $url = "https://bulksmsbd.net/api/smsapi";
               $api_key = "CXmOEkgE7RC5tFVCPCW1";
               $senderid = "8809617615439";
               $to_number = $mobiledata;   
               $message =  "Dear {$data->name}. Your Exam Duty for {$examname->title} is scheduled at {$duty_time} on {$dateString}. Thanks for your cooperation.";
           
               $data = [
                   "api_key" => $api_key,
                   "senderid" => $senderid,
                   "number" => $to_number,
                   "message" => $message,
               ];
           
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               $response = curl_exec($ch);
               curl_close($ch);
        }
    
        return redirect('examdutyroaster')->with('message', 'SMS sent successfully!!!');
    } catch (\Exception $e) {
        return redirect('examdutyroaster')->with('error', 'Failed to sent SMS. Please try again.');
    }
    }
    
    public function sms_send(Request $request ,$userId)
    {
        try {
        $authID = Auth::id();
        $duty_time = Carbon::createFromFormat('H:i', $request->duty_time)->format('h:i A');
        $ndata = ExamMasterDutyRoster::find($userId);
        $examname = ExamName::where('user_id',$authID)->where('id',$ndata->exam_id)->orderBy('id', 'desc')->first();
        $decodedData = json_decode($ndata->duty_date, true);
        $dateKeys = array_keys($decodedData);
        $dateString = implode(', ', $dateKeys);
    
        $url = "https://bulksmsbd.net/api/smsapi";
        $api_key = "CXmOEkgE7RC5tFVCPCW1";
        $senderid = "8809617615439";
        $to_number = $ndata->mobile;   
        $message =  "Dear {$ndata->name}. Your Exam Duty for {$examname->title} is scheduled at {$duty_time} on {$dateString}. Thanks for your cooperation.";
    
        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $to_number,
            "message" => $message,
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
 
        return redirect('examdutyroaster')->with('message', 'SMS sent successfully!!!');
    } catch (\Exception $e) {
        return redirect('examdutyroaster')->with('error', 'Failed to sent SMS. Please try again.');
    }
}

}
