<?php

namespace App\Http\Controllers;

use App\Models\SeminarCardInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SeminarCardInstructionController extends Controller
{
   
    public function index()
    {
       $depart_id = Session::get('depart_id');
       $data = SeminarCardInstruction::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.seminer_card_instruction', compact('data'));
    }

    public function store(Request $request)
    {
        $depart_id = Session::get('depart_id');
        SeminarCardInstruction::updateOrCreate([
            'id' => $request->id ],
        [
            'instruction' => $request->instruction,
            'depart_id' => $depart_id,
         
        ]);
        if($request->id!=0){
            return redirect('seminar-card-instruction')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('seminar-card-instruction')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
         $data = SeminarCardInstruction::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        SeminarCardInstruction::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}