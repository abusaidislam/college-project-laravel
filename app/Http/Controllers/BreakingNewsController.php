<?php

namespace App\Http\Controllers;

use App\Models\breaking_news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class BreakingNewsController extends Controller
{
    
    public function index()
    {
       $data = breaking_news::orderBy('id', 'desc')->get();
        return view('backend.breakingnews', compact('data'));
    }

   
    public function store(Request $request)
    {
        $fileName = '';
        $emp = breaking_news::find($request->id);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('breaking_news/'), $fileName);
        
            if ($request->id > 0) {
                $imagePath = public_path('breaking_news/' . $emp->photo);
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $fileName = $emp->photo ?? '0';
        }

        breaking_news::updateOrCreate([
            'id' => $request->id
        ], [
            'title' => $request->title,
            'photo' => $fileName,
            
        ]);
      
        if ($request->id != 0) {
            return redirect('news')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('news')->with('message', 'Inserted successfully!!!');
        }

    }


    public function show(breaking_news $breaking_news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\breaking_news  $breaking_news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = breaking_news::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        $data = breaking_news::find($id);

         if (!$data) {
             return response()->json(['error' => 'Data not found.']);
         }
         $imagePath = public_path('breaking_news/' . $data->photo);
         if (File::exists($imagePath)) {
             unlink($imagePath);
         }
         $data->delete();
         return response()->json();
    }
}
