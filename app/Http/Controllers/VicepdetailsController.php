<?php

namespace App\Http\Controllers;

use App\Models\Vicepdetails;
use App\Models\Viceprincipal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VicepdetailsController extends Controller
{
 
    public function index()
    {  
        $data1 = Viceprincipal::orderBy('id', 'asc')->get();
        $data = Vicepdetails::orderBy('id', 'asc')->get();
        return view('backend.viceprincipaldetails', compact('data','data1'));
    }

    public function store(Request $request)
    {
      
        Vicepdetails::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'v_id' => $request->cname,
            'designation' => $request->designation,
            'from' => $request->from,
            'to' => $request->to
            
        ]);
        if($request->id!=0){
            return redirect('viceprincipaledetails')->with('message', 'Updated successfully!!!');

        }
        else{
            return redirect('viceprincipaledetails')->with('message', 'Inserted successfully!!!');
        }
    }

    public function show($id)
    {
         $vdata=Viceprincipal::where('id',$ndata->v_id)->get();
          return response()->json($vdata);
    }

   
    public function edit($id)
    {
         $data = Vicepdetails::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Vicepdetails::find($id)->delete();
        return response()->json();
    }
}
