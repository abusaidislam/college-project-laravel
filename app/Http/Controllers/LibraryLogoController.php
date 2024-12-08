<?php

namespace App\Http\Controllers;

use App\Models\LibraryLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LibraryLogoController extends Controller
{
    public function index()
    {
       $data = LibraryLogo::where('id',3)->orderBy('id', 'desc')->get();
        return view('backend.library_logo_sign', compact('data'));
    }

    public function store(Request $request)
    {
        
    $request->validate([
        'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        'signature' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=300,max_height=80',
    ]);
    
        try {
            $fileName = '';
            $fileName2 = '';
            $emp = LibraryLogo::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('library_card/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library_card/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
            if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
                $fileName2 = time() . '.' . $request->signature->getClientOriginalExtension();
                $request->signature->move(public_path('library_card/'), $fileName2);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library_card/' . $emp->signature);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName2 = $emp->signature??"0";
            }
            
    
            LibraryLogo::updateOrCreate([
                'id' => $request->id
            ], [
                'photo' => $fileName,
                'signature' => $fileName2,
            ]);
          
            if ($request->id != 0) {
                return redirect('library_signature')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('library_signature')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('library_signature')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
   
    public function edit($id)
    {
         $data = LibraryLogo::find($id);
        return response()->json($data);
    }


   
}