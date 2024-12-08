<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HostelGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HostelGalleryController extends Controller
{

    public function index()
    {
        $hostel_id = Auth::id(); 
        $hostelName = User::where('id','=',$hostel_id)->orderBy('id', 'asc')->get();
        $data = HostelGallery::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();

        return view('backend.hostel_galler', compact('data','hostelName'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=1200,max_height=1000',
        ]);
        try {
            $fileName = '';
            $emp = HostelGallery::find($request->id);
            
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
            HostelGallery::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'photo' => $fileName,
                'hostel_id' => $hostel_id,
            ]);
          
            if ($request->id != 0) {
                return redirect('hostel-gallery')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('hostel-gallery')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('hostel-gallery')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = HostelGallery::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = HostelGallery::find($id);

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
