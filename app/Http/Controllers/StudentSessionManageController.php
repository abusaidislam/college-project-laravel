<?php

namespace App\Http\Controllers;

use App\Models\StudentSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use App\Models\StudenClass;


class StudentSessionManageController extends Controller
{
    public function index()
   {   $depart_id = Session::get('depart_id');
       $depart_name = Session::get('depart_name');
       $data = StudentSession::where('depart_id', '=', $depart_id)->get();
       $studentclass = StudenClass::all();
       $depart_value = Department::all();
      
      Session::put('depart_id', $depart_id);
      Session::put('depart_name', $depart_name);
       return view('backend.student_session_manage', compact('data','depart_value','studentclass'));
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
   {  $depart_id = $request->depart_id;
      $depart_name = Session::get('depart_name');
      



        StudenClass::updateOrCreate([
           'id' => $request->id ],
       [
           
           'name' => $request->name,
           
            'depart_id' => $request->depart_id,
          
            'department' => $depart_name,
            
          
           
       ]);

      Session::put('depart_id', $depart_id);
      Session::put('depart_name', $depart_name);
       if($request->id!=0){
           return redirect('department-class')->with('massage', 'Updated successfully!!!');

       }
   else{
       return redirect('department-class')->with('massage', 'Inserted successfully!!!');
   }
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
        $data = StudenClass::find($id);
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
       StudenClass::find($id)->delete();

       return response()->json(['success'=>' Successfully deleted .']);
   }
}
