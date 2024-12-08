<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DegreeHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DegreeHistroyController extends Controller
{
    public function index()
    {
        $ndata = DegreeHistory::orderBy('history_title','asc')->first();        
        return view('backend.degree_histroy', compact('ndata'));
    }
public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=700,max_height=600',
        ]);
        $fileName = '';
        $emp = DegreeHistory::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('department/images/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('department/images/' . $emp->history_images);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->history_images??"0";
        }
        

        DegreeHistory::updateOrCreate([
            'id' => $request->id
        ], [
            'history_title' => $request->title,
            'history_details' => $request->description,
            'history_images' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('degree_history')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree_history')->with('message', 'Inserted successfully!!!');
        }
        }

  
    public function edit($id)
    {
       
       $data = DegreeHistory::find($id);
        return response()->json($data);
    }

 
  

}
