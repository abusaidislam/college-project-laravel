<?php

namespace App\Http\Controllers;
use App\Models\Exprincipal;
use Illuminate\Http\Request;

class ExTeacherController extends Controller
{
 
  
    public function index()
    {
        $data = Exprincipal::orderBy('id', 'desc')->get();
        return view('backend.exprincipal', compact('data'));
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
            
        ]);
        if($request->id!=0){
            return redirect('exprincipaleinfo')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('exprincipaleinfo')->with('massage', 'Inserted successfully!!!');
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
        $data = Exprincipal::find($id);
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
         Exprincipal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
