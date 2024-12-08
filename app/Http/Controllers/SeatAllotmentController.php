<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\HostelSeatAllotment;
use App\Models\HostelFloor;
use App\Models\HostelBulding;
use App\Models\HostelRoom;
use App\Models\HostelStudent;
use App\Models\Department;
use App\Models\User;
use App\Models\StudenClass;
use App\Models\DegreeClass;
use App\Models\Basic;
use App\Models\StudentReceiptNote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use PDF;
class SeatAllotmentController extends Controller
{
    public function index()
    {
        $hostel_id = Auth::id();         
        $data = HostelSeatAllotment::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        $department = Department::orderBy('id', 'asc')->get();
        $genarelDepart = User::where('id', 17)->first();
        $className = StudenClass::orderBy('id', 'asc')->get();
        $degreeclassName = DegreeClass::orderBy('name', 'asc')->get();
        $bulding = HostelBulding::where('hostel_id', '=',$hostel_id)->orderBy('bulding_name', 'asc')->get();
        $room = HostelRoom::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        return view('backend.hostel_seat_allotment', compact('data','bulding','department','room','className','degreeclassName','genarelDepart'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
            'payment_photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:400|dimensions:max_width=800,max_height=800',
        ]);
        try {
            $fileName = '';
            $fileName1 = '';
            $emp = HostelSeatAllotment::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('hostel_card/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('hostel_card/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo ?? "0";
            }
            if ($request->hasFile('photo') && $request->file('payment_photo')->isValid()) {
                $fileName1 = time() . '.' . $request->payment_photo->getClientOriginalExtension();
                $request->payment_photo->move(public_path('hostel_card/'), $fileName1);
            
                if ($request->id > 0) {
                    $imagePath = public_path('hostel_card/' . $emp->payment_photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName1 = $emp->payment_photo ?? "0";
            }
            
            $hostel_id = Auth::id(); 
            HostelSeatAllotment::updateOrCreate([
                'id' => $request->id
            ], [
                'department_id' => $request->department_id,
                'student_name' => $request->stu_name,
                'roll' => $request->roll,
                'session' => $request->session,
                'class' => $request->class,
                'registration' => $request->registration,
                'mobile_no' => $request->mobile_no,
                'bulding_id' => $request->bulding_id,
                'floor_id' => $request->floor_id,
                'room_id' => $request->room_id,
                'bed_id' => $request->bed_id,
                'payment_amount' => $request->payment_amount,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'hostel_id' => $hostel_id,
                'status' => $request->status,
                'photo' => $fileName,
                'payment_photo' => $fileName1,
            ]);
          
            if ($request->id != 0) {
                return redirect('seatallotment')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('seatallotment')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('seatallotment')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = HostelSeatAllotment::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = HostelSeatAllotment::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('hostel_card/' . $data->photo);
    $imagePath1 = public_path('hostel_card/' . $data->payment_photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }
    if (File::exists($imagePath1)) {
        unlink($imagePath1);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}



public function studentreceipt($id)
{  
    $basic = Basic::find(1); 
    $ndata = HostelSeatAllotment::find($id);
    $data = StudentReceiptNote::where('status', 0)->get();
    return view('backend.hostel_student_receipt', compact('basic','ndata','data' ));
}
public function hostelStudentList()
{    
    $hostel_id = Auth::id(); 
    $hostelStudent = HostelSeatAllotment::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();

    $pdf = PDF::loadView('backend.hostel_student_list_pdf', compact('hostelStudent'));
    
    $pdf->setPaper('A4', 'portrait');
    return $pdf->download('hostel_seat_allotment.pdf');
}
public function UpdateStatus(Request $request)
{
    try {
        $data = HostelSeatAllotment::findOrFail($request->id);
        $data->status = $request->status;
        $data->save();

        return response()->json(['message' => 'Status updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error updating status: ' . $e->getMessage()], 500);
    }
}

public function getRoomNumber(Request $request)
{
    $room = DB::table('hostel_rooms')->where('id', $request->room_id)->first();
    return response()->json(['room_number' => $room->room_number]);
}
public function getfloorName(Request $request)
{
    $floor = DB::table('hostel_floors')->where('id', $request->floor_id)->first();
    return response()->json(['floor_name' => $floor->floor_name]);
}


     public function HostelClassInfo($id,$depart_id)
     {
         if ($depart_id == 40) {
                
         $sessions = [];
     
         switch ($id) {
             case 1:
                 $sessions = DB::table('degree_first_year_students')
                     ->select('session','studentclass')
                     ->where('studentclass', $id)
                     ->orderBy('session', 'desc')
                     ->distinct()
                     ->get();
                 break;
             case 2:
                 $sessions = DB::table('degree_secound_year_students')
                     ->select('session_year','class_id')
                     ->where('class_id', $id)
                     ->orderBy('session_year', 'desc')
                     ->distinct()
                     ->get();
                 break;
             case 3:
                 $sessions = DB::table('degree_third_year_students')
                     ->select('session_year','class_id')
                     ->where('class_id', $id)
                     ->orderBy('session_year', 'desc')
                     ->distinct()
                     ->get();
                 break;
     
             default:
                 break;
         }
     
         return response()->json($sessions);
         } else {
                
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
      
     }
     
     
      public function HostelSessionInfo(Request $request){
             $userid         = $request->userid;
             $depart_id         = $request->depart_id;
             $data = explode('/', $userid);  
             $class_id = $data[0]; 
             $class_year = $data[1]; 
     if ($depart_id == 40) {
                 $student = [];
                 switch ($class_id) {
                     case 1:
                         $student = DB::table('degree_first_year_students')
                             ->where('studentclass', $class_id)
                             ->where('session', $class_year)
                             ->orderBy('session', 'desc')
                             ->get();
                         break;
                     case 2:
                         $student = DB::table('degree_secound_year_students')
                             ->where('class_id', $class_id)
                             ->where('session_year', $class_year)
                             ->orderBy('session_year', 'desc')
                             ->get();
                         break;
                     case 3:
                         $student = DB::table('degree_third_year_students')
                             ->where('class_id', $class_id)
                             ->where('session_year', $class_year)
                             ->orderBy('session_year', 'desc')
                             ->get();
                         break;
     
                     default:
                         break;
                 }
               
                 return json_encode($student);
     } else {
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
     
        
         
     }
      public function HostelStudentInfo(Request $request){
             $stu_id         = $request->stu_id;
             $depart_id         = $request->depart_id;
             $data = explode('/', $stu_id);  
             $class_id = $data[0]; 
             $stu_id = $data[1]; 
     if ($depart_id == 40) {
         $studentall = [];
         switch ($class_id) {
             case 1:
                 $studentall = DB::table('degree_first_year_students')
                     ->where('studentclass', $class_id)
                     ->where('id', $stu_id)
                     ->orderBy('session', 'desc')
                     ->get();
                 break;
             case 2:
                 $studentall = DB::table('degree_secound_year_students')
                     ->where('student_honours_secound_years.class_id', $class_id)
                     ->where('student_honours_secound_years.id', $stu_id)
                     ->join('students', 'student_honours_secound_years.registration_no', '=', 'students.registration_no')
                     ->select('student_honours_secound_years.*', 'students.mobile_no', 'students.blood_group')
                     ->orderBy('session_year', 'desc')
                     ->get();
                 break;
             case 3:
                 $studentall = DB::table('degree_third_year_students')
                     ->where('class_id', $class_id)
                     ->where('id', $stu_id)
                     ->orderBy('session_year', 'desc')
                     ->get();
                 break;
     
             default:
                 break;
         }
       
         return json_encode($studentall);
     } else {
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
     public function BulidingID($id)
    {
        $hostel_id = Auth::id();
        $floorInfo = DB::table('hostel_floors')
                        ->where('hostel_id', '=',$hostel_id)
                        ->where('bulding_id','=', $id)
                        ->orderBy('id', 'asc')
                        ->get();     
        return json_encode($floorInfo);
    }
     public function roomID($id)
    {
        $hostel_id = Auth::id();
        $roomInfo = DB::table('hostel_rooms')
                        ->where('hostel_id', '=',$hostel_id)
                        ->where('floor_id','=', $id)
                        ->orderBy('id', 'asc')
                        ->get();     
        return json_encode($roomInfo);
    }
    public function roomInfo($id)
    {
        $hostel_id = Auth::id();
        
        $seat_allotment = DB::table('hostel_seat_allotments')
            ->where('hostel_id', $hostel_id)
            ->where('room_id', $id)
            ->select('bed_id')
            ->orderBy('id', 'asc')
            ->count();
    
        if (($hostel_id == 15 && $seat_allotment  <2) || ($hostel_id != 15 && $seat_allotment === 0)) {
            $seatInfo = DB::table('hostel_rooms')
                ->where('hostel_id', $hostel_id)
                ->where('id', $id)
                ->orderBy('id', 'asc')
                ->get();
    
            return json_encode($seatInfo);
        } else {
            return json_encode(['message' => 'Seat Already exists']);
        }
    }
    
}
