<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
class StaffController extends Controller

   {
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $data = Staff::where('depart_id', '=', $depart_id)->get();
        $depart_value = Department::all();
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.staffs', compact('data','depart_value'));
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
            $emp = Staff::find($request->id);
    
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('Staff/'), $fileName);
    
                if ($request->id > 0) {
                    $imagePath = public_path('Staff/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
    
            Staff::updateOrCreate([
                'id' => $request->id
            ], [
                'serial_num' => $request->serial_num,
                'name' => $request->name,
                'email' => $request->email,
                'depart_id' => $request->depart_id,
                'designation' => $request->designation,
                'department' => $depart_name,
                'mobile_no' => $request->mobile_no,
                'home_dis' => $request->home_dis,
                'photo' => $fileName,
                'status' => $request->status,
            ]);
            Session::put('depart_id', $depart_id);
            Session::put('depart_name', $depart_name);
            if ($request->id != 0) {
                return redirect('department_staff')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('department_staff')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('department_staff')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = Staff::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = Staff::find($id);
    
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
    
        $imagePath = public_path('Staff/' . $data->photo);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    
        $data->delete();
    
        return response()->json(['success' => 'Successfully deleted.']);
    }
}
