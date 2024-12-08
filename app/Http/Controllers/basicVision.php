<?php

namespace App\Http\Controllers;
use App\Models\VisionMission;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class basicVision extends Controller
{
   
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $ndata = VisionMission::where('depart_id',$depart_id)->first();        
        // $ndata = VisionMission::find(1);
        return view('backend.collegevision', compact('ndata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=700,max_height=600',
        ]);
        $fileName = '';
        $emp = VisionMission::find($request->id);
        
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
        

        VisionMission::updateOrCreate([
            'id' => $request->id
        ], [
            'vision_title' => $request->title,
            'vision_details' => $request->description,
            'vision_images' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('mission-vision')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('mission-vision')->with('message', 'Inserted successfully!!!');
        }
        }

 
    public function edit($id)
    {
         $data = VisionMission::find($id);
        return response()->json($data);
    }
  
}
