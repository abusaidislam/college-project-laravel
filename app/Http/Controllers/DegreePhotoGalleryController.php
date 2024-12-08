<?php

namespace App\Http\Controllers;
use App\Models\DegreePhotoGallery;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DegreePhotoGalleryController extends Controller
{
    public function index()
    {  
    $data = DegreePhotoGallery::orderBy('id', 'desc')->get();
        return view('backend.degree_photo_galleries', compact('data'));
    }

    public function store(Request $request)
{
    $request->validate([
        'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=1000,max_height=600',
    ]);
    try {
        $fileName = '';
        $emp = DegreePhotoGallery::find($request->id);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('Photo_gallery/'), $fileName);

            if ($request->id > 0) {
                $imagePath = public_path('Photo_gallery/' . $emp->photo);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->photo??"0";
        }

        DegreePhotoGallery::updateOrCreate([
            'id' => $request->id
        ], [
            'note' => $request->note,
            'photo' => $fileName,
        ]);

        if ($request->id != 0) {
            return redirect('degree_photo_galleries')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree_photo_galleries')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('degree_photo_galleries')->with('error', 'The form was not filled up completely!!!');

    }
}

  public function edit($id)
    {
        $data = DegreePhotoGallery::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = DegreePhotoGallery::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('Photo_gallery/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}
}
