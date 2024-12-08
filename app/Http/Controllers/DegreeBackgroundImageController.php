<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\DegreeBackgroundImage;

class DegreeBackgroundImageController extends Controller
{
    public function index()
    {
        $ndata =DegreeBackgroundImage::orderBy('title','asc')->first();
        return view('backend.degree_bg_image', compact('ndata'));
    }
public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024|dimensions:max_width=1000,max_height=500',
        ]);
        // try {
        $fileName = '';
        $emp = DegreeBackgroundImage::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('department/images/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('department/images/' . $emp->image);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->image??"0";
        }
        

        DegreeBackgroundImage::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->title,
            'image' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('degree_background_image')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree_background_image')->with('message', 'Inserted successfully!!!');
        }
            // } catch (\Exception $e) {
        //     return redirect('degree_background_image')->with('error', 'The form was not filled up completely!!!');
    
        // }
    }

    public function edit($id)
    {
        $data = DegreeBackgroundImage::find($id);
        return response()->json($data);
    }

}
