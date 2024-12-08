<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelHeadContact;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class HostelHeadContactController extends Controller
{
 
    public function index()
    {
        $hostel_id = Auth::id(); 
        $department = Department::orderBy('id', 'asc')->get();
        $genarelDepart = User::where('id', 17)->first();
        $hostelName = User::where('id','=',$hostel_id)->orderBy('id', 'asc')->get();
        $data = HostelHeadContact::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        return view('backend.hostel_head_contact', compact('data','department','hostelName','genarelDepart'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
        try {
            $fileName = '';
            $emp = HostelHeadContact::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('hostel_card/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('hostel_card/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo ?? "0";
            }
            
            $hostel_id = Auth::id(); 
            HostelHeadContact::updateOrCreate([
                'id' => $request->id
            ], [
                'dept_name' => $request->dept_name,
                'hostel_name' => $request->hostel_name,
                'title' => $request->title,
                'designation' => $request->designation,
                'mobile' => $request->mobile,
                'hostel_id' => $hostel_id,
                'photo' => $fileName,
            ]);
          
            if ($request->id != 0) {
                return redirect('hostel-head-info')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('hostel-head-info')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('hostel-head-info')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = HostelHeadContact::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = HostelHeadContact::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('hostel_card/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}

}
