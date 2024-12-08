<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LibraryGallery;
use Illuminate\Support\Facades\File;
class LibraryGalleryController extends Controller
{
    public function index()
    {
        $data = LibraryGallery::orderBy('id', 'desc')->get();
        return view('backend.library_gallery', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=1200,max_height=1000',
        ]);
        try {
            $fileName = '';
            $emp = LibraryGallery::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('library/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo ?? "0";
            }
            
    
            LibraryGallery::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'photo' => $fileName,
            ]);
          
            if ($request->id != 0) {
                return redirect('library_gallery')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('library_gallery')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('library_gallery')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = LibraryGallery::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = LibraryGallery::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('library/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}
}
  