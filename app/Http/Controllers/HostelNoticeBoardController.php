<?php

namespace App\Http\Controllers;
use App\Models\HostelNoticeBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class HostelNoticeBoardController extends Controller
{
    public function index()
    {
        $hostel_id = Auth::id(); 
        $data = HostelNoticeBoard::where('hostel_id', '=',$hostel_id)->orderBy('id', 'desc')->get();
        return view('backend.hostel_notice_board', compact('data'));
    }

    public function store(Request $request)
    {
      
        try {
            $fileName = '';
            $emp = HostelNoticeBoard::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('hostel_card/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('hostel_card/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo ?? "0";
            }
            
            $hostel_id = Auth::id(); 
            HostelNoticeBoard::updateOrCreate([
                'id' => $request->id
            ], [
                'title' => $request->title,
                'date' => $request->date,
                'photo' => $fileName,
                'hostel_id' => $hostel_id,
            ]);
          
            if ($request->id != 0) {
                return redirect('hostel_notice_board')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('hostel_notice_board')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('hostel_notice_board')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = HostelNoticeBoard::find($id);
        return response()->json($data);
    }

    public function destroy($id)
{
    $data = HostelNoticeBoard::find($id);

    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }

    $imagePath = public_path('hostel_card/' . $data->photo);

    if (File::exists($imagePath)) {
        unlink($imagePath);
    }

    $data->delete();

    return response()->json(['success' => 'Successfully deleted.']);
}

}

