<?php

namespace App\Http\Controllers;

use App\Models\StudentSession;
use App\Models\Department;
use App\Models\StudenClass;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class StudentPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentPromote()
    {
        $depart_id = Session::get('depart_id');
        $studentclass = StudenClass::all();
        $data = StudentSession::distinct()->select(['stu_id'])->where('depart_id',$depart_id)->get();


        foreach($data as $key => $value){
            $stu_id = $value['stu_id'];
            $depart_id = Session::get('depart_id');

            $ses = StudentSession::where('depart_id',$depart_id)->where('stu_id', $stu_id)->orderBy('class_name','desc')->limit(1)->get()[0];
            
            $exploded = explode('-', $ses->class_year);
            $exploded1 = intval($exploded[0]) + 1;
            $exploded2 = intval($exploded[1]) + 1;
            $newsessionyear = $exploded1 . '-' . $exploded2;

            $st_info = StudentSession::where('depart_id',$depart_id)->where('stu_id', $stu_id)->orderBy('class_name','desc')->limit(1)->get()[0];

            $updatedClsName = StudenClass::where('id','>',$st_info->class_name)->limit(1)->get();


            if(count($updatedClsName)){
                StudentSession::create([
                    'stu_id' => $st_info->stu_id,
                    'session_year' => $st_info->session_year,
                    'class_year' => $newsessionyear,
                    'class_name' => $updatedClsName[0]->id, 
                    'depart_id' => $st_info->depart_id,
                    'class_typeof' => $st_info->class_typeof,
                ]);
            }
            
        }
       
        return redirect('studentsessionmanage')->with('massage', 'Inserted successfully!!!');
        
    }
    // public function studentPromote()
    // {
    //     $depart_id = Session::get('depart_id');
    //     $studentclass = StudenClass::where('depart_id', '=', $depart_id)->get();
    //     $data = StudentSession::distinct()->select(['stu_id'])->where('depart_id',$depart_id)->get();


    //     foreach($data as $key => $value){
    //         $stu_id = $value['stu_id'];
    //         $depart_id = Session::get('depart_id');

    //         $ses = StudentSession::where('depart_id',$depart_id)->where('stu_id', $stu_id)->orderBy('class_name','desc')->limit(1)->get()[0];
            
    //         $exploded = explode('-', $ses->class_year);
    //         $exploded1 = intval($exploded[0]) + 1;
    //         $exploded2 = intval($exploded[1]) + 1;
    //         $newsessionyear = $exploded1 . '-' . $exploded2;

    //         $st_info = StudentSession::where('depart_id',$depart_id)->where('stu_id', $stu_id)->orderBy('class_name','desc')->limit(1)->get()[0];

    //         $updatedClsName = StudenClass::where('depart_id',$depart_id)->where('id','>',$st_info->class_name)->limit(1)->get();


    //         if(count($updatedClsName)){
    //             StudentSession::create([
    //                 'stu_id' => $st_info->stu_id,
    //                 'session_year' => $st_info->session_year,
    //                 'class_year' => $newsessionyear,
    //                 'class_name' => $updatedClsName[0]->id, 
    //                 'depart_id' => $st_info->depart_id,
    //             ]);
    //         }
            
    //     }
       
    //     return redirect('studentsessionmanage')->with('massage', 'Inserted successfully!!!');
        
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
