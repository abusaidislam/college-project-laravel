<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
class TeacherController extends Controller

   {
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = Teacher::where('depart_id', '=', $depart_id)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
        $depart_value = Department::all();
       
       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        return view('backend.teacher', compact('data','depart_value'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
            ]);
            $depart_id = $request->depart_id;
            $depart_name = Session::get('depart_name');
            $fileName = '';
            $emp = Teacher::find($request->id);
    
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('teachers/'), $fileName);
    
                if ($request->id > 0) {
                    $imagePath = public_path('teachers/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
    
            Teacher::updateOrCreate([
                'id' => $request->id
            ], [
                'name' => $request->name,
                'email' => $request->email,
                'depart_id' => $request->depart_id,
                'photo' => $fileName,
                'designation' => $request->designation,
                'department' => $depart_name,
                'bcs_batch' => $request->bcs_batch,
                'first_joining' => $request->first_joining,
                'present_joining' => $request->present_joining,
                'date_of_birth' => $request->date_of_birth,
                'rcl_date' => $request->rcl_date,
                'blood_group' => $request->blood_group,
                'mobile_no' => $request->mobile_no,
                'home_dis' => $request->home_dis,
                'status' => $request->status,
            ]);
            Session::put('depart_id', $depart_id);
            Session::put('depart_name', $depart_name);
            if ($request->id != 0) {
                return redirect('department-teacher')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('department-teacher')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('department-teacher')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = Teacher::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = Teacher::find($id);
    
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
    
        $imagePath = public_path('teachers/' . $data->photo);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    
        $data->delete();
    
        return response()->json(['success' => 'Successfully deleted.']);
    }
    
    public function teacherHonourBoard()
    {   

        $depart_id = Session::get('depart_id');
        $data = Teacher::where('depart_id', '=', $depart_id)->where('status',1)->orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
        return view('backend.teacher_honour_board',compact('data'));
    }

}
