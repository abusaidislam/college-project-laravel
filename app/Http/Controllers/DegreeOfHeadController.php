<?php

namespace App\Http\Controllers;


use App\Models\Headofdepartment;
use Illuminate\Http\Request;
use App\Models\DegreeOfHead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DegreeOfHeadController extends Controller
{
   
    public function index()
    {        
        $ndata = DegreeOfHead::orderBy('name','asc')->first(); 
        return view('backend.degree_of_head', compact('ndata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
            'signature' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=300,max_height=80',
        ]);
        
            // try {
                $fileName = '';
                $fileName2 = '';
                $emp = DegreeOfHead::find($request->id);
                
                if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                    $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('Dhead/'), $fileName);
                
                    if ($request->id > 0) {
                        $imagePath = public_path('Dhead/' . $emp->photo);
                        if (File::exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                } else {
                    $fileName = $emp->photo??"0";
                }
                if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
                    $fileName2 = time() . '.' . $request->signature->getClientOriginalExtension();
                    $request->signature->move(public_path('Dhead/'), $fileName2);
                
                    if ($request->id > 0) {
                        $imagePath = public_path('Dhead/' . $emp->signature);
                        if (File::exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                } else {
                    $fileName2 = $emp->signature??"0";
                }
                

        // $request->validate([
        //     'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        // ]);
        // $fileName = '';
        // $emp = DegreeOfHead::find($request->id);
        
        // if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        //     $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
        //     $request->photo->move(public_path('Dhead/'), $fileName);
        
        //     if ($request->id > 0) {
        //         $imagePath = public_path('Dhead/' . $emp->photo);
        //         if (File::exists($imagePath)) {
        //             unlink($imagePath);
        //         }
        //     }
        // } else {
        //     $fileName = $emp->photo;
        // }
        

        DegreeOfHead::updateOrCreate([
            'id' => $request->id
        ], [
            'name' => $request->name,
            'designation' => $request->designation,
            'message' => $request->message,
            'photo' => $fileName,
            'signature' => $fileName2,
        ]);
    
        if ($request->id != 0) {
            return redirect('degree-headofdepartment')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree-headofdepartment')->with('message', 'Inserted successfully!!!');
        }
        }

  
    public function edit($id)
    {
         $data = DegreeOfHead::find($id);
        return response()->json($data);
    }

    
   
}
