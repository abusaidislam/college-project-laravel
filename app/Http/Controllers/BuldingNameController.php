<?php

namespace App\Http\Controllers;
use App\Models\BuldingName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BuldingNameController extends Controller
{
   
      public function index()
    { 
        $authID = Auth::id();
        $data = BuldingName::orderBy('id', 'desc')->get();
        
        return view('backend.buldingname', compact('data','authID'));
    }

  

    public function store(Request $request)
    {
        

      BuldingName::updateOrCreate([
            'id' => $request->id ],
        [
            'building_name' => $request->name,
            
            
            
        ]);
        if($request->id!=0){
            return redirect('exam-buldingname')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('exam-buldingname')->with('message', 'Inserted successfully!!!');
    }
    }




    public function edit($id)
    {
       $data = BuldingName::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        BuldingName::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
