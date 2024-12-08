<?php

namespace App\Http\Controllers;

use App\Models\online_portal;
use Illuminate\Http\Request;

class OnlinePortalController extends Controller
{
        
    public function index()
    {
       $data = online_portal::orderBy('id', 'desc')->get();
        return view('backend.online_portals', compact('data'));
    }

    public function store(Request $request)
    {
          
      online_portal::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link,
        ]);
        if($request->id!=0){
            return redirect('online_portals')->with('message', 'Updated successfully!!!');

        }
        else{
            return redirect('online_portals')->with('message', 'Inserted successfully!!!');
        }
    }


    public function edit( $id)
    {
        $data = online_portal::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        online_portal::find($id)->delete();
        return response()->json();
    }
}
