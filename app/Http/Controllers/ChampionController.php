<?php

namespace App\Http\Controllers;

use App\Models\Champion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ChampionController extends Controller
{
    public function index()
    {
        $data = Champion::orderBy('id', 'desc')->get();
        return view('backend.schampionslist', compact('data'));
    }

    
    public function store(Request $request)
    {
         $fileName = '';
        $emp = Champion::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('schampions/'), $fileName);

            if($request->id>0)
            {

                $imagePath = public_path('schampions/' . $emp->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }

            }

        }
        else {
            $fileName = $emp->photo ?? "0";
        }


      Champion::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $fileName,
            'deprartment' => $request->deprartment,      
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
            'events' => $request->events,
            'awards' => $request->awards,
            'session' => $request->session,
        ]);
        if($request->id!=0){
            return redirect('schampionslist')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('schampionslist')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
        $data = Champion::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        $data = Champion::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('schampions/' . $data->photo);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
}
