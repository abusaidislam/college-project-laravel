<?php

namespace App\Http\Controllers;

use App\Models\honorarium_distribute;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorariumDistributeController extends Controller
{
    
    public function index()
    { 
       $authID = Auth::id();
       $data = honorarium_distribute::orderBy('id', 'desc')->get();
        return view('backend.honorarium_distributes', compact('data','authID'));
    }

    
  
    public function store(Request $request)
    {
          
      honorarium_distribute::updateOrCreate([
            'id' => $request->id ],
        [
            'receiver' => $request->receiver,
            'ammount' => $request->ammount,
            'dates' => $request->dates,
            'note' => $request->note,
            
            
        ]);
        if($request->id!=0){
            return redirect('honorarium_distributes')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('honorarium_distributes')->with('message', 'Inserted successfully!!!');
    }
    }

   
    
    public function edit( $id)
    {
        $data = honorarium_distribute::find($id);
        return response()->json($data);
    }

    
  
   
    public function destroy($id)
    {
        honorarium_distribute::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
