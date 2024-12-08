<?php

namespace App\Http\Controllers;

use App\Models\DegreeClass;
use App\Models\IrregularFormFillUpFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class DegreeIrregularFeeController extends Controller
{
    public function index()
    {   // degree department id == custom 40 id;
        $classname = DegreeClass::orderby('id','asc')->get();
        $data = IrregularFormFillUpFee::where('depart_id', '=', 40)->orderBy('class_id','asc')->orderBy('session','desc')->get();
   
        return view('backend.degree_irregular_form_fee', compact('data','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
        $depart_id = 40;
        $depart_name = 'Department of Degree';

       IrregularFormFillUpFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);

       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('degree-irregular-form-fillup')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('degree-irregular-form-fillup')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('degree-irregular-form-fillup')->with('error', 'The form was not filled up completely!!!');

        // }
    }

    public function edit($id)
    {
         $data = IrregularFormFillUpFee::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        IrregularFormFillUpFee::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }


   
}
