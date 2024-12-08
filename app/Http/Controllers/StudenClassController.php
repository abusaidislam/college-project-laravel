<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;


class StudenClassController extends Controller
{
     public function index()
    {  
        $data = StudenClass::all();
        return view('backend.studentclassmanage', compact('data'));
    }


    public function store(Request $request)
    { 
         StudenClass::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'type_of' => $request->type_of,
        ]);
        if($request->id!=0){
            return redirect('department-class')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('department-class')->with('message', 'Inserted successfully!!!');
        }
    }

  
    public function edit($id)
    {
         $data = StudenClass::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        StudenClass::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
