<?php

namespace App\Http\Controllers;

use App\Models\Apalinks;
use Illuminate\Http\Request;

class ApalinksController extends Controller
{
    
    public function index()
    {
       $data = Apalinks::orderBy('id', 'desc')->get();
        return view('backend.apalinks', compact('data'));
    }

    public function store(Request $request)
    {
          
        Apalinks::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link,
        ]);
        if($request->id!=0){
            return redirect('apalinks')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('apalinks')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit( $id)
    {
        $data = Apalinks::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        Apalinks::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
