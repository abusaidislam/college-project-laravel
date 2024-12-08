<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryNotice;
use Illuminate\Support\Facades\File;
class LibraryNoticeController extends Controller
{
    public function index()
    {
        $data = LibraryNotice::orderBy('id', 'desc')->get();
        return view('backend.library_notice', compact('data'));
    }

    public function store(Request $request)
    {
    
        try {
            $fileName = '';
            $emp = LibraryNotice::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('library/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo ?? "0";
            }
            
    
            LibraryNotice::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'date' => $request->date,
                'photo' => $fileName,
            ]);
          
            if ($request->id != 0) {
                return redirect('library_notice')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('library_notice')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('library_notice')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = LibraryNotice::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = LibraryNotice::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('library/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}
}
