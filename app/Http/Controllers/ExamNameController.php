<?php

namespace App\Http\Controllers;

use App\Models\ExamName;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ExamNameController extends Controller
{
     public function index()
    {
        $authID = Auth::id();
        $data = ExamName::where('user_id',$authID)->orderBy('id', 'desc')->get();
        return view('backend.examName', compact('data','authID'));
    }

   
    public function store(Request $request)
    {
      $authID = Auth::id();
      $userTypeData = User::where('id',$authID)->orderBy('id', 'asc')->first();
      ExamName::updateOrCreate([
            'id' => $request->id ],
        [
            'title' => $request->name,
            'user_id' => $authID,
            'user_type' => $userTypeData->usertype,
           
        ]);
        if($request->id!=0){
            return redirect('examname')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('examname')->with('message', 'Inserted successfully!!!');
    }
    }

   
    public function edit($id)
    {
       $data = ExamName::find($id);
        return response()->json($data);
    }

   
    public function destroy($id)
    {
        ExamName::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
