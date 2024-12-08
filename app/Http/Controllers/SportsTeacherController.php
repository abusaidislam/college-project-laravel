<?php

namespace App\Http\Controllers;

use App\Models\SportsTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class SportsTeacherController extends Controller
{
   public function index()
    {
        $data = SportsTeacher::orderBy('id', 'desc')->get();
        return view('backend.steacherlist', compact('data'));
    }

    public function store(Request $request)
    {
         $fileName = '';
        $emp = SportsTeacher::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('sportsteacher/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('sportsteacher/' . $emp->photo);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }

    }

}
else {
    $fileName = $emp->photo??"0";
}


      SportsTeacher::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $fileName,
            'designation' => $request->designation,      
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
            'first_join' => $request->first_join,
            'present_join' => $request->present_join,
            
        ]);
        if($request->id!=0){
            return redirect('sportsteacherlist')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('sportsteacherlist')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
        $data = SportsTeacher::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = SportsTeacher::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('sportsteacher/' . $data->photo);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
}
