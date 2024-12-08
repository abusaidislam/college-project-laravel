<?php

namespace App\Http\Controllers;

use App\Models\ExamName;
use App\Models\ExamCommittees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ExamCommitteesController extends Controller
{
  
    public function index()
    {
        $authID = Auth::id();
        $data1 = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        $data = ExamCommittees::where('user_id',$authID)->orderBy('examname_id', 'desc')->latest()->get();
        return view('backend.examcommittee', compact('data','data1','authID'));
    }

public function store(Request $request)
{
    $request->validate([
        'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
    ]);
    try {
        $fileName = '';
        $emp = ExamCommittees::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('Exam_committee/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('Exam_committee/' . $emp->photo);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->photo??"0";
        }
        
        $authID = Auth::id();
        ExamCommittees::updateOrCreate([
            'id' => $request->id
        ], [
            'user_id' => $authID,
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $fileName,
            'designation' => $request->designation,
            'examname_id'=>$request->examname_id,
            'academic_designation' => $request->academic_designation,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'home_dis' => $request->home_dis,
            'year' => $request->year,
          
        ]);
      
        if ($request->id != 0) {
            return redirect('examcommittee')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('examcommittee')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('examcommittee')->with('error', 'The form was not filled up completely!!!');

    }
}

public function edit($id)
{
    $data = ExamCommittees::find($id);
    return response()->json($data);
}


public function destroy($id)
{
$data = ExamCommittees::find($id);

if (!$data) {
    return response()->json(['error' => 'Data not found.']);
}

$imagePath = public_path('Exam_committee/' . $data->photo);

if (File::exists($imagePath)) {
    unlink($imagePath);
}

$data->delete();

return response()->json(['success' => 'Successfully deleted.']);
}
}