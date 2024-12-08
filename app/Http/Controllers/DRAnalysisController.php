<?php
namespace App\Http\Controllers;
use App\Models\DRAnalysis;
// use App\Models\UsersImport;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use import;

class DRAnalysisController extends Controller
{
    public function index()
    {
        $data = DRAnalysis::orderBy('id', 'desc')->get();
        return view('backend.dr_analysis', compact('data'));
    }
    public function import(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new UsersImport,request()->file('file'));  
   
       return redirect('dranalysis')->with('message', 'Inserted successfully!!!');
       
    }


    public function destroy($id)
    {
        DRAnalysis::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
    public function deleteData(Request $request)
    {
        $examName = $request->input('exam_name');
        $CollegeName = $request->input('college_name');
    
        DRAnalysis::where('examname_year','=', $examName)
            ->where('collegecode_name','=', $CollegeName)
            ->delete();
    
        return redirect('dranalysis')->with('message', 'Deleted successfully!!!');
    }
}
