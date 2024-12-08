<?php

namespace App\Http\Controllers;

use App\Models\Innovativelinks;
use Illuminate\Http\Request;

class InnovativelinksController extends Controller
{
    
    public function index()
    {
       $data = Innovativelinks::orderBy('id', 'desc')->get();
        return view('backend.innovativelinks', compact('data'));
    }

    public function store(Request $request)
    {
        Innovativelinks::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link,
        ]);
        if($request->id!=0){
            return redirect('innovative-links')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('innovative-links')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit( $id)
    {
        $data = Innovativelinks::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Innovativelinks::find($id)->delete();
        return response()->json(['success'=>' Successfully deleted .']);
    }
}
