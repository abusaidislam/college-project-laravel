<?php

namespace App\Http\Controllers;
use App\Models\principal;
use App\Models\principaldetails;
use Illuminate\Http\Request;

class PrincipaldetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = principaldetails::orderBy('id', 'desc')->get();
          $data1 = principal::orderBy('id', 'asc')->get();
        return view('backend.principaldetails', compact('data','data1'));
       
       
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
         principaldetails::updateOrCreate([
            'id' => $request->id ],
        [
            
            'name' => $request->name,
            'p_id' => $request->cname,
            'designation' => $request->designation,
            'from' => $request->from,
            'to' => $request->to
            
        ]);
        if($request->id!=0){
            return redirect('principaledetails')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('principaledetails')->with('message', 'Inserted successfully!!!');
    }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\principaldetails  $principaldetails
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\principaldetails  $principaldetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = principaldetails::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\principaldetails  $principaldetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, principaldetails $principaldetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\principaldetails  $principaldetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         principaldetails::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
