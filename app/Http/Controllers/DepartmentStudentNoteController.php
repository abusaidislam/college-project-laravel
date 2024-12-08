<?php

namespace App\Http\Controllers;

use App\Models\DepartmentStudnetNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentStudentNoteController extends Controller
{
  
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $data = DepartmentStudnetNote::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.student_idcard_note', compact('data'));
    }

    public function store(Request $request)
    {
        $depart_id = Session::get('depart_id');
        DepartmentStudnetNote::updateOrCreate([
            'id' => $request->id ],
        [
            'note' => $request->instruction,
            'depart_id' => $depart_id,
            
        ]);
        if($request->id!=0){
            return redirect('id-card-instruction')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('id-card-instruction')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
            $data = DepartmentStudnetNote::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        DepartmentStudnetNote::find($id)->delete();

        return response()->json();
    }
}