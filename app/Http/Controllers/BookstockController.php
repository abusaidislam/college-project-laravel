<?php

namespace App\Http\Controllers;
use App\Models\bookstock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;
class BookstockController extends Controller
{
   public function index()
    {
        $data = bookstock::orderBy('id', 'desc')->get();
        return view('backend.bookstock', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200|dimensions:max_width=530,max_height=650',
        ]);
    
        try {
        
            $fileName = '';
            $emp = bookstock::find($request->id);
            
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
                $fileName = $emp->photo ?? "0";
            }
            
    
            bookstock::updateOrCreate([
                'id' => $request->id
            ], [
                'photo' => $fileName,
                'book_name' => $request->book_name,
                'author' => $request->author,
                'publiction' => $request->publiction,
                'edition' => $request->edition,
                'number_of_copies' => $request->number_of_copies,
                'volumn' => $request->volumn,
                'date' => $request->date,
                'accession_number' => $request->accession_number,
                'price' => $request->price,
                'status' => $request->status,
            ]);
          
            if ($request->id != 0) {
                return redirect('bookstock')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('bookstock')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('bookstock')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = bookstock::find($id);
        return response()->json($data);
    }


    public function destroy($id)
{
    $data = bookstock::find($id);
    if (!$data) {
        return response()->json(['error' => 'Data not found.']);
    }
    $imagePath = public_path('library_book/' . $data->photo);
    if (File::exists($imagePath)) {
        unlink($imagePath);
    }
    $data->delete();
    return response()->json();
}
public function bookStockPdf()
{    
    $data = bookstock::orderBy('id', 'desc')->get();
    $pdf = PDF::loadView('backend.book_stock_pdf', compact('data'));
    
    $pdf->setPaper('A4', 'portrait');
    return $pdf->download('bookstock.pdf');
}
}
