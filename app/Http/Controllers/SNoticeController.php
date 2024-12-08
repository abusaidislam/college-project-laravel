<?php

namespace App\Http\Controllers;

use App\Models\SNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class SNoticeController extends Controller
{
   public function index()
    {
        $data = SNotice::orderBy('id', 'desc')->get();
        return view('backend.snotice', compact('data'));
    }

    public function store(Request $request)
    {
      SNotice::updateOrCreate([
            'id' => $request->id ],
        [
            
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,      
            'place' => $request->place,
            'details' => $request->details, 
        ]);
        if($request->id!=0){
            return redirect('snoticelist')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('snoticelist')->with('message', 'Inserted successfully!!!');
    }
    }

    
    public function edit($id)
    {
        $data = SNotice::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        SNotice::find($id)->delete();
        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
