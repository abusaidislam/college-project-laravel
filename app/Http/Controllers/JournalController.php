<?php

namespace App\Http\Controllers;
use App\Models\journal;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $data =journal::orderBy('id', 'desc')->get();
        return view('backend.journalmanage', compact('data'));
    }

    
    public function store(Request $request)
    {
         
        $fileName = '';
        $emp =journal::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('journal/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('journal/' . $emp->image);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->image;
}

     journal::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->name,
            'description' => $request->description,
             'image' => $fileName,
            
            
        ]);
        if($request->id!=0){
            return redirect('journalmanage')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('journalmanage')->with('massage', 'Inserted successfully!!!');
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
       $data =journal::find($id);
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
       journal::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
