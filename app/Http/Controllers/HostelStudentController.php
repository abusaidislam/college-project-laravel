<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelStudent;
use App\Models\Basic;
use App\Models\Instrucion;
use Illuminate\Support\Facades\Auth;
use PDF;
class HostelStudentController extends Controller
{
    public function index()
    {
        $hostel_id = Auth::id(); 
        $hostelStudent = HostelStudent::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();

        return view('backend.hostel_student_list', compact('hostelStudent'));
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
        //
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
    
    public function studentreceipt($id)
    {  
        $basic = Basic::find(1); 
        $ndata = HostelStudent::find($id);
        $data = Instrucion::all();
        return view('backend.hostel_student_receipt', compact('basic','ndata','data' ));
    }

    public function hostelStudentReceipt($id)
    {    
        
        $basic = Basic::find(1); 
        $ndata = HostelStudent::find($id);
        $data = Instrucion::all();
        // $pdf = PDF::loadView('backend.hoste', compact('basic','ndata','data'));
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Kalpurush'])->loadView('backend.hoste', compact('basic','ndata','data'));

        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('hostelstudentrec.pdf');
    }
    public function hostelStudentList()
    {    
        $hostel_id = Auth::id(); 
        $hostelStudent = HostelStudent::where('hostel_id', '=',$hostel_id)->orderBy('id', 'asc')->get();

        $pdf = PDF::loadView('backend.hostel_student_list_pdf', compact('hostelStudent'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('hostelstudentlist.pdf');
    }
}
