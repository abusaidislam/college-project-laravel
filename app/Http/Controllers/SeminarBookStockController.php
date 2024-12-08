<?php

namespace App\Http\Controllers;
use App\Models\SeminarBookStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Facades\Session;
class SeminarBookStockController extends Controller
{
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $data = SeminarBookStock::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        return view('backend.seminar_book_stock', compact('data'));
    }

   

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
    
        try {
        
            $fileName = '';
            $emp = SeminarBookStock::find($request->id);
            
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('library_book/'), $fileName);
            
                if ($request->id > 0) {
                    $imagePath = public_path('library_book/' . $emp->photo);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                $fileName = $emp->photo??"0";
            }
            
            $depart_id = Session::get('depart_id');
            SeminarBookStock::updateOrCreate([
                'id' => $request->id
            ], [
                'depart_id' => $depart_id,
                'photo' => $fileName,
                'book_name' => $request->book_name,
                'author' => $request->author,
                'publiction' => $request->publiction,
                'edition' => $request->edition,
                'number_of_copies' => $request->number_of_copies,
                'volumn' => $request->volumn,
                'accession_number' => $request->accession_number,
                'date' => $request->date,
                'price' => $request->price,
                'status' => $request->status,
            ]);
          
            if ($request->id != 0) {
                return redirect('seminar-book-stock')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('seminar-book-stock')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('seminar-book-stock')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
   
 
    public function edit($id)
    {
        $data = SeminarBookStock::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = SeminarBookStock::find($id);
    
        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
    
        $imagePath = public_path('library_book/' . $data->photo);
    
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    
        $data->delete();
    
        return response()->json(['success' => 'Successfully deleted.']);
    }
    
    public function seminarBookStockPdf()
    {    
        $depart_id = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');
        $data = SeminarBookStock::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('backend.seminar_book_stock_pdf', compact('data','depart_name'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('seminarbookstock.pdf');
    }
}
