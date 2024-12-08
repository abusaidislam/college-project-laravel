<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
       $data = Event::orderBy('id', 'desc')->get();
        return view('backend.event', compact('data'));
    }

    public function store(Request $request)
    {
       Event::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'place' => $request->place,
            'details' => $request->details,
           
            
        ]);
        if($request->id!=0){
            return redirect('events')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('events')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit($id)
    {
         $data = Event::find($id);
        return response()->json($data);
    }

  
    public function destroy($id)
    {
        Event::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
