<?php

namespace App\Http\Controllers;
use App\Models\Administration;
//use Spatie\Backtrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Administration::orderBy('id', 'desc')->get();
        return view('backend.administration', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $imageName = time().'.'.$request->photo->getClientOriginalExtension();

       // $request->photo->move('upload/', $imageName);

        $fileName = '';
        $emp = Administration::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('upload/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('upload/' . $emp->photo);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->photo;
}

       Administration::updateOrCreate([
            'id' => $request->id ],
        [
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $fileName,
            'designation' => $request->designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]);
        if($request->id!=0){
            return redirect('administration')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('administration')->with('massage', 'Inserted successfully!!!');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Administration::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function principal()
    {
        $ndata = Administration::find('1');
        return view('backend.principalinfo', compact('ndata'));
    }
    public function principaledit(Request $request)
    {
        $imageName = time().'.'.$request->photo->getClientOriginalExtension();

        $request->photo->move(public_path('upload/'), $imageName);

       Administration::updateOrCreate([
            'id' => $request->id ],
        [
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $imageName,
            'designation' => $request->designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]);
        return redirect('principal')->with('massage', 'Updated successfully!!!');
    }
    public function viceprincipal()
    {
        $ndata = Administration::find('2');
        return view('backend.viceprincipalinfo', compact('ndata'));
    }
    public function viceprincipaledit(Request $request)
    {
        $imageName = time().'.'.$request->photo->getClientOriginalExtension();

        $request->photo->move(public_path('upload/'), $imageName);

       Administration::updateOrCreate([
            'id' => $request->id ],
        [
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $imageName,
            'designation' => $request->designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
        ]);
        return redirect('viceprincipal')->with('massage', 'Updated successfully!!!');
    }

}
