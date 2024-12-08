<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudentResult;
use App\Models\StudentMastersFinal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudenClass;
use App\Models\StudentSession;
use App\Models\marks;
use App\Models\CourseName;
use App\Models\StudentMeritList;
use PDF;

class StudentMeritListMastersFinalController extends Controller
{
    public function index()
    {
        $depart_id    = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');

        $classname    = StudenClass::all();
        $CourseName   = CourseName::where('depart_id', '=', $depart_id)->orderby('id','asc')->first();
        $Course   = CourseName::where('depart_id', '=', $depart_id)->where('class_id', 6)->orderby('name','asc')->get();
        
        $studentclass = StudenClass::where('id', '=',6)->first();
        $StudentMeritList = StudentMeritList::where('depart_id', '=', $depart_id)->where('class_id',$studentclass->id)->orderby('merit_marks','desc')->get();;
        $studentsession = StudentMastersFinal::select('session')->where('studentclass', $studentclass->id)->distinct()->get();

        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentmeritlistmastersfinal', compact('depart_id','StudentMeritList','Course','depart_name','CourseName','classname','studentclass','studentsession'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return ($request->all());
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');
        $name = $request->name;
        $year = $request->year;
        $student_id = $request->sid;
        $atten_marks = $request->marks;
        $classId = $request->classId;
        $class_year = $request->student_class_year;
      
        $dataInserts = [];
        for ($i = 0; $i < count($atten_marks); $i++) {

            $total_result = DB::table('student_results')
            ->where('student_id', $student_id[$i])
            ->where('class_id', $classId)
            ->where('depart_id', $depart_id)
            ->where('student_class_year', $class_year)
            ->sum('marks');

            $dataInserts[] = [
                'student_id' => $student_id[$i],
                'depart_id' => $depart_id,
                'atten_mark' => 0.20 * $atten_marks[$i],
                'name' => $name[$i],
                'class_id' => $classId, 
                'year' => $year, 
                'total_result' => $total_result, 
                'merit_marks' =>$total_result + 0.20 * $atten_marks[$i], 
                'student_class_year' => $class_year, 
            ];
        }
        // merit_marks
        foreach ($dataInserts as $dataInsert) {
      
            StudentMeritList::updateOrCreate(
                [
                    'student_id' => $dataInsert['student_id'],
                    'class_id' => $dataInsert['class_id']
                ],
                $dataInsert
            );
        
        }
      
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
         
         return redirect('masters-final-merit-list')->with('massage', 'Inserted successfully!!!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
     public function StudentMasterfinalmerit(Request $request){
        $userid         = $request->userid;
        $data = explode('/', $userid);  
        $class_id = $data[0]; 
        $class_year = $data[1]; 
        $depart_id    = Session::get('depart_id');
        $Students =DB::table('student_masters_finals')
                            ->where('depart_id', $depart_id)
                            ->where('studentclass', $class_id)
                            ->where('session', $class_year)
                            ->orderBy('register_roll','asc')
                            ->get();
        $trList           = [];
        foreach ($Students as $value) {
          $trList[] = '<tr>
          <td align="center">'. $value->id .'</td>
          <td align="center">
           <input type="text" class="form-control" id="name" name="name[]" readonly  value="'. $value->name .'" required="">
           </td> 
           <input type="hidden" name="sid[]" value="'. $value->id .'" >
           <td align="center">
           <input type="text" class="form-control" id="marks" name="marks[]" placeholder="Enter Atten. Day " value="" required="">
           
          </tr>';         
        }
      
        return $trList;
     }

    public function MasterfinalMeritexportToPDF(Request $request)
     {
         $class = $request->classId;
         $session = $request->session;
         $depart_id = Session::get('depart_id');
         
         $data = StudentMeritList::where('depart_id', $depart_id)
             ->where('class_id', $class)
             ->where('student_class_year', $session)
             ->orderBy('merit_marks','desc')
             ->get();
         
         if ($data->isEmpty()) {
             return view('backend.show_incourse_error');
         }
         
         $pdf = PDF::loadView('backend.studentmeritlistmastersfinal_pdf', ['data' => $data, 'depart_id' => $depart_id]);
         return $pdf->stream('document.pdf');
     }
}
