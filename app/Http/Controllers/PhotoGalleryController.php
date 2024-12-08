<?php

namespace App\Http\Controllers;
use App\Models\Photo_Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
     public function index()
    {   $depart_id = Session::get('depart_id');
     $depart_name = Session::get('depart_name');
    Session::put('depart_id', $depart_id);
    Session::put('depart_name', $depart_name);
    $data = Photo_Gallery::where('department_id', $depart_id)->orderBy('id', 'desc')->get();
        return view('backend.photo_galleries', compact('data'));
    }
public function store(Request $request)
{

     $request->validate([
        'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=1000,max_height=600',
    ]);
    try {
        $depart_id = Session::get('depart_id');
       $depart_name = Session::get('depart_name');
    Session::put('depart_id', $depart_id);
    Session::put('depart_name', $depart_name);
        $fileName = '';
        $emp = Photo_Gallery::find($request->id);

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

        Photo_Gallery::updateOrCreate([
            'id' => $request->id
        ], [
            'note' => $request->note,
            'department_id' => $depart_id,
            'photo' => $fileName,
        ]);

        if ($request->id != 0) {
            return redirect('photo_galleries')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('photo_galleries')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('photo_galleries')->with('error', 'The form was not filled up completely!!!');

    }
}

  public function edit($id)
    {
        $data = Photo_Gallery::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = Photo_Gallery::find($id);

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
