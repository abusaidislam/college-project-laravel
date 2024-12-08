<?php

namespace App\Http\Controllers;
use App\Models\HostelIdCardNote;
use Illuminate\Http\Request;

class HostelIdCardNoteController extends Controller
{
    public function index()
    {
       $data = HostelIdCardNote::orderBy('id', 'desc')->get();
        return view('backend.hostel_id_card_note', compact('data'));
    }

    public function store(Request $request)
    {
       
    try {
      HostelIdCardNote::updateOrCreate([
            'id' => $request->id ],
        [
            'idcard_note' => $request->idcard_note,
            'status' => $request->status,
        ]);
        if ($request->id != 0) {
            return redirect('hostelidcardnote')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('hostelidcardnote')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('hostelidcardnote')->with('error', 'The form was not filled up completely!!!');

    }
       
    }

   
    public function edit($id)
    {
         $data = HostelIdCardNote::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = HostelIdCardNote::find($id);
        $data->delete();
        return response()->json(['success' => 'Successfully deleted.']);
    }

}