<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $menu =  Menu::orderBy('id', 'asc')->get();
           $data = Submenu::orderBy('id', 'desc')->get();
          
        return view('backend.submenu', compact('data','menu'));
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
    { $menuname =  Menu::find($request->menu);
      Submenu::updateOrCreate([
            'id' => $request->id ],
        [
            'sub_title' => $request->name,
            'subroute' => $request->route,
            'menu_id'=>$request->menu,
           'menu'=>$menuname->title,
            
        ]);
        if($request->id!=0){
            return redirect('submenumanage')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('submenumanage')->with('massage', 'Inserted successfully!!!');
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
       $data = Submenu::find($id);

      
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
        Submenu::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
