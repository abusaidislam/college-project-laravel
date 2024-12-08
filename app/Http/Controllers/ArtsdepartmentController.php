<?php

namespace App\Http\Controllers;
use App\Models\Artsdepartment;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ArtsdepartmentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Artsdepartment::orderBy('id', 'asc')->get();
        return view('backend.artsdepartment', compact('data'));
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
       
      Artsdepartment::updateOrCreate([
            'id' => $request->id ],
        [
            'name' => $request->name,
            
            
            
        ]);
        if($request->id!=0){
            return redirect('artsdepartment')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('artsdepartment')->with('massage', 'Inserted successfully!!!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Artsdepartment::find($id);
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
        Artsdepartment::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
