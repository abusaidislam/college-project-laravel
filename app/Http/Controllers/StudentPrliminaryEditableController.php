<?php

namespace App\Http\Controllers;
use App\Models\StudentPreliminaryToMasters;
use App\Models\StudentMastersFinal;
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

class StudentPrliminaryEditableController extends Controller
{
    public function PreliminaryEditData( $session )
    {  
        $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $studentEditData = StudentPreliminaryToMasters::where('session', '=', $session)->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->where('studentclass',5)->orderBy('session', 'desc')->get();
        $session = StudentPreliminaryToMasters::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 2)->where('id',5)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentPreliminary_editable', compact('studentEditData','session','depart_value','studentclass'));
    }
    public function MastersEditData( $session )
    {  
        $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $studentEditData = StudentMastersFinal::where('session', '=', $session)->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->where('studentclass',6)->orderBy('session', 'desc')->get();
        $session = StudentMastersFinal::select('session')->where('depart_id', '=', $depart_id)->where('class_typeof', 2)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = StudenClass::where('type_of', 2)->where('id',6)->orderby('id','asc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentMasters_editable', compact('studentEditData','session','depart_value','studentclass'));
    }

    
    function MastersEditDataAction(Request $request)
 
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
    			DB::table('student_masters_finals')
    				->where('id', $request->id)
    				->update($data);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('student_masters_finals')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
    
}
}

