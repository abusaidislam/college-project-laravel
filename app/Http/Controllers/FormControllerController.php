<?php

namespace App\Http\Controllers;
use App\Models\formController;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FormControllerController extends Controller
{
   public function index()
    {
        $data =formController::orderBy('id', 'desc')->get();
        return view('backend.formsmanage', compact('data'));
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
        $emp =formController::find($request->id);
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

     formController::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->name,
            
             'file' => $fileName,
            
            
        ]);
        if($request->id!=0){
            return redirect('formsmanage')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('formsmanage')->with('massage', 'Inserted successfully!!!');
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
       $data =formController::find($id);
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
       formController::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
