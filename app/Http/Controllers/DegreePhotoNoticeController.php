<?php

namespace App\Http\Controllers;
use App\Models\DegreeNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DegreePhotoNoticeController extends Controller
{
   
    public function index()
    {
  
         $data = DegreeNotice::orderBy('id', 'desc')->get();
        return view('backend.degree_notice', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $fileName = '';
            $emp = DegreeNotice::find($request->id);
    
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('DepartmentNotice/'), $fileName);
    
                if ($request->id > 0) {
                    $imagePath = public_path('DepartmentNotice/' . $emp->document);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->document??"0";
            }
    
            DegreeNotice::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'details' => $request->details,
                'dates' => $request->dates,
                'document' => $fileName,
            ]);
    
            if ($request->id != 0) {
                return redirect('degree-notice')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree-notice')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree-notice')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = DegreeNotice::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = DegreeNotice::find($id);
    
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
    
        $imagePath = public_path('DepartmentNotice/' . $data->document);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    
        $data->delete();
    
        return response()->json(['success' => 'Successfully deleted.']);
    }
    }
  