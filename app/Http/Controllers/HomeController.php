<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Basic;
use App\Models\Menu;
use App\Models\Event;
use App\Models\Slide;
use App\Models\Department;
use App\Models\Message;
use App\Models\principal;
use App\Models\principaldetails;
use App\Models\Vicepdetails;
use App\Models\Viceprincipal;
use App\Models\Headofdepartment;
use App\Models\qucklinks;
use App\Models\Apalinks;
use App\Models\Nislinks;
use App\Models\Innovativelinks;
use App\Models\Elearninglinks;
use App\Models\breaking_news;
use App\Models\AcademinCouncil;
use App\Models\TeacherCouncil;
use App\Models\TeacherCouncilHB;
use App\Models\Teacher;
use App\Models\Staff;
use App\Models\Exprincipal;
use App\Models\ExViceprincipal;
use App\Models\Notice_board;
use App\Models\NOC;
use App\Models\ApaNoc;
use App\Models\Office_order;
use App\Models\Librarian;
use App\Models\LibraryNotice;
use App\Models\Artsdepartment;
use App\Models\Submenu;
use App\Models\Bangabandhu;
use App\Models\goldenJubilee;
use App\Models\formController;
use App\Models\Video_clip;
use App\Models\online_portal;
use App\Models\bookstock;
use App\Models\subofsubmenu;
use App\Models\academic;
use App\Models\DegreeTeacher;
use App\Models\DegreeSyllabus;
use App\Models\library_card;
use App\Models\SportsTeacher;
use App\Models\Champion;
use App\Models\SNotice;
use App\Models\DegreeStaff;
use App\Models\DegreeNotice;
use App\Models\ExamMasterDutyRoster;
use App\Models\DegreeFirstYearStudent;
use App\Models\ExamRoomwiseMasterDutyRoster;
use App\Models\RoomNo;
use App\Models\ExamCommittees;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
     public function redirect()
    {
       $usertype= Auth::user()->usertype;

        if($usertype=='0')
        {
            $basic = Basic::find(1);  
            return view('backend.superadmin',compact('basic'));
        } 
        if($usertype=='1')
        {
            

            $Principal = principal::count(); 
            $Viceprincipal = Viceprincipal::count(); 
            $AcademinCouncil = AcademinCouncil::count(); 
            $TeacherCouncil = TeacherCouncil::count(); 
            return view('backend.office',compact('Principal','Viceprincipal','AcademinCouncil','TeacherCouncil',));
        }
        if($usertype=='2')
        {

            return view('backend.principanladmin');
        }
        if($usertype=='3')
        {
            $bookstock = bookstock::count(); 
            $libraryStudent = library_card::count(); 
            $librarian = Librarian::count(); 
            $libraryNotice = LibraryNotice::count(); 
            return view('backend.libraryadmin',compact('bookstock','libraryStudent','librarian','libraryNotice'));
        }
        if($usertype=='4')
        {
            
            return view('backend.hosteladmin');
        }
        if($usertype=='5')
        {
            
            $SportsTeacher = SportsTeacher::count(); 
            $Champion = Champion::count(); 
            $SNotice = SNotice::count(); 
            return view('backend.sportsadmin',compact('SportsTeacher','Champion','SNotice'));
        }

        if($usertype=='6')
        {

            return view('backend.cocurricularadmin');
        }
         if($usertype=='7')
        {
            $authID = Auth::id();
            $ExamMasterDutyRoster = ExamMasterDutyRoster::where('user_id',$authID)->count();
            $ExamRoomwiseMasterDutyRoster = ExamRoomwiseMasterDutyRoster::where('user_id',$authID)->count();
            $ExamCommittees = ExamCommittees::where('user_id',$authID)->count();
            $RoomNo = RoomNo::count();
            return view('backend.exammanage',compact('ExamMasterDutyRoster','ExamRoomwiseMasterDutyRoster','RoomNo','ExamCommittees'));
        }
         if($usertype=='8')
        {

            return view('backend.busmanage');
        }

         if($usertype=='9')
        {

            return view('backend.viceprincipalpanel');
        }
          
    
         if($usertype=='11')
        {
            $DegreeTeacher = DegreeTeacher::count(); 
            $DegreeStaff = DegreeStaff::count(); 
            $DegreeFirstYearStudent = DegreeFirstYearStudent::count(); 
            $DegreeNotice = DegreeNotice::count(); 
            return view('backend.degreemanage',compact('DegreeTeacher','DegreeStaff','DegreeFirstYearStudent','DegreeNotice'));
        }
         if($usertype=='10')
        {
            $authID = Auth::id();
            $ExamMasterDutyRoster = ExamMasterDutyRoster::where('user_id',$authID)->count();
            $ExamRoomwiseMasterDutyRoster = ExamRoomwiseMasterDutyRoster::where('user_id',$authID)->count();
            $ExamCommittees = ExamCommittees::where('user_id',$authID)->count();
            $RoomNo = RoomNo::count();
            return view('backend.drexammanage',compact('ExamMasterDutyRoster','ExamRoomwiseMasterDutyRoster','RoomNo','ExamCommittees'));
        }
     
          
    }
 public function index()
    {
    $event = Event::orderBy('id', 'desc')->take(5)->get();   
    $menu = Menu::all();   
    $basic = Basic::find(1);  
    $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
    $slide = Slide::orderBy('id', 'asc')->get(); 
    $department = Department::orderBy('id', 'asc')->get(); 
    $dhead = Headofdepartment::orderBy('id', 'desc')->get();
    $hmassage =Message::orderBy('id', 'asc')->get();
    $department1 = Artsdepartment::orderBy('id', 'asc')->get();
    $qucklink = qucklinks::orderBy('id', 'desc')->take(9)->get();   
    $apalink = Apalinks::orderBy('id', 'desc')->take(5)->get();   
    $nislink = Nislinks::orderBy('id', 'desc')->take(5)->get();   
    $innovativelinks = Innovativelinks::orderBy('id', 'desc')->take(5)->get();   
    $elearninglinks = Elearninglinks::orderBy('id', 'desc')->take(5)->get();   
    $breaking_news = breaking_news::orderBy('id', 'desc')->get();
    $depart_value = DB::table('departments')
                ->where('faculty', '=', 1)->take(9)->get();
    $depart_value1 = DB::table('departments')
                ->where('faculty', '=', 2)->get();
    $depart_value2 = DB::table('departments')
                ->where('faculty', '=', 3)->get();
    $depart_value3 = DB::table('departments')
                ->where('faculty', '=', 4)->get();
    $sidemenu = Submenu::where('menu_id', 4)->get();
    $allbangabandhu = Bangabandhu::orderBy('id', 'desc')->take(5)->get();
    $allforms =formController::all();
    $apa_noc =ApaNoc::all();
    $online_portals = online_portal::orderBy('id', 'desc')->take(9)->get();
    $video_clips = Video_clip::orderBy('id', 'desc')->take(1)->get();
    $departments = DB::table('departments')->take(5)->get();
    $goldenJubilee = goldenJubilee::orderBy('id', 'desc')->take(5)->get();
    return view('index', compact('basic','menu','submenu','event','slide','department','hmassage','department1','dhead','qucklink','apalink','apa_noc','innovativelinks','elearninglinks','nislink','breaking_news','depart_value','depart_value1','depart_value2','depart_value3','allbangabandhu','sidemenu' ,'goldenJubilee','allforms','departments','online_portals','video_clips'));

}

