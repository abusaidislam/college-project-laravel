<?php

namespace App\Http\Controllers;
use App\Models\Book_issue;
use App\Models\bookstock;
use App\Models\library_card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use PDF;
class BookIssueController extends Controller
{
    
    public function index()
    {
        $data = Book_issue::orderBy('author', 'desc')->get();
        $data1 =bookstock::where('status',0)->orderBy('book_name', 'asc')->get();
        $Card = library_card::orderBy('card_no', 'desc')->get();
        return view('backend.book_issue', compact('data','Card','data1'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required', 
            'card_no' => 'required', 
            'author' => 'required', 
        ]);
        try {   
            Book_issue::updateOrCreate([
                'id' => $request->id
            ], [
                
            'card_no' => $request->card_no,
            'book_id' => $request->book_name,
            'number_of_book' => $request->number_of_book,
            // 'number_of_remaining_book' => $request->number_of_remaining_book,
            'author' => $request->author,
            'date_of_issue_book' => $request->date_of_issue_book,
            'date_of_return_book' => $request->date_of_return_book,
            ]);
          
            if ($request->id != 0) {
                return redirect('bookissue')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('bookissue')->with('message', 'Inserted successfully!!!');
            }
        } catch (\Exception $e) {
            return redirect('bookissue')->with('error', 'The form was not filled up completely!!!');
    
        }
    }
    
    public function edit($id)
    {
        $data = Book_issue::find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
         Book_issue::find($id)->delete();
        return response()->json(['success'=>' Successfully deleted this.']);
    }
    public function bookName($id){
        $author = DB::table('bookstocks')
                        ->select('author','number_of_copies')
                        ->where('id','=', $id)
                        ->orderBy('author', 'asc')
                        ->distinct()
                        ->get();
             
       return json_encode($author);
    }
    
    public function bookIssuePdf()
    {    
        $data = Book_issue::orderBy('id', 'desc')->get();
        $data1 =bookstock::orderBy('book_name', 'asc')->get();
        $Card = library_card::orderBy('card_no', 'desc')->get();
        $pdf = PDF::loadView('backend.book_issue_pdf', compact('data','Card','data1'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('bookissue.pdf');
    }
}
