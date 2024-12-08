<?php

namespace App\Http\Controllers;

use App\Models\Headofdepartment;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Teacher;

use App\Models\DepartHistory;
use App\Models\Departmentmanage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class HeadofdepartmentController extends Controller
{


        public function index()
    {        
        $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $depart_value = DB::table('departments')
            ->where('id', '=', $depart_id)->get();
        $data = DB::table('headofdepartments')
            ->where('depart_id', '=', $depart_id)->get();

        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        
        return view('department.headofdepartment', compact('data','depart_value'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');
        $fileName = '';
        $emp = Headofdepartment::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('Dhead/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('Dhead/' . $emp->photo);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->photo??"0";
        }
        

        Headofdepartment::updateOrCreate([
            'id' => $request->id
        ], [
            'name' => $request->name,
            'depart_id' => $depart_id,
            'designation' => $request->designation,
            'message' => $request->message,
            'photo' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('headofdepartment')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('headofdepartment')->with('message', 'Inserted successfully!!!');
        }
        }

  
    public function edit($id)
    {
         $data = Headofdepartment::find($id);
        return response()->json($data);
    }

    public function destroy(Headofdepartment $headofdepartment)
    {
        Headofdepartment::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
