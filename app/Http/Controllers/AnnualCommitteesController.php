<?php

namespace App\Http\Controllers;
use App\Models\Annual_committees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class AnnualCommitteesController extends Controller
{
    public function index()
    {
    
       $data =Annual_committees::where('type', 1)->get();
 $data1 =Annual_committees::where('type', 2)->get();

        return view('backend.annual', compact('data','data1'));
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
     * @param  \App\Http\Requests\StoreprincipalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $fileName = '';
        $emp =Annual_committees::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('Annual_committees/'), $fileName);
//$newfileName =public_path('Annual_committees/', $fileName);
    if($request->id>0)
    {

        $imagePath = public_path('Annual_committees/' . $emp->photo);
        if(File::exists($imagePath)){
           //unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->photo;
}

      Annual_committees::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'academic_designation' => $request->academic_designation,
            'department' => $request->department,
            'bcs_batch' => $request->bcs_batch,
            'mobile_no' => $request->mobile_no,
            'type' => $request->type,
           'photo' => $fileName,
            
        ]);
        if($request->id!=0){
            return redirect('annual')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('annual')->with('massage', 'Inserted successfully!!!');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function show(principal $principal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Annual_committees::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprincipalRequest  $request
     * @param  \App\Models\principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprincipalRequest $request, principal $principal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Annual_committees::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
