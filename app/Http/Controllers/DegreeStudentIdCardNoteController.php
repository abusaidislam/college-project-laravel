<?php

namespace App\Http\Controllers;
use App\Models\DegreeStudentIdCardNote;
use Illuminate\Http\Request;

class DegreeStudentIdCardNoteController extends Controller
{
    public function index()
    {
       $data = DegreeStudentIdCardNote::orderBy('id', 'desc')->get();
        return view('backend.degree_student_idCard_note', compact('data'));
    }

    public function store(Request $request)
    {
       
    try {
      DegreeStudentIdCardNote::updateOrCreate([
            'id' => $request->id ],
        [
            'note' => $request->idcard_note,
        ]);
        if ($request->id != 0) {
            return redirect('degree_idcard_note')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('degree_idcard_note')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('degree_idcard_note')->with('error', 'The form was not filled up completely!!!');

    }
       
    }

   
    public function edit($id)
    {
         $data = DegreeStudentIdCardNote::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = DegreeStudentIdCardNote::find($id);
        $data->delete();
        return response()->json(['success' => 'Successfully deleted.']);
    }

}