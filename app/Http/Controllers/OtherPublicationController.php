<?php

namespace App\Http\Controllers;
use App\Models\OtherPublication;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class OtherPublicationController extends Controller
{ public function index()
    {
        $data =OtherPublication::orderBy('id', 'desc')->get();
        return view('backend.other_publication', compact('data'));
    }
    
    
    public function store(Request $request)
    {
        $fileName = '';
        $emp = OtherPublication::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('other_publication/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('other_publication/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }

        OtherPublication::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('other-publication')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('other-publication')->with('message', 'Inserted successfully!!!');
        } 

      
    }
    
    public function edit($id)
    {
       $data =OtherPublication::find($id);
        return response()->json($data);
    }
    
    
    public function destroy($id)
    {
        $data = OtherPublication::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('other_publication/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    
    }
    }
    