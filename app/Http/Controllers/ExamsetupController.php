<?php

namespace App\Http\Controllers;
use App\Models\ExamName;
use App\Models\Examsetup;
use App\Models\Department;
use App\Models\Teacher;
use App\Models\RoomNo;
use App\Models\BuldingName;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
class ExamsetupController extends Controller
{
     public function index()
    {  
        $authID = Auth::id();
        $examname = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $department = Department::orderBy('id', 'asc')->get();
        $genarelDepart = User::where('id', 17)->first();
        $teacher = Teacher::orderBy('id', 'asc')->get();
        $buldingname = BuldingName::orderBy('id', 'asc')->get();
        $roomno = RoomNo::orderBy('id', 'asc')->get();
        $data = Examsetup::where('user_id',$authID)->orderBy('id', 'desc')->get();
       return view('backend.exam_setups', compact('data','examname','department','roomno','teacher','buldingname','authID','genarelDepart'));
        
    }

    public function store(Request $request)
    {
      $authID = Auth::id();
      Examsetup::updateOrCreate([
              'id' => $request->id ],
          [
            'user_id' => $authID,
            'exam_name' => $request->exam_name,
            'duty_date' => $request->duty_date,
            'department' => $request->department,
            'teacher' => $request->teacher,
            'designation' => $request->designation,
            'bulding' => $request->buldingname,
             
          ]);
          if($request->id!=0){
              return redirect('exam_setupplan')->with('message', 'Updated successfully!!!');
  
          }
      else{
          return redirect('exam_setupplan')->with('message', 'Inserted successfully!!!');
      }
      }
    
    public function edit( $id)
    {
        $teacher = Teacher::orderBy('id', 'asc')->get();
        $data = Examsetup::find($id);
        return response()->json($data);
    }

    
   public function teachersearch( $id)
    {   
        $data =  DB::table('teachers')
                    ->where('depart_id', '=', $id)->get();
return  $data ;
  // return response()->json($data);
    }
   
    public function destroy($id)
    {
        Examsetup::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }

 public function ExamInformation(Request $request)
    {
         $authID = Auth::id();
         $userType = DB::table('users')
                        ->where('id', $authID)
                        ->first();
         if($userType->usertype == 7){
             $Examroutine = DB::table('exam_routines')->where('exam_id',$request->exam_id)->orderBy('date','asc')->get();
             return json_encode($Examroutine);
         }else{
             $Examroutine = DB::table('exam_dr_routines')->where('exam_id',$request->exam_id)->orderBy('date','asc')->get();
             return json_encode($Examroutine);
         }
    }
 public function DepartInformation(Request $request)
    {
        if ($request->depart_id==40) {
        $data = DB::table('degree_teachers')->orderBy('bcs_batch','asc')->get();
        }else{
         $data = DB::table('teachers')->where('depart_id',$request->depart_id)->orderBy('bcs_batch','asc')->get();
        }
         return json_encode($data);
    }

public function examSetupExportToPDF(Request $request)
    {
        $authID = Auth::id();
        $userType = DB::table('users')
                       ->where('id', $authID)
                       ->first();
      $building = Examsetup::select('bulding','duty_date')->where('exam_name', $request->exam_name)->where('duty_date', $request->duty_date)->distinct()->get();
    
       $data = Examsetup::where('exam_name', $request->exam_name)->where('duty_date',$request->duty_date)->get();
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        $pdf = PDF::loadView('backend.exam_setup_duty_pdf', ['data' => $data,'building' => $building,'userType' => $userType]);
        return $pdf->stream('document.pdf');
    }

 public function fetchCity(Request $request)
    {
        $data['cities'] = Teacher::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
   
  

}
