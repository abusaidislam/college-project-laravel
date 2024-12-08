<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class HostelApplicationController extends Controller
{

    public function index()
    {
        $hostel_id = Auth::id(); 
        $hostelName = User::where('id','=',$hostel_id)->orderBy('id', 'asc')->get();
        $data = HostelApplication::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        return view('backend.hostel_appli_and_rules', compact('data','hostelName'));
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        // ]);
        try {
            $fileName = '';
            $emp = HostelApplication::find($request->id);
            
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
                $fileName = $emp->photo??"0";
            }
            
            $hostel_id = Auth::id(); 
            HostelApplication::updateOrCreate([
                'id' => $request->id
            ], [
                'hostel_id' => $request->hostel_name,
                'type' => $request->type,
                'title' => $request->title,
                'photo' => $fileName,
            ]);
          
            if ($request->id != 0) {
                return redirect('hostel-application-rules')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('hostel-application-rules')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('hostel-application-rules')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = HostelApplication::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = HostelApplication::find($id);

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
