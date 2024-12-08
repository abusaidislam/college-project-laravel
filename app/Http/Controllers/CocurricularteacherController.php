<?php

namespace App\Http\Controllers;

use App\Models\cocurricularteacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CocurricularteacherController extends Controller
{
    public function index()
    {
        $data = cocurricularteacher::orderBy('id', 'desc')->get();
        return view('backend.coteacherlist', compact('data'));
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
        $emp = cocurricularteacher::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('coteacher/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('coteacher/' . $emp->photo);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }

    }

}
else {
    $fileName = $emp->photo;
}


      cocurricularteacher::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $fileName,
            'designation' => $request->designation, 
            'teachertype' => $request->teachertype,     
            'mobile_no' => $request->mobile_no,
            'blood_group' => $request->blood_group,
            'home_dis' => $request->home_dis,
             'first_join' => $request->first_join,
            'present_join' => $request->present_join,
            
        ]);
        if($request->id!=0){
            return redirect('coteacherlist')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('coteacherlist')->with('massage', 'Inserted successfully!!!');
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
        $data = cocurricularteacher::find($id);
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
         cocurricularteacher::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
