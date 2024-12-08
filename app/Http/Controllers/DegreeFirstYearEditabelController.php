<?php

namespace App\Http\Controllers;
use App\Models\DegreeFirstYearStudent;
use App\Models\DegreeClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DegreeFirstYearEditabelController extends Controller
{
    public function degreeEditData( $session )
    {  
        $studentEditData = DegreeFirstYearStudent::where('session', '=', $session)->where('studentclass',1)->orderBy('session', 'desc')->get();
        $session = DegreeFirstYearStudent::select('session')->where('studentclass', 2)->orderBy('session', 'desc')->distinct()->get();
        $studentclass = DegreeClass::where('id',1)->orderby('id','asc')->get();
    
        return view('backend.degree_firstyear_editabel', compact('studentEditData','session','studentclass'));
    }
   
    function DegreeEditDataAction(Request $request)
 
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
    			DB::table('degree_first_year_students')
    				->where('id', $request->id)
    				->update($data);
    		}
    		if($request->action == 'delete')
    		{
    			DB::table('degree_first_year_students')
    				->where('id', $request->id)
    				->delete();
    		}
    		return response()->json($request);
    	}
    
}
}

