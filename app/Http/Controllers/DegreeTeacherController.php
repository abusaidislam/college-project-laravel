<?php

namespace App\Http\Controllers;

use App\Models\DegreeTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DegreeTeacherController extends Controller
{
    public function index()
    {   
    $datas = DegreeTeacher::orderBy('designation', 'asc')->orderBy('bcs_batch','asc')->orderBy('date_of_birth','asc')->get();
        return view('backend.degree_teacher',compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        try {
            $fileName = '';
            $emp = DegreeTeacher::find($request->id);
    
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
    
            DegreeTeacher::updateOrCreate([
                'id' => $request->id
            ], [
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $fileName,
                'designation' => $request->designation,
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
    
            if ($request->id != 0) {
                return redirect('degree-teacher')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree-teacher')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree-teacher')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = DegreeTeacher::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = DegreeTeacher::find($id);
    
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
    }
    

