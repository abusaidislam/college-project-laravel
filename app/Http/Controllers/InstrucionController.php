<?php

namespace App\Http\Controllers;

use App\Models\Instrucion;
use Illuminate\Http\Request;
class InstrucionController extends Controller
{
 
      public function index()
    {
       $data = Instrucion::orderBy('id', 'desc')->get();
        return view('backend.cinstruction', compact('data'));
    }

    public function store(Request $request)
    {
       
      Instrucion::updateOrCreate([
            'id' => $request->id ],
        [
            'instruction' => $request->instruction,
        
        ]);
        if($request->id!=0){
            return redirect('cinstruction')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('cinstruction')->with('message', 'Inserted successfully!!!');
    }

    }

   
    public function edit($id)
    {
         $data = Instrucion::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = Instrucion::find($id);
        $data->delete();
        return response()->json();
    }
    

}