<?php

namespace App\Http\Controllers;
use App\Models\JournalofSaadat;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class JournalOfSaadatController extends Controller
{
    public function index()
    {
        $data =JournalofSaadat::orderBy('id', 'desc')->get();
        return view('backend.journal_of_saadat', compact('data'));
    }
    
    
    public function store(Request $request)
    {
        $fileName = '';
        $emp = JournalofSaadat::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('journal_saadat/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('journal_saadat/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }

        JournalofSaadat::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('journal-of-saadat')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('journal-of-saadat')->with('message', 'Inserted successfully!!!');
        } 

    }

    public function edit($id)
    {
       $data =JournalofSaadat::find($id);
        return response()->json($data);
    }
    
    
    public function destroy($id)
    {
        $data = JournalofSaadat::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('journal_saadat/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
    }
    