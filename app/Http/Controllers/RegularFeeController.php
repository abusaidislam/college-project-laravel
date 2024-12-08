<?php

namespace App\Http\Controllers;
use App\Models\StudenClass;
use App\Models\CourseName;
use App\Models\RegularFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Department;
use Illuminate\Validation\Rule;

class RegularFeeController extends Controller
{
    public function index()
    {   $depart_id = Session::get('depart_id');
        $depart_name = Session::get('depart_name');
        $classname = StudenClass::orderby('id','asc')->get();
        $data = RegularFee::where('depart_id', '=', $depart_id)->orderBy('class_id','asc')->orderBy('session','desc')->get();
        $depart_value = Department::all();
       
        Session::put('depart_id', $depart_id);
        Session::put('depart_name', $depart_name);
        return view('backend.studentregular_fee', compact('data','depart_value','classname'));
    }

  
   public function store(Request $request)
    { 
        // try {
        $depart_id = $request->depart_id;
        $depart_name = Session::get('depart_name');

       RegularFee::updateOrCreate([
            'id' => $request->id ],
        [
             'depart_id' => $request->depart_id,
             'dname' => $depart_name,
             'class_id' => $request->class_id,
             'session' => $request->session,
             'fee_name' => $request->fee_name,
             'fee_amount' => $request->fee_amount,
        ]);

       Session::put('depart_id', $depart_id);
       Session::put('depart_name', $depart_name);
        if($request->id!=0){
            return redirect('regular-fee')->with('message', 'Updated successfully!!!');
        }
        else{
            return redirect('regular-fee')->with('message', 'Inserted successfully!!!');
        }
        // } catch (\Exception $e) {
        //     return redirect('regular-fee')->with('error', 'The form was not filled up completely!!!');

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
