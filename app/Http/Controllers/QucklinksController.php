<?php

namespace App\Http\Controllers;

use App\Models\qucklinks;
use Illuminate\Http\Request;

class QucklinksController extends Controller
{
    
    public function index()
    {
       $data = qucklinks::orderBy('id', 'desc')->get();
        return view('backend.qucklinks', compact('data'));
    }

    public function store(Request $request)
    {
          
      qucklinks::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link,

        ]);
        if($request->id!=0){
            return redirect('qucklinks')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('qucklinks')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit( $id)
    {
        $data = qucklinks::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        qucklinks::find($id)->delete();
        return response()->json();
    }
}