public function principanladmin()
{
 return view('backend.principanladmin');
}


 public function academy($id)
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
   $slide = Slide::orderBy('id', 'asc')->get(); 
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
   $pmassage = Message::find($id);
        return view('frontend/academydetails', compact('basic','menu','slide','pmassage','submenu'));

}

 public function academic_calender()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
 $data = academic::where('type', 1)->first();
   $subofsubmenu = subofsubmenu::all();
   $sidemenu = academic::where('type', 1)->get();
        return view('frontend/academic_calender', compact('basic','menu','data','submenu','subofsubmenu','sidemenu'));

}


 public function principalview()
    {
    
       $menu = Menu::all();   
      
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
        $sidemenu = Submenu::where('menu_id', 3)->get();
        $subofsubmenu = subofsubmenu::all();
        $principal = principal::where('status', 0)->orderBy('id', 'desc')->take(10)->get();
  
         return view('frontend.principal', compact('basic','menu','submenu','principal','sidemenu' ,'subofsubmenu'));

}

 public function principaldetails($id)
    {    $menu = Menu::orderBy('id', 'asc')->get();  
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get(); 
        $p1 =  principal::find($id); 
          $p2 = DB::table('principaldetails')->where('p_id', $id)->get();
      $basic = Basic::find(1); 
        return view('frontend.principaldetails', compact('p1','menu','basic','p2' ,'submenu'));
    }

 public function viceprincipalview()
    {    
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
        $sidemenu = Submenu::where('menu_id', 3)->get();
        $subofsubmenu = subofsubmenu::all();
        $viceprincipal = Viceprincipal::where('status',0)->orderBy('id', 'desc')->get();
  
         return view('frontend.viceprincipal', compact('basic','menu','submenu','viceprincipal','sidemenu' ,'subofsubmenu'));

    }

