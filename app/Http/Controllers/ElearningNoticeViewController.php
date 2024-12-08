<?php

namespace App\Http\Controllers;
use App\Models\ElearningNotice;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ElearningNoticeViewController extends Controller
{
    public function index()
    {
        $data =ElearningNotice::orderBy('id', 'desc')->get();
        return view('backend.elearning_notice', compact('data'));
    }
    
    public function store(Request $request)
    {
         
        $fileName = '';
        $emp = ElearningNotice::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('elearning_notice/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('elearning_notice/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }
    
        ElearningNotice::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('elearning-notice')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('elearning-notice')->with('message', 'Inserted successfully!!!');
        } 
    }
    
    
    public function edit($id)
    {
       $data =ElearningNotice::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = ElearningNotice::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('elearning_notice/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
    }
    