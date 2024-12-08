<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeminarNotice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
class SeminarNoticeController extends Controller
{
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $data = SeminarNotice::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.seminar_notice', compact('data'));
    }


public function store(Request $request)
{
   
    try {
        $fileName = '';
        $emp = SeminarNotice::find($request->id);
        
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
            $fileName = $emp->photo??"0";
        }
        
        $depart_id = Session::get('depart_id');
        SeminarNotice::updateOrCreate([
            'id' => $request->id
        ], [
            'depart_id' => $depart_id,
            'title' => $request->title,
            'date' => $request->date,
            'photo' => $fileName,
        ]);
      
        if ($request->id != 0) {
            return redirect('seminar_notice')->with('message', 'Updated successfully!!!');
        } else {
            return redirect('seminar_notice')->with('message', 'Inserted successfully!!!');
        }
    } catch (\Exception $e) {
        return redirect('seminar_notice')->with('error', 'The form was not filled up completely!!!');

    }
}

public function edit($id)
{
    $data = SeminarNotice::find($id);
    return response()->json($data);
}


public function destroy($id)
{
$data = SeminarNotice::find($id);

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