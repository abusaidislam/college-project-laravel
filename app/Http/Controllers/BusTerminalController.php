<?php

namespace App\Http\Controllers;
use App\Models\bus_terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class BusTerminalController extends Controller
{
     public function index()
    { 
        $data = bus_terminal::orderBy('id', 'desc')->get();
        
        return view('backend.bus_terminal', compact('data'));
    }

  

    public function store(Request $request)
    {
        

      bus_terminal::updateOrCreate([
            'id' => $request->id ],
        [
            'space_name' => $request->name,
            
            
            
        ]);
        if($request->id!=0){
            return redirect('bus_terminal')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('bus_terminal')->with('massage', 'Inserted successfully!!!');
    }
    }




    public function edit($id)
    {
       $data = bus_terminal::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        bus_terminal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
