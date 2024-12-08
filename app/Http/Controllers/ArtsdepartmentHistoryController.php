<?php

namespace App\Http\Controllers;
use App\Models\ArtsdepartmentHistory;
use Illuminate\Http\Request;

class ArtsdepartmentHistoryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ArtsdepartmentHistory::orderBy('id', 'asc')->get();
        return view('backend.departmenthistory', compact('data'));
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
       
      ArtsdepartmentHistory::updateOrCreate([
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
       $data = ArtsdepartmentHistory::find($id);
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
        ArtsdepartmentHistory::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}


