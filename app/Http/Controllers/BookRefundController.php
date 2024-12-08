<?php

namespace App\Http\Controllers;
use App\Models\Book_refund;
use App\Models\bookstock;
use App\Models\Department;
use App\Models\Student;
use App\Models\Book_issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use PDF;
class BookRefundController extends Controller
{
   public function index()
    {
       
        $datareturnd = Book_refund::orderBy('id', 'desc')->get();
        $data1 =bookstock::orderBy('id', 'asc')->get();
        $Card = Book_issue::orderBy('card_no', 'desc')->get();
        $student = Student::orderBy('id', 'asc')->get();
        return view('backend.book_refund', compact('datareturnd','data1','student','Card'));
    }

    public function store(Request $request)
    {
      Book_refund::updateOrCreate([
            'id' => $request->id ],
        [
            
            'card_id' => $request->card_id,
            'book_id' => $request->book_id,
            'author_name' => $request->author_name,
            'date_of_return' => $request->date_of_return,
            'due_date' => $request->late_date_of_return_book,
            'late_fine' => $request->late_fine,
            'book_condition' => $request->book_condition,
            'comments' => $request->comment,   
            'numberofbook' => $request->numberofbook,   
        ]);
        if($request->id!=0){
            return redirect('refund')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('refund')->with('message', 'Book Return Successfully!!!');
    }
    }

 
    public function edit($id)
    {
        $data = Book_refund::find($id);
        return response()->json($data);
    }

    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Book_refund::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
    public function bookDetails($id){
        $bookinfo = DB::table('book_issues')
                        ->join('bookstocks', 'book_issues.book_id', '=', 'bookstocks.id')
                        ->where('book_issues.card_no','=', $id)
                        ->select('bookstocks.*','book_issues.*')
                        ->orderBy('book_name', 'asc')
                        ->get();
                    
       return json_encode($bookinfo);
    }
    
    public function bookRefundPdf()
    {    
        $data = Book_refund::orderBy('id', 'desc')->get();
        $data1 =bookstock::orderBy('id', 'asc')->get();
        $Card = Book_issue::orderBy('card_no', 'desc')->get();
        $student = Student::orderBy('id', 'asc')->get();
        $pdf = PDF::loadView('backend.book_refund_pdf', compact('data','data1','student','Card'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('bookrefund.pdf');
    }
    
}
