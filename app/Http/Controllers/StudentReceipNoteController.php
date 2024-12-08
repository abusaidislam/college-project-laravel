<?php

namespace App\Http\Controllers;
use App\Models\StudentReceiptNote;
use Illuminate\Http\Request;

class StudentReceipNoteController extends Controller
{
    public function index()
    {
       $data = StudentReceiptNote::orderBy('id', 'desc')->get();
        return view('backend.hostel_student_recipt_note', compact('data'));
    }

    public function store(Request $request)
    {
       
    try {
      StudentReceiptNote::updateOrCreate([
            'id' => $request->id ],
        [
            'recipt_note' => $request->recipt_note,
            'status' => $request->status,
        ]);
        if ($request->id != 0) {
            return redirect('student_recipt_note')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('student_recipt_note')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('student_recipt_note')->with('error', 'The form was not filled up completely!!!');

    }
       
    }

   
    public function edit($id)
    {
         $data = StudentReceiptNote::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = StudentReceiptNote::find($id);
        $data->delete();
        return response()->json(['success' => 'Successfully deleted.']);
    }

}