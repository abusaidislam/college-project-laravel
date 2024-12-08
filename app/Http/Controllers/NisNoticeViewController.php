<?php

namespace App\Http\Controllers;
use App\Models\NisNotice;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class NisNoticeViewController extends Controller
{  public function index()
    {
        $data =NisNotice::orderBy('id', 'desc')->get();
        return view('backend.nis_notice', compact('data'));
    }
    
    
    public function store(Request $request)
    {
        $fileName = '';
        $emp = NisNotice::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('nisnotice/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('nisnotice/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }
    
        NisNotice::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('nis-notice')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('nis-notice')->with('message', 'Inserted successfully!!!');
        } 

    }
    
   
    public function edit($id)
    {
       $data =NisNotice::find($id);
        return response()->json($data);
    }
    
    
    public function destroy($id)
    {
        $data = NisNotice::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('nisnotice/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
    }