public function viceprincipaldview($id)
    {    $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
        $p1 =  Viceprincipal::find($id); 
          $p2 = DB::table('vicepdetails')->where('v_id', $id)->get();
              $sidemenu = Submenu::where('menu_id', 3)->get(); 
      $basic = Basic::find(1); 
        return view('frontend.viceprincipaldetails', compact('p1','menu','basic','p2' ,'submenu','sidemenu'));
    }
public function dhead()
    {    $menu = Menu::orderBy('id', 'asc')->get();   
         
           $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
         $basic = Basic::find(1); 
        return view('frontend.teachers', compact('data','menu','basic' ,'submenu','sidemenu'));
    }

  public function academincouncilview()
    {  
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
                ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                ->select('submenus.*', 'menus.route','menus.title')
                ->get();
        $sidemenu = Submenu::where('menu_id', 3)->get();
        $subofsubmenu = subofsubmenu::all();
        $academincouncil = AcademinCouncil::orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->get();
        return view('frontend.academiccouncil', compact('academincouncil','menu','basic' ,'submenu','sidemenu','subofsubmenu'));
    }

 public function t_council()
    {  $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
       
       $t_council = TeacherCouncil::orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->get();
     
        return view('frontend.t_council', compact('menu','basic','t_council' ,'submenu','sidemenu','subofsubmenu'));
    }



