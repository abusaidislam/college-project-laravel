<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelBulding;
use Illuminate\Support\Facades\Auth;
class HostelBuldingNameController extends Controller
{

    public function index()
    {
        $hostel_id = Auth::id(); 
        $data = HostelBulding::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        
        return view('backend.hostel_bulding_name', compact('data'));
    }


    public function store(Request $request)
    {
        $hostel_id = Auth::id(); 
    
        HostelBulding::updateOrCreate([
            'id' => $request->id
        ], [
            'bulding_name' => $request->name,
            'hostel_id' => $hostel_id,
        ]);
    
        if ($request->id != 0) {
            return redirect('hostel-bulding-name')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('hostel-bulding-name')->with('message', 'Inserted successfully!!!');
        }
    }
    
    public function edit($id)
    {
       $data = HostelBulding::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        HostelBulding::find($id)->delete();
        return response()->json();
    }
}
