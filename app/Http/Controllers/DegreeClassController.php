<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DegreeClass;
use Illuminate\Support\Facades\Auth;
class DegreeClassController extends Controller
{
    public function index()
    {  
        $authID = Auth::id();
        $data = DegreeClass::orderBy('name', 'asc')->get();
        return view('backend.degreeclass', compact('data'));
    }


    public function store(Request $request)
    { 
        $authID = Auth::id();
         DegreeClass::updateOrCreate([
            'id' => $request->id ],
        [
            
            'user_id' => $authID,
            'name' => $request->name,
        ]);

        if($request->id!=0){
            return redirect('degree-class')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-class')->with('message', 'Inserted successfully!!!');
        }
    }

    public function edit($id)
    {
         $data = DegreeClass::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DegreeClass::find($id)->delete();

        // return response()->json(['success'=>' Successfully deleted .']);
        return redirect('degree-class')->with('massage', 'deleted successfully!!!');
    }
}
