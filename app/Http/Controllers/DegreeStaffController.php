<?php

namespace App\Http\Controllers;

use App\Models\DegreeStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DegreeStaffController extends Controller
{
    public function index()
    {
        $data = DegreeStaff::orderBy('id', 'asc')->get();
        return view('backend.degree_staffs', compact('data'));
    }
public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        try {
            $fileName = '';
            $emp = DegreeStaff::find($request->id);
    
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
    
            DegreeStaff::updateOrCreate([
                'id' => $request->id
            ], [
                'serial_num' => $request->serial_num,
                'name' => $request->name,
                'email' => $request->email,
                'designation' => $request->designation,
                'mobile_no' => $request->mobile_no,
                'home_dis' => $request->home_dis,
                'photo' => $fileName,
                'status' => $request->status,
            ]);
    
            if ($request->id != 0) {
                return redirect('degree_staff')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree_staff')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree_staff')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = DegreeStaff::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = DegreeStaff::find($id);
    
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