public function t_councilhbview()
    {  $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
       
       $data = TeacherCouncilHB::orderBy('from', 'desc')->get();
       return view('frontend.teacherc_hb', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

public function t_view()
    {   $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
       $basic = Basic::find(1);

       $data = Teacher::where('status', 0)->get();
       $teacher = DegreeTeacher::where('status', 0)->get();
       // Merge the two collections
       $mergedData = $data->merge($teacher);
       // Sort the merged collection based on specific criteria
       $mergedData = $mergedData->sortBy([
           ['designation', 'asc'],
           ['bcs_batch', 'asc'],
           ['date_of_birth', 'asc'],
       ]);
        return view('frontend.teachersview', compact('menu','basic','mergedData' ,'submenu','sidemenu'));
    }
public function staffview()
    {   
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
                ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                ->select('submenus.*', 'menus.route','menus.title')
                ->get();
        $subofsubmenu = subofsubmenu::all();
        $sidemenu = Submenu::where('menu_id', 3)->get();
        $data = Staff::orderBy('id', 'desc')->get();
        $basic = Basic::find(1); 
        return view('frontend.staffview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
public function principalHonourBoard()
    {  
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
       $data = principal::where('status', 1)->orderBy('id', 'desc')->get();
       $basic = Basic::find(1); 
        return view('frontend.exprincipalview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

        public function vicePrincipalHonourBoard()
    {    
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
    //    $data = ExViceprincipal::orderBy('id', 'desc')->get();
       $data =Viceprincipal::where('status',1)->orderBy('id', 'desc')->get();
       $basic = Basic::find(1); 
    
        return view('frontend.exviceprincipalview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

  public function noticeboardview()
    {     $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     
       
      $sidemenu = Submenu::where('menu_id', 4)->get();
          $data = Notice_board::orderBy('id', 'desc')->get();
      $basic = Basic::find(1); 
    
        return view('frontend.noticeboardview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
public function nocview()
    {     $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     
      $sidemenu = Submenu::where('menu_id', 4)->get();
          $data = NOC::orderBy('id', 'desc')->get();
      $basic = Basic::find(1); 
    
        return view('frontend.nocview', compact('menu','basic','data' ,'submenu' ,'sidemenu'));
    }

    public function officeorderview()
    {    $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     
      $sidemenu = Submenu::where('menu_id', 4)->get();
          $data = Office_order::orderBy('id', 'desc')->get();
      $basic = Basic::find(1); 
    
        return view('frontend.officeorderview', compact('menu','basic','data' ,'submenu' ,'sidemenu'));
    }

public function libraryview()
    {   $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
                ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                ->select('submenus.*', 'menus.route','menus.title')
                ->get();
        $subofsubmenu = subofsubmenu::all();
        $sidemenu = subofsubmenu::where('sub_id', 28)->get();
        $data = Librarian::where('status',0)->orderBy('serial_num','asc')->get();
        $basic = Basic::find(1); 
 
        return view('frontend.libraryview', compact('menu','basic','data' ,'submenu','subofsubmenu','sidemenu'));
    }

 public function bookstockview()
    {     $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id', 28)->get();
    
        $data = bookstock::where('status',0)->orderBy('id','desc')->get();

        return view('frontend.bookstockview', compact('menu','basic','data' ,'submenu' ,'sidemenu'));
    }
public function syllabus()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.*')
            ->get();
    $basic = Basic::find(1); 
    $data = academic::where('type', 2)->orderBy('id', 'desc')->get();
    $degreedata = DegreeSyllabus::orderBy('id', 'desc')->get();
   $subofsubmenu = subofsubmenu::all();
   $sidemenu = academic::where('type', 2)->get();
    return view('frontend/syllabus', compact('basic','menu','data','submenu','subofsubmenu','sidemenu','degreedata'));

}

public function Co_Curricular()
    {   $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = Submenu::where('menu_id', 3)->get();
       
          $data = Teacher::orderBy('id', 'desc')->get();
      $basic = Basic::find(1); 
    
        return view('frontend.teachersview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

//  public function apanocview()
//     {     
//        $menu = Menu::all();   
//        $basic = Basic::find(1);  
//        $submenu = DB::table('submenus')
//             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
//             ->select('submenus.*', 'menus.route','menus.title')
//             ->get();
//        $subofsubmenu = subofsubmenu::all();
     
//       $sidemenu = Submenu::where('menu_id', 4)->get();
//           $data = ApaNoc::orderBy('id', 'desc')->get();
//       $basic = Basic::find(1); 
    
//         return view('frontend.nocview', compact('menu','basic','data' ,'submenu' ,'sidemenu'));
//     }
// public function examRoutine()
//     {
    
//       $menu = Menu::orderBy('id', 'asc')->get();   
//       $submenu = DB::table('submenus')
//             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
//             ->select('submenus.*', 'menus.*')
//             ->get();
//  $basic = Basic::find(1); 
//  $data = academic::where('type', 2)->orderBy('id', 'desc')->get();
//    $subofsubmenu = subofsubmenu::all();
//    $sidemenu = academic::where('type', 2)->get();
//         return view('frontend/exam_routine', compact('basic','menu','data','submenu','subofsubmenu','sidemenu'));

// }

}