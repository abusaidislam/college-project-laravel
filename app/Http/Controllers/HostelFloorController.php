<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelFloor;
use App\Models\HostelBulding;
use Illuminate\Support\Facades\Auth;
class HostelFloorController extends Controller
{

        public function index()
        {  
            $hostel_id = Auth::id();         
            $buldingName = HostelBulding::where('hostel_id', '=',$hostel_id)->orderBy('bulding_name', 'asc')->get();
            $data = HostelFloor::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
            
            return view('backend.hostel_bulding_floor_name', compact('data','buldingName'));
        }

        public function store(Request $request)
        {
            try {
                
                $hostel_id = Auth::id();  
                HostelFloor::updateOrCreate([
                    'id' => $request->id
                ], [
                    'floor_name' => $request->floor_name,
                    'bulding_id' => $request->bulding_id,
                    'hostel_id' => $hostel_id,
                ]);
              
                if ($request->id != 0) {
                    return redirect('hostel-floor-name')->with('message', 'Updated successfully!!!');
                } else {
                    return redirect('hostel-floor-name')->with('message', 'Inserted successfully!!!');
                }
            } catch (\Exception $e) {
                return redirect('hostel-floor-name')->with('error', 'The form was not filled up completely!!!');
        
            }
        }
    
    
        public function edit($id)
        {
           $data = HostelFloor::find($id);
            return response()->json($data);
        }
    
    
    
        public function destroy($id)
        {
            HostelFloor::find($id)->delete();
    
            return response()->json(['success'=>' Successfully deleted .']);
        }
    }
    