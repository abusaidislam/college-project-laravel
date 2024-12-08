<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartHistory;
use App\Models\VisionMission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        $data = Department::orderBy('code', 'asc')->get();
        
        $faculties = Faculty::orderBy('name', 'asc')->get();
        return view('backend.department-entry', compact('data', 'faculties'));
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
        $last_department_id = Department::max('id') + 1;
        
        DepartHistory::updateOrCreate([
            'id' => $request->id ],
        [
          'depart_id' => $last_department_id,
            'history_title' => $request->name,
            'history_images' => 'department/images/default.jpg',
            'history_details' => 'Thanks for visiting our department. We will update soon',
        ]);

        VisionMission::updateOrCreate([
            'id' => $request->id ],
        [
           'depart_id' => $last_department_id,
            'vision_title' => $request->name,
            'vision_images' => 'department/images/default.jpg',
            'vision_details' => 'Thanks for visiting our department. We will update soon',
        ]);

        Department::updateOrCreate([
            'id' => $request->id ],
        [
          'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'text_password' => $request->password,
            'faculty' => $request->faculty,
        ]);     
        
        return redirect('department-entry')->with('message', 'Data Insert Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Department::find($id);
          return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         Department::update([
              'id' => $request->id,
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'faculty' => $request->faculty,
        ]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
