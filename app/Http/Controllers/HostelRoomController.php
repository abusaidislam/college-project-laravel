<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelFloor;
use App\Models\HostelBulding;
use App\Models\HostelRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HostelRoomController extends Controller
{
    public function index()
        {
            $hostel_id = Auth::id();         
            $buldingName = HostelBulding::where('hostel_id', '=',$hostel_id)->orderBy('bulding_name', 'asc')->get();
            $Floor = HostelFloor::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
            $data = HostelRoom::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
            return view('backend.hostel_room_number', compact('data','buldingName','Floor'));
        }
        // public function store(Request $request)
        // {
        //     $hostel_id = Auth::id();  
        //     HostelRoom::updateOrCreate([
        //         'id' => $request->id ],
        //     [
        //         'room_number' => $request->room_number,
        //         'seat_number' => $request->seat_number,
        //         'floor_id' => $request->floor_id,
        //         'bulding_id' => $request->bulding_id,
        //         'hostel_id' => $hostel_id,
        //     ]);
        //     if($request->id!=0){
        //         return redirect('hostel-room-number')->with('massage', 'Updated successfully!!!');
    
        //     }
        // else{
        //     return redirect('hostel-room-number')->with('massage', 'Inserted successfully!!!');
        // }
        // }
        public function store(Request $request)
        {
            try {
                
                $hostel_id = Auth::id();  
                HostelRoom::updateOrCreate([
                    'id' => $request->id
                ], [
                    'room_number' => $request->room_number,
                    'seat_number' => $request->seat_number,
                    'floor_id' => $request->floor_id,
                    'bulding_id' => $request->bulding_id,
                    'hostel_id' => $hostel_id,
                ]);
              
                if ($request->id != 0) {
                    return redirect('hostel-room-number')->with('message', 'Updated successfully!!!');
                } else {
                    return redirect('hostel-room-number')->with('message', 'Inserted successfully!!!');
                }
            } catch (\Exception $e) {
                return redirect('hostel-room-number')->with('error', 'The form was not filled up completely!!!');
        
            }
        }
        public function edit($id)
        {
           $data = HostelRoom::find($id);
            return response()->json($data);
        }
        public function destroy($id)
        {
            HostelRoom::find($id)->delete();
    
            return response()->json(['success'=>' Successfully deleted .']);
        }

        public function FloorName($id)
    {
        $floorInfo = DB::table('hostel_floors')
                        ->where('bulding_id','=', $id)
                        ->orderBy('id', 'asc')
                        ->get();     
        return json_encode($floorInfo);
    }
    }