<?php

namespace App\Http\Controllers;

use App\Models\DegreeFirstYearStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeClass;
use App\Models\LibraryLogo;
use App\Models\DegreeOfHead;
use App\Models\DegreeStudentIdCardNote;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DegreeFirstYearImport;
use Illuminate\Validation\Rule;
use import;

class DegreeFirstYearStudentController extends Controller
{
    public function index()
    {  
        $studentclass = DegreeClass::where('id',1)->orderBy('id','asc')->get();
        $data = DegreeFirstYearStudent::where('studentclass',1)->orderBy('session', 'desc')->get();
        $session = DegreeFirstYearStudent::select('session')->where('studentclass', 1)->orderBy('session', 'desc')->distinct()->get();

        return view('backend.degreefirstyearstudent', compact('data','studentclass','session'));
    }
    public function degreeFirstYearImport(Request $request) 
    {
        ($request->all());
        $this->validate($request,[
            'file'=> 'required|mimes:xlsx,csv'
        ]);
     Excel::import(new DegreeFirstYearImport,request()->file('file'));
    
       return redirect('degree-first-year-sudetnts')->with('massage', 'Inserted successfully!!!');
       
    }


public function store(Request $request)
{
    
    $validated = $request->validate([
        'name' => 'required',
        'father_name' => 'required',
        'mather_name' => 'required',
        'father_mobile' => 'required',
        'email' => 'required|email',
        'studentclass' => 'required',
        'register_roll' => 'required',
        'session' => 'required',
        'registration_no' => [
            'required',
            Rule::unique('students')->ignore($request->id), // Ignore the current record
            'max:200',
        ],
        'mobile_no' => 'required',
        'blood_group' => 'required',
        'home_dis' => 'required',
    
    ]);
    if ($request->hasFile('photo')) {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
    }

      

   $fileName = '';
   $emp = DegreeFirstYearStudent::find($request->id);
   if ($request->hasFile('photo')) {
    $request->validate([
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
    ]);


    $fileName = '';
    $emp = DegreeFirstYearStudent::find($request->id);
    if ($request->photo) {
        $fileName = time().'.'.$request->photo->getClientOriginalExtension();

        $request->photo->move(public_path('student/'), $fileName);

        if ($request->id > 0) {
            $imagePath = public_path('student/' . $emp->photo);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
        }
    } else {
        $fileName = $emp->photo??"0";
    }

    }

    $student = DegreeFirstYearStudent::updateOrCreate(
        ['id' => $request->id],
        [
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mather_name' => $request->mather_name,
            'father_mobile' => $request->father_mobile,
            'email' => $request->email,
            'photo' => $fileName,
            'studentclass' => $request->studentclass,
            'register_roll' => $request->register_roll,
            'session' => $request->session,
            'roll' => $request->roll,
            'registration_no' => $request->registration_no,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]
    );

    if ($student) {
        if ($request->id != 0) {
            return redirect('degree-first-year-sudetnts')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-first-year-sudetnts')->with('message', 'Inserted successfully!!!');
        }
    } else {
        return redirect('degree-first-year-sudetnts')->with('message', 'Error!!!');
    }
}

    /** 
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
         $data = DegreeFirstYearStudent::find($id);
        return response()->json($data);
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
        DegreeFirstYearStudent::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
    
    public function DegreeFirstCardDetails($id)
    { 
        $basic = LibraryLogo::where('id',5)->first(); 
        $ndata = DegreeFirstYearStudent::find($id);
        $data = DegreeStudentIdCardNote::all();
        return view('backend.degreefirstyearstudent_idcard_single', compact('basic','ndata','data' ));
    }
    
    public function degreeFirstYearIDCard(Request $request)
    {
        
  $studentsession = $request->studentsession;
  
  $ndata = DegreeFirstYearStudent::where('session', $studentsession)->get();
  $basic = LibraryLogo::where('id',5)->first(); 
  $data = DegreeStudentIdCardNote::orderBy('id','asc')->get();
  return view('backend.degreefirstyearstudent_idcard', compact('basic','ndata','data' ));
}

public function degreeFirstYearStudyCertificate($id)
{ 
    $degree = DegreeOfHead::orderBy('name','desc')->first(); 
    $basic = LibraryLogo::where('id',5)->first(); 
    $ndata = DegreeFirstYearStudent::find($id);
    $className = DegreeClass::where('id',$ndata->studentclass)->first();
    $data = DegreeStudentIdCardNote::all();
    return view('backend.degreefirstyear_studycertificate', compact('basic','className','ndata','data','degree' ));
}
   
}
