<?php

namespace App\Http\Controllers;

use App\Models\Basic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\marks;
use App\Models\CourseName;
use App\Models\DegreeFirstYearStudent;
use App\Models\DegreeSecoundYearStudent;
use App\Models\DegreeThirdYearStudent;
use App\Models\DegreeFourthYearStudent;
use PDF;

class DegreeMeritListController extends Controller
{
    
    public function DegreeMeritexportToPDF(Request $request)
    {
       $class = $request->classId;
        $Session = $request->Session;
        
       $data = DegreeFirstYearStudent::where('studentclass', $class)
            ->where('session', $Session)
            ->get();
       
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        
        $pdf = PDF::loadView('backend.degree_merit_list_pdf', ['data' => $data,'class' => $class]);
        return $pdf->stream('document.pdf');
    }
    public function DegreeSecoundMeritexportToPDF(Request $request)
    {
        // return($request->all());
        $class = $request->classId;
        $Session = $request->Session;
        
       $data = DegreeSecoundYearStudent::where('class_id', $class)
            ->where('session_year', $Session)
            ->get();
       
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        
        $pdf = PDF::loadView('backend.degree_secoundyear_merit_pdf', ['data' => $data,'class' => $class]);
        return $pdf->stream('document.pdf');
    }
    public function DegreeThirdMeritexportToPDF(Request $request)
    {
        $class = $request->classId;
        $Session = $request->Session;
        
       $data = DegreeThirdYearStudent::where('class_id', $class)
            ->where('session_year', $Session)
            ->get();
       
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        
        $pdf = PDF::loadView('backend.degree_thirdyear_merit_pdf', ['data' => $data,'class' => $class]);
        return $pdf->stream('document.pdf');
    }
    public function DegreeFourthMeritexportToPDF(Request $request)
    {
        $class = $request->classId;
        $Session = $request->Session;
        
       $data = DegreeFourthYearStudent::where('class_id', $class)
            ->where('session_year', $Session)
            ->get();
       
        if ($data->isEmpty()) {
            return view('backend.show_incourse_error');
        }
        
        $pdf = PDF::loadView('backend.degree_fourthyear_merit_pdf', ['data' => $data]);
        return $pdf->stream('document.pdf');
    }
}
