<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Support\Facades\File;


class SlideController extends Controller
{

    public function index()
    {
        $data = Slide::orderBy('id', 'desc')->get();
        return view('backend.slideshow', compact('data'));
    }

    public function store(Request $request)
    {
        $fileName = '';
        $emp = Slide::find($request->id);
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('slide/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('slide/' . $emp->image);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->image ?? '0';
        }

        Slide::updateOrCreate([
            'id' => $request->id
        ], [
            'image' => $fileName,
            'title' => $request->title,
            'description' => $request->description,
        ]);
      
        if ($request->id != 0) {
            return redirect('slideshow')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('slideshow')->with('message', 'Inserted successfully!!!');
        }

    }

    public function edit( $id)
    {
        $data = Slide::find($id);
        return response()->json($data);
    }


    public function destroy($id)
    {
         $data = Slide::find($id);
         if (!$data) {
             return response()->json(['error' => 'Data not found.']);
         }
         $imagePath = public_path('slide/' . $data->image);
         if (File::exists($imagePath)) {
             unlink($imagePath);
         }
         $data->delete();
         return response()->json();
    }
}
