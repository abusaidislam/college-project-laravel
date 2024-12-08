<?php

namespace App\Http\Controllers;
use App\Models\DepartmentNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
class DepartmentNoticeController extends Controller
{
     
    public function index()
    {$depart_id = Session::get('depart_id');
     $depart_name = Session::get('depart_name');
    Session::put('depart_id', $depart_id);
    Session::put('depart_name', $depart_name);
         $data = DepartmentNotice::where('depart_id', '=',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.department_notice', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $depart_id = Session::get('depart_id');
            $depart_name = Session::get('depart_name');
           
            $fileName = '';
            $emp = DepartmentNotice::find($request->id);
    
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
    
            DepartmentNotice::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'details' => $request->details,
                'depart_id' =>$depart_id,
                'dates' => $request->dates,
                'document' => $fileName,
            ]);
            Session::put('depart_id', $depart_id);
            Session::put('depart_name', $depart_name);
            if ($request->id != 0) {
                return redirect('department-notice')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('department-notice')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('department-notice')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = DepartmentNotice::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = DepartmentNotice::find($id);
    
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