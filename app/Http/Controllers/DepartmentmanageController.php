<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartHistory;
use App\Models\VisionMission;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Staff;
use App\Models\DepartmentNotice;
use App\Models\Departmentmanage;
use App\Models\SeminarBookStock;
use App\Models\SeminarNotice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class DepartmentmanageController extends Controller
{
    public function index()
    {
        
        return view('department.login');
    }
    public function loginaction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::guard('department')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $depart_value = DB::table('departments')
                ->where('email', '=', $request->email)
                ->get();
    
            foreach ($depart_value as $depart) {
                $depart_id = $depart->id;
                $depart_name = $depart->name;
                Session::put('depart_id', $depart_id);
                Session::put('depart_name', $depart_name);
    
                $depart_history = DB::table('depart_histories')
                    ->where('depart_id', '=', $depart_id)
                    ->get();
            }
    
            return view('department.dashboard', compact('depart_history', 'depart_value'));
        } else {
            return redirect('department-login')->with('error', 'Invalid email or password');
        }
    }
    public function departmentDashboard()
    {
        $Teacher = Teacher::count(); 
        $Student = Student::count(); 
        $Staff = Staff::count(); 
        $DepartmentNotice = DepartmentNotice::count(); 
        $SeminarBookStock = SeminarBookStock::count(); 
        $SeminarNotice = SeminarNotice::count(); 
        // $librarian = Librarian::count(); 
        // $libraryNotice = LibraryNotice::count(); 
        return view('department.dashboard',compact('Teacher','Student','Staff','DepartmentNotice','SeminarBookStock','SeminarNotice'));
        // return view('department.dashboard');
     
    }
    

    // public function dashboard()
    // {        
    //     return view('department.dashboard');
    // }
    // public function depart_history()
    // {        
    //     $depart_id = Session::get('depart_id');
    //     $depart_name = Session::get('depart_name');
    //     $depart_value = DB::table('departments')
    //         ->where('id', '=', $depart_id)->get();
    //     $depart_history = DB::table('depart_histories')
    //         ->where('depart_id', '=', $depart_id)->get();

     
    //     Session::put('depart_id', $depart_id);
    //             Session::put('depart_name', $depart_name);
    //     return view('department.dashboard', compact('depart_history','depart_value'));
    // }



//   public function depart_historyedit($id)
//     {
//         $data = DB::table('depart_histories')->find($id); 
//         return response()->json($data);
//     }
//     public function depart_vision()
//     {        
//         $depart_id = Session::get('depart_id');
//         $depart_name = Session::get('depart_name');
//         $depart_value = DB::table('departments')
//             ->where('id', '=', $depart_id)->get();

//         $vision_mission = DB::table('vision_missions')
//             ->where('depart_id', '=', $depart_id)->get();

//        Session::put('depart_id', $depart_id);
//                 Session::put('depart_name', $depart_name);
//         return view('department.vision', compact('vision_mission','depart_value'));
//     }



//  public function depart_visionedit($id)
//     {
//         $data = DB::table('vision_missions')->find($id); 
//         return response()->json($data);
//     }



//  public function historyeditaction(Request $request)
//     { 
//     $depart_id = $request->depart_id;
//     $depart_name = Session::get('depart_name');
//         $depart_value = DB::table('departments')
//             ->where('id', '=', $depart_id)->get();
//     $fileName = '';
//     $depart_history = DB::table('depart_histories')
//                 ->where('depart_id', '=', $depart_id)->get();
             
//     $emp =  DB::table('depart_histories')->find($request->id); 
           
//             if ( $request->photo)
//     {
//      $fileName = time().'.'.$request->photo->getClientOriginalExtension();
//      $request->photo->move(public_path('department/images/'), $fileName);
//     //$principal_images ='public/Exam_committee/'.$fileName;
//      $himages ='department/images/'.$fileName;

//         if($request->id>0)
//         {

//             $imagePath = public_path( $emp->history_images);
//             if(File::exists($imagePath)){
//                 unlink($imagePath);
//             }

//         }

//     }
//     else {
//         $himages = $emp->history_images;
//     }


//           DepartHistory::updateOrCreate([
//                 'id' => $request->id ],
//             [
                
//                 'history_title' => $request->name,
//                 'history_images' => $himages,
//                 'history_details' => $request->description,
              
                
                
//             ]);

//            Session::put('depart_id', $depart_id);
//                     Session::put('depart_name', $depart_name);
//              return view('department.dashboard', compact('depart_history','depart_value'));
//         }

// public function visioneditaction(Request $request)
//     { 
//   $depart_id = $request->depart_id;
//   $depart_name = Session::get('depart_name');
//   $depart_value = DB::table('departments');
//   $fileName1 = '';
//   $vision_mission = DB::table('vision_missions')
//             ->where('depart_id', '=', $depart_id)->get();
         
//   $emp1 =  DB::table('vision_missions')->find($request->id); 
       
//         if ( $request->photo)
// {
//   $fileName1 = time().'.'.$request->photo->getClientOriginalExtension();
//   $request->photo->move(public_path('department/images/'), $fileName1);
// //$principal_images ='public/Exam_committee/'.$fileName1;
//   $vimages ='department/images/'.$fileName1;

//     if($request->id>0)
//     {

//         $imagePath1 = public_path( $emp1->vision_images);
//         if(File::exists($imagePath1)){
//             unlink($imagePath1);
//         }

//     }

// }
// else {
//     $vimages = $emp1->vision_images;
// }


//       VisionMission::updateOrCreate([
//             'id' => $request->id ],
//         [
            
//             'vision_title' => $request->name,
//             'vision_images' => $vimages,
//             'vision_details' => $request->description,
          
            
            
//         ]);

//       Session::put('depart_id', $depart_id);
//                 Session::put('depart_name', $depart_name);
//        return back();
     
//     }


    public function department_out()
    {        
        Auth::guard('department')->logout();
        return view('department.login');
    }
}
