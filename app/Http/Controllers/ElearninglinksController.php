<?php

namespace App\Http\Controllers;
use App\Models\Elearninglinks;
use Illuminate\Http\Request;

class ElearninglinksController extends Controller
{
    
    public function index()
    {
       $data = Elearninglinks::orderBy('id', 'desc')->get();
        return view('backend.elearninglinks', compact('data'));
    }

    public function store(Request $request)
    {
          
        Elearninglinks::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
         
            'link' => $request->link,
  
        ]);
        if($request->id!=0){
            return redirect('elearning-links')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('elearning-links')->with('message', 'Inserted successfully!!!');
    }
    }
 
    public function edit( $id)
    {
        $data = Elearninglinks::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        Elearninglinks::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
