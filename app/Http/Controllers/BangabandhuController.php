<?php

namespace App\Http\Controllers;
use App\Models\Bangabandhu;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BangabandhuController extends Controller
{
    public function index()
    {
        $data =Bangabandhu::orderBy('id', 'desc')->get();
        return view('backend.bangabandhumanage', compact('data'));
    }

  
    public function store(Request $request)
    {
        // try {
        
            $fileName = '';
            $emp = Bangabandhu::find($request->id);
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('Bangabandhu/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('Bangabandhu/' . $emp->image);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->image ?? '0';
            }
    
            Bangabandhu::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->name,
                'description' => $request->description,
                'image' => $fileName,
            ]);
          
            if ($request->id != 0) {
                return redirect('bangabandhumanage')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('bangabandhumanage')->with('message', 'Inserted successfully!!!');
            }
        // } catch (\Exception $e) {
        //     return redirect('bangabandhumanage')->with('error', 'The form was not filled up completely!!!');
        // }
    }


    public function edit($id)
    {
       $data =Bangabandhu::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        $data = Bangabandhu::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $imagePath = public_path('Bangabandhu/' . $data->image);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
        $data->delete();
        return response()->json();
    }
}
