<?php

namespace App\Http\Controllers;
use App\Models\subofsubmenu;
use App\Models\Submenu;
use Illuminate\Http\Request;

class SubofsubmenuController extends Controller
{
     public function index()
    {
          $menu =  Submenu::orderBy('id', 'asc')->get();
           $data = subofsubmenu::orderBy('id', 'desc')->get();
          
        return view('backend.subofsubmenu', compact('data','menu'));
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
        
      subofsubmenu::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->name,
            'route' => $request->route,
            'sub_id'=>$request->menu,
          
            
        ]);
        if($request->id!=0){
            return redirect('subofsubmenu')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('subofsubmenu')->with('massage', 'Inserted successfully!!!');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
         $data1 = DB::table('menus')
        ->where('id' , $id)
        ->get();

      
        return response()->json($data1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = subofsubmenu::find($id);

      
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submenu $submenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subofsubmenu::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }}