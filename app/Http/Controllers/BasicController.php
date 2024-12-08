<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basic;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class BasicController extends Controller
{
 
    public function index()
    {
        $data = Basic::orderBy('id', 'desc')->get();
        return view('backend.basic', compact('data'));
    }

    public function store(Request $request)
    {
       
        $fileName = '';
        $emp = Basic::find($request->id);
        if ( $request->photo)
{
    $fileName = time().'.'.$request->photo->getClientOriginalExtension();

    $request->photo->move(public_path('basic/'), $fileName);

    if($request->id>0)
    {

        $imagePath = public_path('basic/' . $emp->logo);
        if(File::exists($imagePath)){
            unlink($imagePath);
        }



    }

}
else {
    $fileName = $emp->logo;
}

 if ( $request->citizen)
{
    $fileName1 = time().'.'.$request->citizen->getClientOriginalExtension();

    $request->citizen->move(public_path('basic/'), $fileName1);

    if($request->id>0)
    {

        $imagePath1 = public_path('basic/' . $emp->citizen);
        if(File::exists($imagePath1)){
            unlink($imagePath1);
        }



    }

}
else {
    $fileName1 = $emp->citizen;
}


if ( $request->bangabandhu)
{
    $fileName2 = time().'.'.$request->bangabandhu->getClientOriginalExtension();

    $request->bangabandhu->move(public_path('basic/'), $fileName2);

    if($request->id>0)
    {

        $imagePath2 = public_path('basic/' . $emp->bangabandhu);
        if(File::exists($imagePath2)){
            unlink($imagePath2);
        }



    }

}
else {
    $fileName2 = $emp->bangabandhu;
}

if ( $request->golden_jubilee)
{
    $fileName3 = time().'.'.$request->golden_jubilee->getClientOriginalExtension();

    $request->golden_jubilee->move(public_path('basic/'), $fileName3);

    if($request->id>0)
    {

        $imagePath3 = public_path('basic/' . $emp->golden_jubilee);
        if(File::exists($imagePath3)){
            unlink($imagePath3);
        }



    }

}
else {
    $fileName3 = $emp->golden_jubilee;
}



if ( $request->Class_s)
{
    $fileName4 = time().'.'.$request->Class_s->getClientOriginalExtension();

    $request->Class_s->move(public_path('basic/'), $fileName4);

    if($request->id>0)
    {

        $imagePath4 = public_path('basic/' . $emp->Class_s);
        if(File::exists($imagePath4)){
            unlink($imagePath4);
        }



    }

}
else {
    $fileName4 = $emp->Class_s;
}


if ( $request->bus_s)
{
    $fileName5 = time().'.'.$request->bus_s->getClientOriginalExtension();

    $request->bus_s->move(public_path('basic/'), $fileName5);

    if($request->id>0)
    {

        $imagePath5 = public_path('basic/' . $emp->bus_s);
        if(File::exists($imagePath5)){
            unlink($imagePath5);
        }



    }

}
else {
    $fileName5 = $emp->bus_s;
}

if ( $request->Journal)
{
    $fileName6 = time().'.'.$request->Journal->getClientOriginalExtension();

    $request->Journal->move(public_path('basic/'), $fileName6);

    if($request->id>0)
    {

        $imagePath6 = public_path('basic/' . $emp->Journal);
        if(File::exists($imagePath6)){
            unlink($imagePath6);
        }



    }

}
else {
    $fileName6 = $emp->Journal;
}


if ( $request->arts)
{
    $fileName7 = time().'.'.$request->arts->getClientOriginalExtension();

    $request->arts->move(public_path('basic/'), $fileName7);

    if($request->id>0)
    {

        $imagePath7 = public_path('basic/' . $emp->arts);
        if(File::exists($imagePath7)){
            unlink($imagePath7);
        }



    }

}
else {
    $fileName7 = $emp->arts;
}


if ( $request->principaloffice)
{
    $fileName8 = time().'.'.$request->principaloffice->getClientOriginalExtension();

    $request->principaloffice->move(public_path('basic/'), $fileName8);

    if($request->id>0)
    {

        $imagePath8 = public_path('basic/' . $emp->principaloffice);
        if(File::exists($imagePath8)){
            unlink($imagePath8);
        }



    }

}
else {
    $fileName8 = $emp->principaloffice;
}


if ( $request->science)
{
    $fileName9 = time().'.'.$request->science->getClientOriginalExtension();

    $request->science->move(public_path('basic/'), $fileName9);

    if($request->id>0)
    {

        $imagePath9 = public_path('basic/' . $emp->science);
        if(File::exists($imagePath9)){
            unlink($imagePath9);
        }



    }

}
else {
    $fileName9 = $emp->science;
}

if ( $request->portal)
{
    $fileName10 = time().'.'.$request->portal->getClientOriginalExtension();

    $request->portal->move(public_path('basic/'), $fileName10);

    if($request->id>0)
    {

        $imagePath10 = public_path('basic/' . $emp->portal);
        if(File::exists($imagePath10)){
            unlink($imagePath10);
        }



    }

}
else {
    $fileName10 = $emp->portal;
}

if ( $request->socialscience)
{
    $fileName11 = time().'.'.$request->socialscience->getClientOriginalExtension();

    $request->socialscience->move(public_path('basic/'), $fileName11);

    if($request->id>0)
    {

        $imagePath11 = public_path('basic/' . $emp->socialscience);
        if(File::exists($imagePath11)){
            unlink($imagePath11);
        }



    }

}
else {
    $fileName11 = $emp->socialscience;
}



if ( $request->business)
{
    $fileName12 = time().'.'.$request->business->getClientOriginalExtension();

    $request->business->move(public_path('basic/'), $fileName12);

    if($request->id>0)
    {

        $imagePath12 = public_path('basic/' . $emp->business);
        if(File::exists($imagePath12)){
            unlink($imagePath12);
        }



    }

}
else {
    $fileName12 = $emp->business;
}

if ( $request->links)
{
    $fileName13 = time().'.'.$request->links->getClientOriginalExtension();

    $request->links->move(public_path('basic/'), $fileName13);

    if($request->id>0)
    {

        $imagePath13 = public_path('basic/' . $emp->links);
        if(File::exists($imagePath13)){
            unlink($imagePath13);
        }



    }

}
else {
    $fileName13 = $emp->links;
}

if ( $request->mail)
{
    $fileName14 = time().'.'.$request->mail->getClientOriginalExtension();

    $request->mail->move(public_path('basic/'), $fileName14);

    if($request->id>0)
    {

        $imagePath14 = public_path('basic/' . $emp->mail);
        if(File::exists($imagePath14)){
            unlink($imagePath14);
        }



    }

}
else {
    $fileName14 = $emp->mail;
}


if ( $request->forms)
{
    $fileName15 = time().'.'.$request->forms->getClientOriginalExtension();

    $request->forms->move(public_path('basic/'), $fileName15);

    if($request->id>0)
    {

        $imagePath15 = public_path('basic/' . $emp->forms);
        if(File::exists($imagePath15)){
            unlink($imagePath15);
        }



    }

}
else {
    $fileName15 = $emp->forms;
}



if ( $request->currentusers)
{
    $fileName16 = time().'.'.$request->currentusers->getClientOriginalExtension();

    $request->currentusers->move(public_path('basic/'), $fileName16);

    if($request->id>0)
    {

        $imagePath16 = public_path('basic/' . $emp->currentusers);
        if(File::exists($imagePath16)){
            unlink($imagePath16);
        }



    }

}
else {
    $fileName16 = $emp->currentusers;
}

if ( $request->apa)
{
    $fileName17 = time().'.'.$request->apa->getClientOriginalExtension();

    $request->apa->move(public_path('basic/'), $fileName17);

    if($request->id>0)
    {

        $imagePath17 = public_path('basic/' . $emp->apa);
        if(File::exists($imagePath17)){
            unlink($imagePath17);
        }



    }

}
else {
    $fileName17 = $emp->apa;
}

if ( $request->nis)
{
    $fileName18 = time().'.'.$request->nis->getClientOriginalExtension();

    $request->nis->move(public_path('basic/'), $fileName18);

    if($request->id>0)
    {

        $imagePath18 = public_path('basic/' . $emp->nis);
        if(File::exists($imagePath18)){
            unlink($imagePath18);
        }



    }

}
else {
    $fileName18 = $emp->nis;
}

if ( $request->innovation)
{
    $fileName19 = time().'.'.$request->innovation->getClientOriginalExtension();

    $request->innovation->move(public_path('basic/'), $fileName19);

    if($request->id>0)
    {

        $imagePath19 = public_path('basic/' . $emp->innovation);
        if(File::exists($imagePath19)){
            unlink($imagePath19);
        }



    }

}
else {
    $fileName19 = $emp->innovation;
}

if ( $request->elearning)
{
    $fileName20 = time().'.'.$request->elearning->getClientOriginalExtension();

    $request->elearning->move(public_path('basic/'), $fileName20);

    if($request->id>0)
    {

        $imagePath20 = public_path('basic/' . $emp->elearning);
        if(File::exists($imagePath20)){
            unlink($imagePath20);
        }



    }

}
else {
    $fileName20 = $emp->elearning;
}


      Basic::updateOrCreate([
            'id' => $request->id ],
        [
            'company_name' => $request->name,
            'company_email' => $request->email,
            'mobile_no' => $request->mobile_no,
             'description' => $request->description,
             'logo' => $fileName,
             'citizen' => $fileName1,
             'bangabandhu' => $fileName2,
             'golden_jubilee' => $fileName3,
             'Class_s' => $fileName4,
             'bus_s' => $fileName5,
             'Journal' => $fileName6,
             'arts' => $fileName7,
             'principaloffice' => $fileName8,
              'science' => $fileName9,
               'portal' => $fileName10,
              'socialscience' => $fileName11,
              'business' => $fileName12,
              'links' => $fileName13,
               'mail' => $fileName14,
              'forms' => $fileName15,
              'currentusers' => $fileName16,
              'apa' => $fileName17,
              'nis' => $fileName18,
              'innovation' => $fileName19,
              'elearning' => $fileName20,

            'facebook' => $request->fbl,
            'twitter' => $request->twl,
            'instragram' => $request->whl,
            'skype' => $request->skl,
            
        ]);
        if($request->id!=0){
            return redirect('basicinfo')->with('massage', 'Updated successfully!!!');

        }
    else{
        return redirect('basicinfo')->with('massage', 'Inserted successfully!!!');
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
         $data = Basic::find($id);
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
        //
    }
}
