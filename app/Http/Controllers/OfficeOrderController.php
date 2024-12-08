<?php

namespace App\Http\Controllers;

use App\Models\Office_order;
use Illuminate\Http\Request;

class OfficeOrderController extends Controller
{
    public function index()
    {
         $data = Office_order::orderBy('id', 'desc')->get();
        return view('backend.office_order', compact('data'));
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
     

        $fileName = time().'.'.$request->document->extension();  
     
        $request->document->move(public_path('upload'), $fileName);

         Office_order::updateOrCreate([
            'id' => $request->id ],
        [
            'issue_no' => $request->issue_no,
            'subject' => $request->subject,
            'publish_date' => $request->publish_date,
             'document' => $fileName,
            
        ]);
         
        if($request->id!=0){
            return redirect('office_order')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('office_order')->with('massage', 'Inserted successfully!!!');
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
         $data = Office_order::find($id);
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
        Office_order::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
