<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NisFormViewController extends Controller
{
public function index()
{
    $data =ApaNoc::orderBy('id', 'desc')->get();
    return view('backend.apa_noc', compact('data'));
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
    $emp =ApaNoc::find($request->id);
    if ( $request->photo)
{
$fileName = time().'.'.$request->photo->getClientOriginalExtension();

$request->photo->move(public_path('forms/'), $fileName);

if($request->id>0)
{

    $imagePath = public_path('forms/' . $emp->file);
    if(File::exists($imagePath)){
       unlink($imagePath);
    }



}

}
else {
$fileName = $emp->file;
}

ApaNoc::updateOrCreate([
        'id' => $request->id ],
    [
        'title' => $request->name,
        
         'file' => $fileName,
        
        
    ]);
    if($request->id!=0){
        return redirect('apa-noc')->with('massage', 'Updated successfully!!!');

    }
else{
    return redirect('apa-noc')->with('massage', 'Inserted successfully!!!');
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
   $data =ApaNoc::find($id);
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
    ApaNoc::find($id)->delete();

    return response()->json(['success'=>' Successfully deleted .']);
}
}