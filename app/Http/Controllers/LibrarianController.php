<?php

namespace App\Http\Controllers;
use App\Models\Librarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class LibrarianController extends Controller
{
    public function index()
    {
        $data = Librarian::orderBy('id', 'desc')->get();
        return view('backend.llibrain', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
    
        try {
        
            $fileName = '';
            $emp = Librarian::find($request->id);
            
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
                $fileName = $emp->photo  ?? '0';
            }
            
    
            Librarian::updateOrCreate([
                'id' => $request->id
            ], [
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
                return redirect('library_personnel')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('library_personnel')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('library_personnel')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = Librarian::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = Librarian::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('librain/' . $data->photo);
    if (File::exists($imagePath)) {
        unlink($imagePath);
    }
    $data->delete();
    return response()->json();
}

}
