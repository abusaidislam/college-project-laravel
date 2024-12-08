<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Menu::orderBy('id', 'desc')->get();
        return view('backend.menu', compact('data'));
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
        $emp = Menu::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('Menu/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('Menu/' . $emp->image);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->image;
}

      Menu::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->name,
            'route' => $request->route,
            'description' => $request->description,
             'image' => $fileName,
            
            
        ]);
        if($request->id!=0){
            return redirect('menumanage')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('menumanage')->with('massage', 'Inserted successfully!!!');
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
       $data = Menu::find($id);
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
        Menu::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
