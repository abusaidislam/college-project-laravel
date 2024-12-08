<?php

namespace App\Http\Controllers;
use App\Models\DegreeSyllabus;
use App\Models\DegreeClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DegreeSyllabusController extends Controller
{
     
    public function index()
    {
        $classInfo = DegreeClass::orderBy('id', 'asc')->get();
        $data = DegreeSyllabus::orderBy('id', 'desc')->get();
        return view('backend.degree_syllabus', compact('data','classInfo'));
    }
    public function store(Request $request)
    {
        try {
            $fileName = '';
            $emp = DegreeSyllabus::find($request->id);
    
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('academic/'), $fileName);
    
                if ($request->id > 0) {
                    $imagePath = public_path('academic/' . $emp->details);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->details??"0";
            }
    
            DegreeSyllabus::updateOrCreate([
                'id' => $request->id
            ], [
            'title' => $request->title,         
             'year' => $request->year,
             'session' => $request->session,
             'publish_date' => $request->publish_date,
             'details' => $fileName,
            ]);
    
            if ($request->id != 0) {
                return redirect('degree-syllabus')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('degree-syllabus')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('degree-syllabus')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
      public function edit($id)
        {
            $data = DegreeSyllabus::find($id);
            return response()->json($data);
        }
    
    
        public function destroy($id)
    {
        $data = DegreeSyllabus::find($id);
    
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
    
        $imagePath = public_path('academic/' . $data->details);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    
        $data->delete();
    
        return response()->json(['success' => 'Successfully deleted.']);
    }
    }
    
//     public function store(Request $request)
//     {
         
//         $fileName = '';
//         $emp = DegreeSyllabus::find($request->id);
//         if ( $request->photo)
// {
//     $fileName = time().'.'.$request->photo->getClientOriginalExtension();

//     $request->photo->move(public_path('academic/'), $fileName);
// $fileName1 ='public/academic/'.$fileName;
//     if($request->id>0)
//     {

//         $imagePath = public_path( $emp->details);
//         if(File::exists($imagePath)){
//             unlink($imagePath);
//         }


//     }

// }
// else {
//     $fileName1 = $emp->details;
// }

// DegreeSyllabus::updateOrCreate([
//              'id' => $request->id ],
//         [
//              'title' => $request->title,         
//              'year' => $request->year,
//              'session' => $request->session,
//              'publish_date' => $request->publish_date,
//              'details' => $fileName1,
//         ]);
//         if($request->id!=0){
//             return redirect('degree-syllabus')->with('massage', 'Updated successfully!!!');

//         }
//     else{
//         return redirect('degree-syllabus')->with('massage', 'Inserted successfully!!!');
//     }
//     }

   
   
//     public function edit($id)
//     {
//        $data = DegreeSyllabus::find($id);
//         return response()->json($data);
//     }

  
//     public function destroy($id)
//     {
//         DegreeSyllabus::find($id)->delete();

//         return response()->json(['success'=>' Successfully deleted .']);
//     }

// }
