<?php

namespace App\Http\Controllers;

use App\Models\NOC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class NOCController extends Controller
{
    
    public function index()
    {
         $data = NOC::orderBy('id', 'desc')->get();
        return view('backend.noc', compact('data'));
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
         

        $fileName = '';
        $emp = NOC::find($request->id);
        if ( $request->document)
{
    $fileName = time().'.'.$request->document->getClientOriginalExtension();

    $request->document->move(public_path('upload/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('upload/'. $emp->document);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->document;
}


         NOC::updateOrCreate([
            'id' => $request->id ],
        [
            
            'issue_no' => $request->issue_no,
            'subject' => $request->subject,
            'publish_date' => $request->publish_date,
             'document' => $fileName,
           
           
            
        ]);
        if($request->id!=0){
            return redirect('noc')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('noc')->with('massage', 'Inserted successfully!!!');
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
         $data = NOC::find($id);
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
        NOC::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
