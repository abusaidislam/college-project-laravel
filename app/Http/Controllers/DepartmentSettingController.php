<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DepartmentSettingController extends Controller
{

    public function index()
    {
        $depart_id = Session::get('depart_id');
        $data = Department::where('id',$depart_id)->first(); 
        $faculties = Faculty::orderBy('name', 'asc')->get();     
        return view('backend.department_password_setting', compact('data','faculties'));
    }

    public function store(Request $request)
    {
        // return$request->all();
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

      return redirect('department_setting')->with('message', 'Updated successfully!!!');
    

  
    }

    public function edit($id)
    {
       
       $data = Department::find($id);

      
        return response()->json($data);
    }

 
  
}
