<?php

namespace App\Http\Controllers;
use App\Models\Basic;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SportsTeacher;
use App\Models\Champion;
use App\Models\SNotice;
use App\Models\breaking_news;
use App\Models\Slide;
use App\Models\Event;
use App\Models\DepartHistory;
use App\Models\VisionMission;
use App\Models\Headofdepartment;
use App\Models\AcademinCouncil;
use App\Models\Teacher;
use App\Models\TeacherCouncil;
use App\Models\TeacherCouncilHB;
use App\Models\Staff;
use App\Models\Exprincipal;
use App\Models\ExViceprincipal;
use App\Models\principal;
use App\Models\Bangabandhu;
use App\Models\Annual_committees;
use App\Models\Submenu;
use App\Models\Viceprincipal;
use App\Models\goldenJubilee;
use App\Models\formController;
use App\Models\bus_terminal;
use App\Models\BusSchedule;
use App\Models\ClassSchedule;
use App\Models\Department;
use App\Models\User;
use App\Models\journal;
use App\Models\Librarian;
use App\Models\Student;
use App\Models\complain;
use App\Models\StudenClass;
use App\Models\StudentResult;
use App\Models\StudentSession;
use App\Models\subofsubmenu;
use App\Models\academic;
use App\Models\Photo_Gallery;
use App\Models\DepartmentNotice;
use App\Models\HostelNoticeBoard;
use App\Models\CoCurricular;
use App\Models\ApaNoc;
use App\Models\ElearningNotice;
use App\Models\InnovativeNotice;
use App\Models\NisNotice;
use App\Models\JournalofSaadat;
use App\Models\JournalofMagagin;
use App\Models\OtherPublication;
use App\Models\deptbgImage;
use App\Models\HostelGeneralInfo;
use App\Models\HostelHeadContact;
use App\Models\HostelApplication;
use App\Models\HostelGallery;
use App\Models\DegreeHistory;
use App\Models\DegreeOfHead;
use App\Models\DegreePhotoGallery;
use App\Models\DegreeMissionVision;
use App\Models\DegreeBackgroundImage;
use App\Models\DegreeTeacher;
use App\Models\DegreeStaff;
use App\Models\DegreeClass;
use App\Models\DegreeNotice;
use App\Models\DegreeFirstYearStudent;
use App\Models\bookstock;
use App\Models\LibraryGallery;
use App\Models\LibraryNotice;
use App\Models\StudentAdmission;
use App\Models\CourseName;
use App\Models\CourseFee;
use App\Models\FailCourseFee;
use App\Models\FormFillUpFee;
use App\Models\ImprovementFee;
use App\Models\DegreeCourse;
use App\Models\RegularFee;
use App\Models\IrregularFormFillUpFee;
use App\Models\IrregularNonFormFillUpFee;
use App\Models\ConditionalPromotedFee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class NavbarController extends Controller
{
    public function menu($route,$id)
    {
  $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
 $basic = Basic::find(1); 
 $tmenu =  Menu::find($id);
    
//echo $menu[0]->title;

    return view('frontend.menu', compact('basic','tmenu','menu','submenu'));


    }
  public function sportteacherview()
    {    $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
          $data = SportsTeacher::all();
   
     $sidemenu = subofsubmenu::where('sub_id',29)->get();
        return view('frontend.sportteacherview', compact('menu','basic','data' ,'submenu','sidemenu'));
      
    }


  public function sportchampionview()
    {    $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
    
          $data = Champion::all();
      
     $sidemenu = subofsubmenu::where('sub_id',29)->get();
        return view('frontend.sportchampionview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

 public function sportnoticeview()
    {     $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     $sidemenu = subofsubmenu::where('sub_id',29)->get();
          $data = SNotice::all();
     
    
        return view('frontend.sportnoticeview', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

 public function hostelnotice()
    {     
      $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     $sidemenu = subofsubmenu::where('sub_id',27)->get();
          $data = HostelNoticeBoard::orderBy('hostel_id', 'asc')->get();
     
    
        return view('frontend.hostel_notice', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function rulesRegulation()
    {     
      $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
     $sidemenu = subofsubmenu::where('sub_id',27)->get();
     $data = HostelApplication::where('type',2)->orderBy('hostel_id', 'asc')->get();
     
    
        return view('frontend.hostel_rules_regulation', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function hostelHeadContact()
    {     
      $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id',27)->get();
       $data = HostelHeadContact::orderBy('hostel_name', 'asc')->get();
        return view('frontend.hostel_head_contact', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function generalInformation()
    {     
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id',27)->get();
       $data = HostelGeneralInfo::all();

      return view('frontend.hostel_genarel_information', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function hostelApplication()
    {     
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id',27)->get();
       $data = HostelApplication::where('type',1)->orderBy('hostel_id', 'asc')->get();

      return view('frontend.hostel_application', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function hostelGallary()
    {     
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id',27)->get();
       $data = HostelGallery::orderBy('hostel_id', 'asc')->get();
      return view('frontend.hostel_gallery', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

    public function Librarynotice()
    {     
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
              ->join('menus', 'menus.id', '=', 'submenus.menu_id')
              ->select('submenus.*', 'menus.route','menus.title')
              ->get();
        $subofsubmenu = subofsubmenu::all();
        $sidemenu = subofsubmenu::where('sub_id',28)->get();
        $data = LibraryNotice::orderBy('id', 'desc')->get();
        return view('frontend.library_notice', compact('menu','basic','data' ,'submenu','sidemenu'));
    }
 public function LibraryGallary()
    {     
       $menu = Menu::all();   
       $basic = Basic::find(1);  
       $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
       $subofsubmenu = subofsubmenu::all();
       $sidemenu = subofsubmenu::where('sub_id',28)->get();
       $data = LibraryGallery::orderBy('id', 'asc')->get();
      return view('frontend.library_gallery', compact('menu','basic','data' ,'submenu','sidemenu'));
    }

 public function arts($id)
    {     
      if($id == 20){
         $menu = Menu::all();   
         $basic = Basic::find(1);  
         $submenu = DB::table('submenus')
             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
             
             ->select('submenus.*', 'menus.route','menus.title')
             ->get();
         $subofsubmenu = subofsubmenu::all();
 
         $departments_id = DB::table('departments')->where('id', $id)->get();
        //      dd($departments_id);
        //      foreach ($departments_id as $key => $value) {
         $facultys = DB::table('faculties')->where('id', 5)->get();
            //  }
         $history = DegreeHistory::orderBy('id', 'asc')->get();
         $headofdepartment = DegreeOfHead::orderBy('id', 'asc')->get();
         $photo_gallery = DegreePhotoGallery::orderBy('id', 'asc')->get();
         $visionmission = DegreeMissionVision::orderBy('id', 'asc')->get();
         $backgroundImage = DegreeBackgroundImage::orderBy('id', 'asc')->first();
         $teacher = DegreeTeacher::where('status',0)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
         $honourteacher = DegreeTeacher::where('status',1)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
         $staff = DegreeStaff::where('status',0)->orderBy('serial_num','asc')->get();
         $student =  DegreeFirstYearStudent::get();
         $studentclass = DegreeClass::all();
         $notice = DegreeNotice::orderBy('id','asc')->get();
         return view('department.degree_index', compact('menu','basic','student','submenu','facultys','history','backgroundImage','visionmission','headofdepartment','teacher','studentclass','subofsubmenu','departments_id','staff','photo_gallery','notice','honourteacher'));
     
      }else{
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
             
             ->select('submenus.*', 'menus.route','menus.title')
             ->get();
        $subofsubmenu = subofsubmenu::all();
 
             $departments_id = DB::table('departments')->where('id', $id)->get();
             foreach ($departments_id as $key => $value) {
                $facultys = DB::table('faculties')->where('id', $value->faculty)->get();
             }
            //  dd($facultys);

         $history = DepartHistory::where('depart_id', $id)->get();
         $headofdepartment = Headofdepartment::where('depart_id', $id)->get();
         $photo_gallery = Photo_Gallery::where('department_id', '=', $id)->get();
        $visionmission = VisionMission::where('depart_id', $id)->get();
        $backgroundImage = deptbgImage::where('depart_id', $id)->first();
        $teacher = Teacher::where('depart_id', '=', $id)->where('status',0)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
        $honourteacher = Teacher::where('depart_id', '=', $id)->where('status',1)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
        $staff = Staff::where('depart_id', '=', $id)->where('status',0)->orderBy('serial_num','asc')->get();
        $student =  Student::where('depart_id', '=', $id)->get();
        $studentclass = StudenClass::all();
        $notice = DepartmentNotice::where('depart_id', '=', $id)->get();
         return view('department.index', compact('menu','basic' ,'submenu','history','backgroundImage','visionmission','headofdepartment','facultys','teacher','student','studentclass','subofsubmenu','departments_id','staff','photo_gallery','notice','honourteacher'));
     
      }
    
    }
    
    public function studentSearch(Request $request){
      $query = Student::query();
      if($request->ajax()){      
          $studentSer = $query->where('name','LIKE', '%'.$request->search.'%')
              ->orWhere('department','LIKE', '%'.$request->search.'%')
              ->orWhere('session','LIKE', '%'.$request->search.'%')
              ->orWhere('roll','LIKE', '%'.$request->search.'%')
              ->orWhere('registration_no','LIKE', '%'.$request->search.'%')
              ->get();
          return response()->json($studentSer);
      }
      else{
          $data = $query->get();
          return view('department.index', compact('data'));
      }
  }
  
     public function department_notice($id)
    {  
      if($id == 20){
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
             
             ->select('submenus.*', 'menus.route','menus.title')
             ->get();
        $subofsubmenu = subofsubmenu::all();
           $data = SportsTeacher::all();
    
           $notice = DepartmentNotice::where('id', '=', $id)->get();
       foreach ($notice as $value1) {
           $sidemenu = DepartmentNotice::where('depart_id', '=', $value1->depart_id)->get();
       }
             $departments_id = DB::table('departments')->where('id', $id)->get();
             foreach ($departments_id as $key => $value) {
                $facultys = DB::table('faculties')->where('id', $value->faculty)->get();
             }
   
          $notice = DegreeNotice::where('id', '=', $id)->get();
         return view('department.degree_department_notice', compact('menu','basic' ,'submenu','notice','sidemenu'));
      }else{
        $menu = Menu::all();   
        $basic = Basic::find(1);  
        $submenu = DB::table('submenus')
             ->join('menus', 'menus.id', '=', 'submenus.menu_id')
             
             ->select('submenus.*', 'menus.route','menus.title')
             ->get();
        $subofsubmenu = subofsubmenu::all();
           $data = SportsTeacher::all();
    
           $notice = DepartmentNotice::where('id', '=', $id)->get();
       foreach ($notice as $value1) {
           $sidemenu = DepartmentNotice::where('depart_id', '=', $value1->depart_id)->get();
       }
             $departments_id = DB::table('departments')->where('id', $id)->get();
             foreach ($departments_id as $key => $value) {
                $facultys = DB::table('faculties')->where('id', $value->faculty)->get();
             }
   
          $notice = DepartmentNotice::where('id', '=', $id)->get();
         return view('department.department_notice', compact('menu','basic' ,'submenu','notice','sidemenu'));
      }

    }
    
    public function location()
{

  $menu = Menu::orderBy('id', 'asc')->get();   
  $submenu = DB::table('submenus')
        ->join('menus', 'menus.id', '=', 'submenus.menu_id')
        
        ->select('submenus.*', 'menus.*')
        ->get();
$basic = Basic::find(1); 



     

    return view('frontend/location', compact('basic','menu','submenu'));

}
    
public function goldenJubilee($id)
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
 
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
  $allgoldenJubilee = goldenJubilee::all();
   $goldenJubilee = goldenJubilee::find($id); 

        return view('frontend/goldenJubilee', compact('basic','menu','submenu','goldenJubilee','allgoldenJubilee'));

}
 public function bongobondhu($id)
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
 

  $allbangabandhu = Bangabandhu::all();
   $bangabandhu = Bangabandhu::find($id); 

        return view('frontend/bongobondhu', compact('basic','menu','submenu','bangabandhu','allbangabandhu'));

}



    public function newsview($id)
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

             $news = breaking_news::find($id); 

        return view('frontend/newsview', compact('basic','menu','slide','news','submenu'));

}
 public function eventview($id)
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
 $allevent = Event::all(); 
             $event = Event::find($id); 

        return view('frontend/eventview', compact('basic','menu','event','submenu','allevent'));

}

 public function aboutus()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
 $departhistory = DepartHistory::find(38); 
         

        return view('frontend/aboutushistory', compact('basic','menu','submenu','departhistory'));

}


 public function vision()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();
     $visionmission = VisionMission::find(38); 
              
   return view('frontend/vision', compact('basic','menu','submenu','visionmission'));

}

 public function admission()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();

      $department = Department::orderBy('id', 'asc')->get();
      $genarelDepart = User::where('id', 17)->first();
      $className = StudenClass::orderBy('id', 'asc')->get();
      $degreeclassName = DegreeClass::orderBy('name', 'asc')->get();    
   return view('frontend/student_login_from', compact('basic','menu','submenu','department','genarelDepart','className','degreeclassName'));

}
 public function admissionRegistration()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();

      $department = Department::orderBy('id', 'asc')->get();
      $genarelDepart = User::where('id', 17)->first();
      $className = StudenClass::orderBy('id', 'asc')->get();
      $degreeclassName = DegreeClass::orderBy('name', 'asc')->get();    
   return view('frontend/student_registration_from', compact('basic','menu','submenu','department','genarelDepart','className','degreeclassName'));

}


public function admissionDepartClassInfo($depart_id)
{
    if ($depart_id == 40) {
        $classInfo = DB::table('degree_classes')->orderBy('id', 'asc')->get();
    } else {
        $classInfo = DB::table('studen_classes')->orderBy('id', 'asc')->get();
    }
    return response()->json($classInfo);
}

 public function admissionStore(Request $request)
    {

    $request->validate([

        'sname' => 'required',
        'department_id' => 'required',
        'class' => 'required',
        'session' => 'required',
        'roll' => 'required',
        'registration' => 'required',
        'user_name' => 'required|unique:student_admissions,user_name',
        'password' => 'required|min:8'
    ]);

    $departId = $request->department_id;
    $classId = $request->class;
    $session = $request->session;
    $roll = $request->roll;
    $regi = $request->registration;
   if ($departId =='40' && $classId =='1' ) {
      $degree1stYear = DegreeFirstYearStudent::where('registration_no', $regi)->where('session',$session)->first();
   } elseif($departId =='40' && $classId =='2' ) {
      $degree2ndYear = DegreeSecoundYearStudent::where('registration_no', $regi)->where('session_year',$session)->first();
   } elseif($departId =='40' && $classId =='3' ) {
      $degree3rdYear = DegreeThirdYearStudent::where('registration_no', $regi)->where('session_year',$session)->first();
   } elseif( $classId =='1') {
      $honours1stYear = Student::where('registration_no', $regi)->where('session',$session)->first();
   } elseif( $classId =='2') {
      $honours2ndYear = StudentHonoursSecoundYear::where('registration_no', $regi)->where('session_year',$session)->first();
   } elseif( $classId =='3') {
      $honours3rdYear = StudentHonoursThirdYear::where('registration_no', $regi)->where('session_year',$session)->first();
   } elseif( $classId =='4') {
      $honours4thYear = StudentHonoursFourthYear::where('registration_no', $regi)->where('session_year',$session)->first();
   } elseif( $classId =='5') {
      $preliminaryMaster = StudentPreliminaryToMasters::where('registration_no', $regi)->where('session',$session)->first();
   } elseif( $classId =='6') {
      $masterFinal = StudentMastersFinal::where('registration_no', $regi)->where('session',$session)->first();
   }
     // Check if any data is found based on conditions, if not, return error message
     if (!isset($degree1stYear) && !isset($degree2ndYear) && !isset($degree3rdYear) && !isset($honours1stYear) && !isset($honours2ndYear) && !isset($honours3rdYear) && !isset($honours4thYear) && !isset($preliminaryMaster) && !isset($masterFinal)) {
      return redirect('admission')->with('message', 'Registration Data not Match!!');
  }

   StudentAdmission::updateOrCreate([
         'id' => $request->id
      ], [
         'depart_id' => $departId,
         'class_id' => $classId,
         'session' => $session,
         'sname' => $request->sname,
         'roll' => $roll,
         'regi_no' => $regi,
         'user_name' => $request->uname,
         'password' => Hash::make($request->password),
         'text_password' => $request->password,
      ]);

      if ($request->id != 0) {
         return back()->with('message', 'Updated successfully!!!');
      } else {
         return back()->with('message', 'Registration successfully!!!');
      }
 
   // return view('frontend/admission_from', compact('basic','menu','submenu','department','genarelDepart','className','degreeclassName'));

}
public function admissionLogin(Request $request)
{

   $uname = $request->uname;
   $pswd = $request->pswd;

   $admissionLogin = StudentAdmission::where('user_name', $uname)->first();
   $departId = $admissionLogin->depart_id;
   $classId = $admissionLogin->class_id;
   $session = $admissionLogin->session;
   $roll = $admissionLogin->roll;
   $regi = $admissionLogin->regi_no;
    if ($admissionLogin && Hash::check($pswd, $admissionLogin->password)) {

      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();  
      $department = Department::orderBy('id', 'asc')->get();;
      $genarelDepart = User::where('id', 17)->first();
      $className = StudenClass::orderBy('id', 'asc')->get();
      $degreeclassName = DegreeClass::orderBy('name', 'asc')->get();   
      $Student1stYear = Student::where('depart_id', $departId)->where('studentclass', $classId)->where('registration_no', $regi)->first();
      $courseName = CourseName::where('class_id',$classId)->get();
   return view('frontend/student_admission_form', compact('basic','menu','submenu','degreeclassName','department','courseName','genarelDepart','className','Student1stYear'));
    } else {
   
        return back()->withInput()->with('error', 'Invalid username or password.');
    }
}

public function admissionType($typevalue, $departId, $classId)
{
   if ($typevalue == 'fail') {
      $FailCurseFeeInfo = FailCourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->first();
      $failAmount = $FailCurseFeeInfo->failcoursefee_amount;
     
      // $CurseFeeInfo = CourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      // $sum = 0;
      // foreach ($CurseFeeInfo as $item) {
      //     $sum += $item->fee_amount;
      // }
      
      $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();

      $data = [
         // 'sum' => $sum,
         'failAmount' => $failAmount,
         'CourseName' => $CourseName,
     ];
 
     return response()->json($data);
   }else if($typevalue == 'imporvement'){
      $ImprovementFee = ImprovementFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $sum = 0;
      foreach ($ImprovementFee as $item) {
          $sum += $item->fee_amount;
      }
      $data = [
         'sum' => $sum,
         'CourseName' => $CourseName,
     ];
 
     return response()->json($data);
   }else if($typevalue == 'ir-regular-form-fillup'){
      $IrregularFormFillUpFee = IrregularFormFillUpFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $sum = 0;
      foreach ($IrregularFormFillUpFee as $item) {
          $sum += $item->fee_amount;
      }
      $data = [
         'sum' => $sum,
         'CourseName' => $CourseName,
     ];
 
     return response()->json($data);
   }else if($typevalue == 'ir-regular-non-form-fillup'){
      $IrregularNonFormFillUpFee = IrregularNonFormFillUpFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $sum = 0;
      foreach ($IrregularNonFormFillUpFee as $item) {
          $sum += $item->fee_amount;
      }
      $data = [
         'sum' => $sum,
         'CourseName' => $CourseName,
     ];
     return response()->json($data);
   }else if($typevalue == 'cpromoted'){
      $ConditionalPromotedFee = ConditionalPromotedFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $sum = 0;
      foreach ($ConditionalPromotedFee as $item) {
          $sum += $item->fee_amount;
      }
      $data = [
         'sum' => $sum,
         'CourseName' => $CourseName,
     ];
     return response()->json($data);
   }else{


     if ($departId == 40) {
            
      $CurseFeeInfo = CourseFee::where('depart_id','=', 40)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $RegularFeeInfo = RegularFee::where('depart_id','=', 40)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
      $courseSum = 0;
      $FeeSum = 0;
      foreach ($CurseFeeInfo as $item) {
          $courseSum += $item->fee_amount;
      }
      foreach ($RegularFeeInfo as $item) {
          $FeeSum += $item->fee_amount;
      }
      $totalSum = $courseSum + $FeeSum;
      $CourseName = DegreeCourse::where('class_id','=', $classId)->orderBy('class_id','asc')->get();

      $data = [
         'sum' => $totalSum,
         'CourseName' => $CourseName,
     ];
 
     return response()->json($data);
     } else {
        $CurseFeeInfo = CourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
        $RegularFeeInfo = RegularFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
        $courseSum = 0;
        $FeeSum = 0;
        foreach ($CurseFeeInfo as $item) {
            $courseSum += $item->fee_amount;
        }
        foreach ($RegularFeeInfo as $item) {
            $FeeSum += $item->fee_amount;
        }
        $totalSum = $courseSum + $FeeSum;

        $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();

        $data = [
            'sum' => $totalSum,
            'CourseName' => $CourseName,
        ];
    
        return response()->json($data);
     }
     

   }
   
}
// public function admissionType($typevalue, $departId, $classId)
// {
//    if ($typevalue == 'fail') {
//       $FailCurseFeeInfo = FailCourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->first();
//       $failAmount = $FailCurseFeeInfo->failcoursefee_amount;
     
//       // $CurseFeeInfo = CourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       // $sum = 0;
//       // foreach ($CurseFeeInfo as $item) {
//       //     $sum += $item->fee_amount;
//       // }
      
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();

//       $data = [
//          // 'sum' => $sum,
//          'failAmount' => $failAmount,
//          'CourseName' => $CourseName,
//      ];
 
//      return response()->json($data);
//    }else if($typevalue == 'imporvement'){
//       $ImprovementFee = ImprovementFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $sum = 0;
//       foreach ($ImprovementFee as $item) {
//           $sum += $item->fee_amount;
//       }
//       $data = [
//          'sum' => $sum,
//          'CourseName' => $CourseName,
//      ];
 
//      return response()->json($data);
//    }else if($typevalue == 'ir-regular-form-fillup'){
//       $IrregularFormFillUpFee = IrregularFormFillUpFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $sum = 0;
//       foreach ($IrregularFormFillUpFee as $item) {
//           $sum += $item->fee_amount;
//       }
//       $data = [
//          'sum' => $sum,
//          'CourseName' => $CourseName,
//      ];
 
//      return response()->json($data);
//    }else if($typevalue == 'ir-regular-non-form-fillup'){
//       $IrregularNonFormFillUpFee = IrregularNonFormFillUpFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $sum = 0;
//       foreach ($IrregularNonFormFillUpFee as $item) {
//           $sum += $item->fee_amount;
//       }
//       $data = [
//          'sum' => $sum,
//          'CourseName' => $CourseName,
//      ];
//      return response()->json($data);
//    }else if($typevalue == 'cpromoted'){
//       $ConditionalPromotedFee = ConditionalPromotedFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $sum = 0;
//       foreach ($ConditionalPromotedFee as $item) {
//           $sum += $item->fee_amount;
//       }
//       $data = [
//          'sum' => $sum,
//          'CourseName' => $CourseName,
//      ];
//      return response()->json($data);
//    }else{
    
//       $CurseFeeInfo = CourseFee::where('depart_id','=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();
//       $sum = 0;
//       foreach ($CurseFeeInfo as $item) {
//           $sum += $item->fee_amount;
//       }
//       $CourseName = CourseName::where('depart_id', '=', $departId)->where('class_id','=', $classId)->orderBy('class_id','asc')->get();

//       $data = [
//          'sum' => $sum,
//          'CourseName' => $CourseName,
//      ];
 
//      return response()->json($data);
//    }
   
// }




public function admissionDepartInfo($id,$depart_id)
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
public function admissionSessionInfo($id,$depart_id)
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
public function seminarstuallInfo(Request $request){
   $stu_id  = $request->stu_id;
   $data = explode('/', $stu_id);  
   $class_id = $data[0]; 
   $stu_id = $data[1]; 
   $depart_id    = Session::get('depart_id');
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

public function formFillUpFeeStore(Request $request)
{
// return $request->all();


FormFillUpFee::updateOrCreate([
     'id' => $request->id
  ], [

     'dname' => $request->depart_id,
     'class_name' => $request->class_id,
     'sname' => $request->sname,
     'session' => $request->session,
     'roll' => $request->roll,
     'regino' => $request->registration,
     'regi_type' => $request->regi_type,
     'course_code' => implode(',', $request->course_code),
     'amount' => $request->amount,
  ]);

  if ($request->id != 0) {
     return redirect('form-fillUp-fee-store')->with('message', 'Updated successfully!!!');
  } else {
     return redirect('form-fillUp-fee-store')->with('message', 'Inserted successfully!!!');
  }

// return view('frontend/admission_from', compact('basic','menu','submenu','department','genarelDepart','className','degreeclassName'));

}

public function contactus($id){
  return view('frontend/contactus');
}
// public function cocurricular($id){
//   return view('frontend/cocurricular');
// }

public function cocurricularManage($slug){
  $menu = Menu::orderBy('id', 'asc')->get();   
  $submenu = DB::table('submenus')
        ->join('menus', 'menus.id', '=', 'submenus.menu_id')
        ->select('submenus.*', 'menus.*')
        ->get();
$basic = Basic::find(1); 

$submenu = DB::table('submenus')
        ->join('menus', 'menus.id', '=', 'submenus.menu_id')
        ->select('submenus.*', 'menus.route','menus.title')
        ->get();
$CoCurricular = DB::table('co_curriculars')->where('name_slug', $slug)->get();
       
    return view('frontend.co_curricular_manage', compact('basic','menu','submenu','CoCurricular'));
}

 public function annual_committee()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
  $sidemenu = Submenu::where('menu_id', 4)->get();
         $data =Annual_committees::where('type', 1)->get();
 $data1 =Annual_committees::where('type', 2)->get();


        return view('frontend/annual_committee', compact('basic','menu','submenu','data','data1','sidemenu'));

}

public function Librainansearch(Request $request){
  $query = Librarian::query();
    if($request->ajax()){      
      $personnel = $query->where('name','LIKE', '%'.$request->search.'%')
                       ->orWhere('designation','LIKE', '%'.$request->search.'%')
                       ->orWhere('mobile_no','LIKE', '%'.$request->search.'%')
                       ->orWhere('email','LIKE', '%'.$request->search.'%')
                        ->get();
      return response()->json($personnel);
    }
    else{
      $data = $query->get();
      return view()->json(['personnel'=>$personnel]);
      return view('frontend.libraryview',compact('data'));

    }
   }
public function Librarybookstock(Request $request){
  $query = bookstock::query();
    if($request->ajax()){      
      $bookstocts = $query->where('book_name','LIKE', '%'.$request->search.'%')
                       ->orWhere('author','LIKE', '%'.$request->search.'%')
                       ->orWhere('publiction','LIKE', '%'.$request->search.'%')
                       ->get();
      return response()->json($bookstocts);
    } 
    else{
      $data = $query->get();
      return view()->json(['bookstocts'=>$bookstocts]);
      return view('frontend.bookstockview',compact('data'));

    }
}
public function academics($id,$type)
    {
  
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
 $academic = academic::find($id);
   $subofsubmenu = subofsubmenu::all();
   $sidemenu = academic::where('type',$type)->get();
   return view('frontend/allacademic', compact('basic','menu','academic','submenu','subofsubmenu','sidemenu'));

}


 public function fromsview($id)
    { $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
  $sidemenu = formController::all();
        
        $data =formController::find($id);
         $alldata =formController::all();
        return view('frontend.formsview', compact('basic','menu','submenu','data','sidemenu','alldata'));
    }

 public function apaNoticeView()
    { $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
  $sidemenu = ApaNoc::all();
        
        $data =ApaNoc::orderBy('id', 'desc')->get();
        // $data =ApaNoc::find($id);
         $alldata =ApaNoc::all();
        return view('frontend.apa_notice_view', compact('basic','menu','submenu','data','sidemenu','alldata'));
    }
 public function nisNoticeView()
    { $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();
      $sidemenu = NisNotice::all();
      $data =NisNotice::orderBy('id', 'desc')->get();
      return view('frontend.nis_notice_view', compact('basic','menu','submenu','data','sidemenu'));
    }
 public function innovativeNoticeView()
    { $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
        
      $submenu = DB::table('submenus')
                  ->join('menus', 'menus.id', '=', 'submenus.menu_id')
                  
                  ->select('submenus.*', 'menus.route','menus.title')
                  ->get();
      $sidemenu = InnovativeNotice::all();
              
      $data =InnovativeNotice::orderBy('id', 'desc')->get();

      return view('frontend.innovative_notice_view', compact('basic','menu','submenu','data','sidemenu'));
    }
 public function elearningNoticeView()
    { $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
  
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
      $sidemenu = ElearningNotice::all();
        
        $data =ElearningNotice::orderBy('id', 'desc')->get();
        return view('frontend.elearning_notice_view', compact('basic','menu','submenu','data','sidemenu'));
    }
    

   public function busschedule()
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

        $bus_terminals = bus_terminal::orderBy('id', 'asc')->get();
        $data = BusSchedule::orderBy('id', 'asc')->get();
      
        return view('frontend/busschedule', compact('basic','menu','slide','bus_terminals','submenu','data'));

} 
//  public function class_schedules($id)
//     {
//       $currenturl = url()->current();
//       $menu = Menu::orderBy('id', 'asc')->get();   
//       $submenu = DB::table('submenus')
//       ->join('menus', 'menus.id', '=', 'submenus.menu_id')
      
//       ->select('submenus.*', 'menus.*')
//       ->get();
//       $basic = Basic::find(1); 
//       $sidemenu = Department::all();
      
//       $data = $depart_value3 = DB::table('class_schedules')
//       ->where('depart_id', '=',$id)->get();

//         return view('frontend.class_schedules', compact('basic','menu','submenu','data','sidemenu','currenturl'));

//       }  
 public function class_schedules($id)
 {     
  if($id == 20){
     $menu = Menu::all();   
     $basic = Basic::find(1);  
     $submenu = DB::table('submenus')
         ->join('menus', 'menus.id', '=', 'submenus.menu_id')
         
         ->select('submenus.*', 'menus.route','menus.title')
         ->get();
     $sidemenu = Department::all();
     $subofsubmenu = subofsubmenu::all();
     $data = DB::table('degree_class_schedules')->get();
     return view('frontend.class_schedules_degree', compact('basic','menu','sidemenu','submenu','data','subofsubmenu'));
  }else {
    $currenturl = url()->current();
    $menu = Menu::orderBy('id', 'asc')->get();   
    $submenu = DB::table('submenus')
    ->join('menus', 'menus.id', '=', 'submenus.menu_id')
    ->select('submenus.*', 'menus.*')
    ->get();
    $basic = Basic::find(1); 
    $sidemenu = Department::all();
    
    $data = $depart_value3 = DB::table('class_schedules')
    ->where('depart_id', '=',$id)->get();

      return view('frontend.class_schedules', compact('basic','menu','submenu','data','sidemenu','currenturl'));

    }  

}
 

      
      
     public function journals()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
 $basic = Basic::find(1); 
 
$submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
   $journal = JournalofSaadat::get(); 

        return view('frontend/journals', compact('basic','menu','submenu','journal'));

}
     public function collegeMagazines()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
 
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
      $collegeMagazine = JournalofMagagin::orderBy('id', 'desc')->get(); 

      return view('frontend.college_magazine', compact('basic','menu','submenu','collegeMagazine'));

}
     public function otherPublications()
    {
    
      $menu = Menu::orderBy('id', 'asc')->get();   
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.*')
            ->get();
      $basic = Basic::find(1); 
 
      $submenu = DB::table('submenus')
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            
            ->select('submenus.*', 'menus.route','menus.title')
            ->get();
      $otherPublication = OtherPublication::orderBy('id', 'desc')->get(); 

      return view('frontend.other_publication', compact('basic','menu','submenu','otherPublication'));

}
    
// public function complainMassage(Request $request){
//   complain::create($request->all());
//   return redirect()->back()->with('success','Complain Massage Sent successfully.');

  
// }
public function complainMassage(Request $request)
{
    $validator = Validator::make($request->all(), [
        'complain_massage' => 'required|string|max:4005',
    ]);
    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // Check if the message contains a link or specific content
    if (strpos($request->complain_massage, 'http') !== false) {
        return redirect()->back()->with('error', 'Messages containing links are not allowed.');
    }

    Complain::create($request->all());

    return redirect()->back()->with('success', 'Complaint message sent successfully.');
}
    

public function resultlogin(){
  return view('frontend.resultlogin');
}

public function studentresult(Request $request){
  // return($request);
  $stu_roll = $request->roll;
  $reg = $request->reg;
  $years = $request->year;

  $stu_reg = Student::where('registration_no', '=', $reg)->value('registration_no');
  $stu_id = Student::where('roll', '=', $stu_roll)->value('id');
  $stu_year = StudentResult::where('years', '=', $years)->value('years');

  $class_id = StudentResult::where('years', '=', $stu_year)->where('student_id','=',$stu_id)->value('class_id');
   if($stu_year==$years){
$studentSession = StudentSession::where('stu_id', $stu_id )->where('class_name', $class_id )->first();
$studentInfos = Student::where('id', $studentSession->stu_id)->first();
                    
$CourseInfo = DB::table('student_sessions')
                  ->where('stu_id', $studentSession->stu_id)
                  ->where('class_name','=', $studentSession->class_name)
                  ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
                  ->select('student_sessions.*', 'course_names.*')
                  ->get();
$Courselist = DB::table('student_sessions')
                  ->where('stu_id', $studentSession->stu_id)
                  ->where('class_name','=', $studentSession->class_name)
                  ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
                  ->select('student_sessions.*', 'course_names.*')
                  ->first();

$ExamYear = DB::table('student_results')
                  ->where('student_id', $Courselist->stu_id)
                  ->where('subject', $Courselist->id)
                  ->first();

$ExamClassName = DB::table('studen_classes')
                  ->where('depart_id', $ExamYear->depart_id)
                  ->where('id', $ExamYear->class_id)
                  ->first();
return view('backend.mark_sheet_download_fontend', compact('studentInfos','CourseInfo','ExamYear','ExamClassName'));
}
else{
  return view('frontend.resulerror');

 }


}
}
// public function studentresult(Request $request){
//   // return($request);
//   $stu_roll = $request->roll;
//   $reg = $request->reg;
//   $years = $request->year;

//   $stu_id = Student::where('roll', '=', $stu_roll)->value('id');
//   $stu_reg = Student::where('registration_no', '=', $reg)->value('registration_no');
//   $stu_year = StudentResult::where('years', '=', $years)->value('years');
//   $stu_yea = StudentResult::where('years', '=', $years)->value('student_id');
//   $class_id = StudentResult::where('years', '=', $years)->value('class_id');
//    if($stu_year==$years){
//   $CourseInfo = DB::table('student_sessions')
//     ->where('class_name', '=', $class_id)
//     ->join('student_results', 'student_sessions.class_name', '=', 'student_results.class_id')
//     ->select('student_sessions.*', 'student_results.*')
//     ->first();
// // //  $DepartName = Session::get('depart_name');
// $studentSession = StudentSession::where('stu_id', $stu_yea )->where('class_name', $class_id )->first();
// $studentInfos = Student::where('id', $studentSession->stu_id)->first();
                    
// $CourseInfo = DB::table('student_sessions')
//                   ->where('stu_id', $studentSession->stu_id)
//                   ->where('class_name','=', $studentSession->class_name)
//                   ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
//                   ->select('student_sessions.*', 'course_names.*')
//                   ->get();
// $Courselist = DB::table('student_sessions')
//                   ->where('stu_id', $studentSession->stu_id)
//                   ->where('class_name','=', $studentSession->class_name)
//                   ->join('course_names', 'student_sessions.class_name', '=', 'course_names.class_id')
//                   ->select('student_sessions.*', 'course_names.*')
//                   ->first();

// $ExamYear = DB::table('student_results')
//                   ->where('student_id', $Courselist->stu_id)
//                   ->where('subject', $Courselist->id)
//                   ->first();

// $ExamClassName = DB::table('studen_classes')
//                   ->where('depart_id', $ExamYear->depart_id)
//                   ->where('id', $ExamYear->class_id)
//                   ->first();
// return view('backend.mark_sheet_download_fontend', compact('studentInfos','CourseInfo','ExamYear','ExamClassName'));
// }
    
// else{
//         return view('frontend.resulerror');
    
//        }
   
  
//       }
//     }

// public function studentresult(Request $request){
//   // return($request);
//   $stu_roll = $request->roll;
//   $reg = $request->reg;
//   $years = $request->year;

//    $stu_id = Student::where('roll', '=', $stu_roll)->value('id');
//    $stu_rol = Student::where('roll', '=', $stu_roll)->value('roll');
//    $stu_reg = Student::where('registration_no', '=', $reg)->value('registration_no');
//    $stu_year = StudentResult::where('years', '=', $years)->value('years');
 
//    if($stu_roll==$stu_rol && $stu_reg==$reg && $stu_year==$years){
//      // return($stu_id);
//        // $studentResult = StudentResult::where('student_id', '=', $stu_id)->where('years', '=', $years)->get();
//        // return $marks=sum($studentResult->marks);
//        $studentInfos = Student::where('id', $stu_id)->first();
//        $studentyears = StudentResult::where('id', $stu_id)->orwhere('years', $stu_year)->first();
//        $studentResult = StudentResult::where('student_id', $stu_id)
//                                         ->join('course_names', 'student_results.subject', '=', 'course_names.id')
//                                         ->select('student_results.*','course_names.name','course_names.course_code')
//                                         ->get();
                      
//               // dd($studentResult);
//         return view('backend.mark_sheet_download', compact('studentInfos','studentResult','studentyears'));
//        // return view('frontend.resultlogin');

//    }else{
//     return view('frontend.resulerror');

//    }
  
// }



