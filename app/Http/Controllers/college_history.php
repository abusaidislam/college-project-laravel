<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class college_history extends Controller
{

    public function index()
    {
        $depart_id = Session::get('depart_id');
        $ndata = DepartHistory::where('depart_id',$depart_id)->first();        
        return view('backend.collegehistory', compact('ndata'));
    }

    public function store(Request $request)
    {
   
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:800|dimensions:max_width=700,max_height=600',
        ]);
        $fileName = '';
        $emp = DepartHistory::find($request->id);
        
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
        

        DepartHistory::updateOrCreate([
            'id' => $request->id
        ], [
            'history_title' => $request->title,
            'history_details' => $request->description,
            'history_images' => $fileName,
        ]);
    
        if ($request->id != 0) {
            return redirect('department_history')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('department_history')->with('message', 'Inserted successfully!!!');
        }

  
    }

    public function edit($id)
    {
       
       $data = DepartHistory::find($id);

      
        return response()->json($data);
    }

 
  

}
