<?php

namespace App\Http\Controllers;

use App\Models\bus_terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BusSchedule;
class BusScheduleController extends Controller
{
    public function index()
    { 
        $bus_terminals = bus_terminal::orderBy('id', 'asc')->get();
        $data = BusSchedule::orderBy('id', 'desc')->get();
      
        return view('backend.bus_schedule', compact( 'bus_terminals' ,'data'));
    }


    public function store(Request $request)
    {
        

      BusSchedule::updateOrCreate([
            'id' => $request->id ],
        [
            'bus_no' => $request->bus_no,
            'sokhipur' => $request->sokhipur,
            'gorai' => $request->gorai,
            'mirjapur' => $request->mirjapur,
            'elenga' => $request->elenga,
            'notunbusstand' => $request->notunbusstand,
            'puratonbusstand' => $request->puratonbusstand,
            'college' => $request->college,
            'note' => $request->note,
        ]);
        if($request->id!=0){
            return redirect('bus_schedule')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('bus_schedule')->with('massage', 'Inserted successfully!!!');
    }
    }




    public function edit($id)
    {
       $data = BusSchedule::find($id);
        return response()->json($data);
    }



    public function destroy($id)
    {
        BusSchedule::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
