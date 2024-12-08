<?php

namespace App\Http\Controllers;
use App\Models\InnovativeNotice;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class InnovativeNoticeViewController extends Controller
{
    public function index()
    {
        $data =InnovativeNotice::orderBy('id', 'desc')->get();
        return view('backend.innovative_notice', compact('data'));
    }
    
   
    public function store(Request $request)
    {
        $fileName = '';
        $emp = InnovativeNotice::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('innovativenotice/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('innovativenotice/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }
    
        InnovativeNotice::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('innovative-notice')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('innovative-notice')->with('message', 'Inserted successfully!!!');
        } 
       
    }
 
    public function edit($id)
    {
       $data =InnovativeNotice::find($id);
        return response()->json($data);
    }
    
    
    public function destroy($id)
    {  
        $data = InnovativeNotice::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('innovativenotice/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();

    }
    }