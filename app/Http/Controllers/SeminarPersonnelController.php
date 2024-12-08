<?php

namespace App\Http\Controllers;

use App\Models\SeminarPersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SeminarPersonnelController extends Controller
{
 
    public function index()
    {  
        $depart_id = Session::get('depart_id');
        $data = SeminarPersonnel::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.seminar_personnel', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
    
        try {
        
            $fileName = '';
            $emp = SeminarPersonnel::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('librain/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('librain/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
            
            $depart_id = Session::get('depart_id');
            SeminarPersonnel::updateOrCreate([
                'id' => $request->id
            ], [
                'depart_id' => $depart_id,
                'serial_num' => $request->serial_num,
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $fileName,
                'designation' => $request->designation,
                'mobile_no' => $request->mobile_no,
                'blood_group' => $request->blood_group,
                'home_dis' => $request->home_dis,
                'first_join' => $request->first_join,
                'present_join' => $request->present_join,
                'date_of_birth' => $request->date_of_birth,
                'rcl_date' => $request->rcl_date,
                'status' => $request->status,
            ]);
          
            if ($request->id != 0) {
                return redirect('seminar-personnel')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('seminar-personnel')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('seminar-personnel')->with('error', 'The form was not filled up completely!!!');
    
        }
    }

    
    public function edit($id)
    {
        $data = SeminarPersonnel::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
{
    $data = SeminarPersonnel::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('librain/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}

    
}
