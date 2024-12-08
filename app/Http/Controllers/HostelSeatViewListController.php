<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HostelFloor;
use App\Models\HostelBulding;
use App\Models\HostelRoom;
use App\Models\HostelSeatAllotment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
class HostelSeatViewListController extends Controller
{
    public function index()
    {
        $hostel_id = Auth::id(); 
        $Floor = HostelFloor::where('hostel_id', '=',$hostel_id)->orderBy('id', 'asc')->get();
        
        return view('backend.hostel_seat_list_view', compact('Floor'));
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
    
    public function hostelSeatList()
    {    
        $hostel_id = Auth::id(); 
        $Floor = HostelFloor::where('hostel_id', '=',$hostel_id)->orderBy('id', 'asc')->get();
        $pdf = PDF::loadView('backend.hostel_seat_list_pdf', compact('Floor'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('hostelseatlist.pdf');
    }
}