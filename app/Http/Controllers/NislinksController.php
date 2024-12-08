<?php

namespace App\Http\Controllers;
use App\Models\Nislinks;
use Illuminate\Http\Request;

class NislinksController extends Controller
{
    
    public function index()
    {
       $data = Nislinks::orderBy('id', 'desc')->get();
        return view('backend.nislinks', compact('data'));
    }

    public function store(Request $request)
    {
          
        Nislinks::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link, 
        ]);
        if($request->id!=0){
            return redirect('nislinks')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('nislinks')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit( $id)
    {
        $data = Nislinks::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        Nislinks::find($id)->delete();
        return response()->json();
    }
}
