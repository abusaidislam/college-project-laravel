<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\StudentSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentInfoImport;
use App\Imports\StudentHonoursSecountYearImport;
use Illuminate\Validation\Rule;
use import;

class StudentHonoursFirstYearEditableController extends Controller
{
    public function EditData( $session )
    {  
        $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $studentEditData = Student::where('session', '=', $session)->where('depart_id', '=', $depart_id)->where('class_typeof', 1)->where('studentclass',1)->orderBy('session', 'desc')->get();
        $session = Student::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 1)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 1)->where('id',1)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.studentFirstYear_editable', compact('studentEditData','session','depart_value','studentclass'));
    }

    
    function EditDataAction(Request $request)
 
    {
    	if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
    			$data = array(
    				'name'	=>	$request->name,
    				'roll'		=>	$request->roll,
    				'registration_no'		=>	$request->registration_no
    			);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('students')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
    
}
}

