<?php

namespace App\Http\Controllers;
use App\Models\Video_clip;
use Illuminate\Http\Request;

class VideoClipController extends Controller
{

    public function index()
    {
       $data = Video_clip::orderBy('id', 'desc')->get();
        return view('backend.video_clips', compact('data'));
    }

    public function store(Request $request)
    {
          
      Video_clip::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->title,
            'link' => $request->link,
        ]);
        if($request->id!=0){
            return redirect('video_clips')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('video_clips')->with('message', 'Inserted successfully!!!');
    }
    }

    public function edit( $id)
    {
        $data = Video_clip::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        Video_clip::find($id)->delete();
        return response()->json();
    }

}
