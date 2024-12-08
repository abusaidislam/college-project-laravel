<?php

namespace App\Http\Controllers;

use App\Models\ExViceprincipal;
use App\Models\Viceprincipal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ExViceprincipalController extends Controller
{
 
    public function index()
    {
        // $data = ExViceprincipal::orderBy('id', 'desc')->get();old data
        $data = Viceprincipal::where('status',1)->orderBy('id', 'desc')->get();
        return view('backend.exviceprincipal', compact('data'));
    }

    
    public function store(Request $request)
    {$fileName = '';
        $emp = ExViceprincipal::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('ExViceprincipal/'), $fileName);
 $photoName = 'public/ExViceprincipal/'.$fileName;
    if($request->id>0)
    {

        $imagePath = public_path('ExViceprincipal/' . $emp->photo);
        if(File::exists($imagePath)){
           // unlink($imagePath);
        }

    }

}
else {
    $photoName = $emp->photo??"0";
}
         

      ExViceprincipal::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'home_dis' => $request->home_dis,
             'from' => $request->from,
            'to' => $request->to,
              'photo' => $photoName,
        ]);
        if($request->id!=0){
            return redirect('exviceprincipal')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('exviceprincipal')->with('massage', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
        $data = ExViceprincipal::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
         ExViceprincipal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
