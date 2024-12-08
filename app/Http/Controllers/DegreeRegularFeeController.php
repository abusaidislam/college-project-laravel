<?php

namespace App\Http\Controllers;

use App\Models\DegreeClass;
use App\Models\RegularFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class DegreeRegularFeeController extends Controller
{
    public function index()
    { 
          // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = RegularFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        return view('backend.degree_regular_fee', compact('data','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
        $depart_id = 40;
        $depart_name = 'Department of Degree';

       RegularFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);
        if($request->id!=0){
            return redirect('degree-regular-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-regular-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('degree-regular-fee')->with('error', 'The form was not filled up completely!!!');

        // }
    }

    public function edit($id)
    {
         $data = RegularFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        RegularFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
   
}
