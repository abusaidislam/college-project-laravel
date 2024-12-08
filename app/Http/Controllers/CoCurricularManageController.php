<?php

namespace App\Http\Controllers;
use App\Models\CoCurricular;
use App\Models\CoCurricularManage;
use Illuminate\Http\Request;

class CoCurricularManageController extends Controller
{

    public function index()
    {
        $data = CoCurricular::orderBy('id', 'asc')->get();
        $CoCurricular = CoCurricularManage::orderBy('id', 'asc')->get();
        return view('backend.co_curricular_manage', compact('data','CoCurricular'));
    }

    public function store(Request $request)
    {
         $fileName = '';
        $emp = CoCurricularManage::find($request->id);
        if ( $request->photo)
        {
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();

            $request->photo->move(public_path('coteacher/'), $fileName);

            if($request->id>0)
            {

                $imagePath = public_path('coteacher/' . $emp->photo);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }

            }

        }
        else {
            $fileName = $emp->photo??"0";
        }


CoCurricularManage::updateOrCreate([
            'id' => $request->id ],
        [
            
            'co_id' => $request->co_id,
            'date' => $request->date,
            'photo' => $fileName,
            'time' => $request->time, 
            'details' => $request->details,     
        ]);
        if($request->id!=0){
            return redirect('cocurricularmanage')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('cocurricularmanage')->with('message', 'Inserted successfully!!!');
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
        $data = CoCurricularManage::find($id);
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
        CoCurricularManage::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
}
