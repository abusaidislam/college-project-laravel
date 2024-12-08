<?php

namespace App\Http\Controllers;
use App\Models\JournalofMagagin;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class JournalOfMagaginController extends Controller
{
    public function index()
    {
        $data =JournalofMagagin::orderBy('id', 'desc')->get();
        return view('backend.journal_of_magazin', compact('data'));
    }
    
   
    public function store(Request $request)
    {
        $fileName = '';
        $emp = JournalofMagagin::find($request->id);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('journal_magazin/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('journal_magazin/' . $emp->file);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->file ?? '0';
        }

        JournalofMagagin::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->name,
            'file' => $fileName, 
        ]);
      
        if ($request->id != 0) {
            return redirect('college-magazine')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('college-magazine')->with('message', 'Inserted successfully!!!');
        } 
    }

   
    public function edit($id)
    {
       $data =JournalofMagagin::find($id);
        return response()->json($data);
    }
    
    
    public function destroy($id)
    {
        $data = JournalofMagagin::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('journal_magazin/' . $data->file);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
    }
    