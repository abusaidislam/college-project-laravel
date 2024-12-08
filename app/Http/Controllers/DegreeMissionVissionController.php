<?php

namespace App\Http\Controllers;
use App\Models\DegreeMissionVision;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DegreeMissionVissionController extends Controller
{
    public function index()
    {
        $ndata = DegreeMissionVision::orderBy('vision_title','asc')->first();        
        return view('backend.degree_mission_vission', compact('ndata'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=700,max_height=600',
        ]);
        $fileName = '';
        $emp = DegreeMissionVision::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('department/images/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('department/images/' . $emp->vision_images);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->vision_images??"0";
        }
        

        DegreeMissionVision::updateOrCreate([
            'id' => $request->id
        ], [
            'vision_title' => $request->title,
            'vision_details' => $request->description,
            'vision_images' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('degree-mission-vision')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-mission-vision')->with('message', 'Inserted successfully!!!');
        }
        }

 
    public function edit($id)
    {
         $data = DegreeMissionVision::find($id);
        return response()->json($data);
    }


}
