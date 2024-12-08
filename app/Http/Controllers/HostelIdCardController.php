<?php

namespace App\Http\Controllers;

use App\Models\HostelIdCard;
use App\Models\Basic;
use App\Models\HostelIdCardNote;
use App\Models\HostelSeatAllotment;
use App\Models\Department;
use App\Models\User;
use App\Models\StudenClass;
use App\Models\DegreeClass;
use App\Models\LibraryLogo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Http\Request;

class HostelIdCardController extends Controller
{

    public function index()
    {

        $hostel_id = Auth::id(); 
        $hostelStudent = HostelSeatAllotment::where('hostel_id', '=',$hostel_id)->orderBy('id', 'asc')->get();
        $data = HostelIdCard::orderBy('id', 'desc')->get();
        $department = Department::orderBy('id', 'asc')->get();
        $genarelDepart = User::where('id', 17)->first();
        $className = StudenClass::orderBy('id', 'asc')->get();
        $degreeclassName = DegreeClass::orderBy('name', 'asc')->get();
        $hostelCardinfo = HostelIdCard::select(DB::raw('DATE(created_at) as date'))
        ->orderByDesc('date')
        ->distinct()
        ->limit(10)
        ->get();
        return view('backend.hostel_id_card', compact('data','hostelStudent','department','genarelDepart','className','degreeclassName','hostelCardinfo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        // try {
            $fileName = '';
            $emp = HostelIdCard::find($request->id);
            
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
            
            $hostel_id = Auth::id(); 
            HostelIdCard::updateOrCreate([
                'id' => $request->id
            ], [
                's_name' => $request->s_name,
                'deprartment' => $request->deprartment,
                'session' => $request->session,
                'year' => $request->class_name,
                'roll' => $request->roll,
                'registration' => $request->registration,
                'mobile_no' => $request->mobile_no,
                'blood_group' => $request->blood_group,
                'bulding_name' => $request->bulding_name,
                'floor_name' => $request->floor_name,
                'room_number' => $request->room_number,
                'seat_number' => $request->seat_number,
                'card_no' => $request->card_no,
                'photo' => $fileName,
                'hostel_id' => $hostel_id,      
            ]);
          
            if ($request->id != 0) {
                return redirect('hostelidcard')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('hostelidcard')->with('message', 'Inserted successfully!!!');
            }
        // } catch (\Exception $e) {
        //     return redirect('hostelidcard')->with('error', 'The form was not filled up completely!!!');
    
        // }
    }
    
    public function edit($id)
    {
        $data = HostelIdCard::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = HostelIdCard::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('hostel_card/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}


  
    public function hostcarddetails($id)
    {  
        $basic = LibraryLogo::where('id',3)->first(); 
        $ndata = HostelIdCard::find($id);
        $data = HostelIdCardNote::where('status',0)->get();
        return view('backend.hostel_idcarddetails', compact('basic','ndata','data' ));
    }
    public function studentreceipt($id)
    {  
        $basic = Basic::find(1); 
        $ndata = HostelIdCard::find($id);
        $data = HostelIdCardNote::where('status',0)->get();
        return view('backend.hostel_student_receipt', compact('basic','ndata','data' ));
    }


    public function StudentData($id)
    {
      
        try {
            $studentinfo = DB::table('hostel_seat_allotments')
            ->join('studen_classes','studen_classes.id','=','hostel_seat_allotments.class')
            ->join('hostel_buldings','hostel_buldings.id','=','hostel_seat_allotments.bulding_id')
            ->join('hostel_floors','hostel_floors.id','=','hostel_seat_allotments.floor_id')
            ->join('hostel_rooms','hostel_rooms.id','=','hostel_seat_allotments.room_id')
            ->where('hostel_seat_allotments.id', $id)
            ->select('hostel_seat_allotments.*','studen_classes.name AS class_name','hostel_buldings.bulding_name','hostel_floors.floor_name','hostel_rooms.room_number','hostel_rooms.seat_number')
            ->get();
            if ($studentinfo) {
                return response()->json($studentinfo);
            } else {
                return response()->json(['message' => 'Student not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    public function hostelIdCardExport(Request $request)
{

  $date = $request->createddate;
  $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateString();
  
  $ndata = HostelIdCard::whereDate('created_at', $formattedDate)->get();
  $basic = LibraryLogo::where('id',3)->first(); 
  $data = HostelIdCardNote::where('status',0)->get();
  return view('backend.hostel_idcard_pdf', compact('basic','ndata','data' ));
}
}
