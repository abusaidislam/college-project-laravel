<?php

namespace App\Http\Controllers;
use App\Models\ApaNoc;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ApaNocController extends Controller
{
public function index()
{
    $data =ApaNoc::orderBy('id', 'desc')->get();
    return view('backend.apa_noc', compact('data'));
}

public function store(Request $request)
{
    $fileName = '';
    $emp = ApaNoc::find($request->id);
    
    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('forms/'), $fileName);
    
        if ($request->id > 0) {
            $imagePath = public_path('forms/' . $emp->file);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
        }
    } else {
        $fileName = $emp->file ?? '0';
    }

    ApaNoc::updateOrCreate([
        'id' => $request->id
    ], [
        'title' => $request->name,
        'file' => $fileName, 
    ]);
  
    if ($request->id != 0) {
        return redirect('apa-notice')->with('message', 'Updated successfully!!!');
    } else {
        return redirect('apa-notice')->with('message', 'Inserted successfully!!!');
    } 
}

public function edit($id)
{
   $data =ApaNoc::find($id);
    return response()->json($data);
}

public function destroy($id)
{
    $data = ApaNoc::find($id);
    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }
    $imagePath = public_path('forms/' . $data->file);
    if (File::exists($imagePath)) {
        unlink($imagePath);
    }
    $data->delete();
    return response()->json();
}
}
