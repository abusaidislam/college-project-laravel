<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\principal;
use App\Models\Exprincipal;
use Illuminate\Http\Request;

class ExprincipalController extends Controller
{
  
    public function index()
    {
        // $data = Exprincipal::orderBy('id', 'desc')->get(); aita bad jabe
        $data = principal::where('status', 1)->orderBy('id', 'desc')->get();
        return view('backend.exprincipal', compact('data'));
    }

    
    public function store(Request $request)
    {
          $fileName = '';
        $emp = Exprincipal::find($request->id);
        if ( $request->photo)
            {
                $fileName = time().'.'.$request->photo->getClientOriginalExtension();

                $request->photo->move(public_path('Exprincipal/'), $fileName);
            $photoName = 'public/Exprincipal/'.$fileName;
                if($request->id>0)
                {

                    $imagePath = public_path('Exprincipal/' . $emp->photo);
                    if(File::exists($imagePath)){
                    //  unlink($imagePath);
                    }

                }

            }
            else {
                $photoName = $emp->photo ?? "0";
            }


      Exprincipal::updateOrCreate([
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
            return redirect('exprincipaleinfo')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('exprincipaleinfo')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
        $data = Exprincipal::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
         Exprincipal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
