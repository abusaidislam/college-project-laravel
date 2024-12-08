<?php

namespace App\Http\Controllers;
use App\Models\goldenJubilee;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class GoldenJubileeController extends Controller
{
    public function index()
    {
        $data =goldenJubilee::orderBy('id', 'desc')->get();
        return view('backend.goldenJubileemanage', compact('data'));
    }

  
    public function store(Request $request)
    {
        try {
        
        $fileName = '';
        $emp = goldenJubilee::find($request->id);
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('goldenJubilee/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('goldenJubilee/' . $emp->image);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->image ?? '0';
        }

        goldenJubilee::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'description' => $request->description,
            'image' => $fileName,
        ]);
      
        if ($request->id != 0) {
            return redirect('goldenJubileemanage')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('goldenJubileemanage')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('goldenJubileemanage')->with('error', 'The form was not filled up completely!!!');

    }
    }

   
    public function edit($id)
    {
       $data =goldenJubilee::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        $data = goldenJubilee::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('goldenJubilee/' . $data->image);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
}
