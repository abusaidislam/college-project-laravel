<?php

namespace App\Http\Controllers;

use App\Models\Notice_board;
use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
   
    public function index()
    {
         $data = Notice_board::orderBy('id', 'desc')->get();
        return view('backend.notice_board', compact('data'));
    }

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
       $request->validate([
            'document' => 'required|mimes:pdf,xlx,doc,txt|max:2048',
        ]);

        $fileName = time().'.'.$request->document->extension();  
     
        $request->document->move(public_path('upload'), $fileName);

         Notice_board::updateOrCreate([
            'id' => $request->id ],
        [
            
            'issue_no' => $request->issue_no,
            'subject' => $request->subject,
            'publish_date' => $request->publish_date,
             'document' => $fileName,
             
            
        ]);
        if($request->id!=0){
            return redirect('notice_board')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('notice_board')->with('massage', 'Inserted successfully!!!');
    }
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
         $data = Notice_board::find($id);
        return response()->json($data);
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
        Notice_board::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted .']);
    }
}
