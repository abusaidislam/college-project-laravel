<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $data = Message::orderBy('id', 'desc')->get();
        return view('backend.message', compact('data'));
    }

    
    public function store(Request $request)
    {

         $fileName = '';
        $emp = Message::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('Message/'), $fileName);

            if($request->id>0)
            {

                $imagePath = public_path('Message/' . $emp->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }

            }

        }
        else {
            $fileName = $emp->photo ?? "0";
        }

      Message::updateOrCreate([
            'id' => $request->id ],
        [
            'name' => $request->name,
            'designation' => $request->designation,
           
            'photo' => $fileName,
            'mess_title' => $request->mess_title,
            'message' => $request->message,
            'details' => $request->details
            
        ]);
        if($request->id!=0){
             //return response()->json(['massage'=>'Updated successfully!!!']);
            return redirect('massageshow')->with('message', 'Updated successfully!!!');

        }
    else{
          // return response()->json(['massage'=>'Inserted successfully!!!']);
      return redirect('massageshow')->with('message', 'Inserted successfully!!!');
    }

    }

    public function edit($id)
    {
         $data = Message::find($id);
          return response()->json($data);
       // return view('backend.editmessage', compact('data'));
    }

  
    public function destroy(Message $message)
    {
        //
    }
}
