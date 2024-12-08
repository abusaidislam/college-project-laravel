<?php

namespace App\Http\Controllers;
use App\Models\complain;
use Illuminate\Http\Request;

class ComplainCornarController extends Controller
{
   
    public function index()
    {
        $data = complain::orderBy('id', 'asc')->get();
        return view('backend.complain_corner ', compact('data'));
    }

   
    public function store(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        complain::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
