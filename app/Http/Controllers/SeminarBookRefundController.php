<?php

namespace App\Http\Controllers;

use App\Models\SeminarBookRefund;
use App\Models\SeminarBookStock;
use App\Models\Department;
use App\Models\Student;
use App\Models\SeminarBookIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class SeminarBookRefundController extends Controller
{
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $datareturnd = SeminarBookRefund::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        $data1 =SeminarBookStock::where('depart_id',$depart_id)->orderBy('id', 'asc')->get();
        $Card = SeminarBookIssue::where('depart_id',$depart_id)->orderBy('card_no', 'desc')->get();
        $student = Student::where('depart_id',$depart_id)->orderBy('id', 'asc')->get();
        return view('backend.seminar_book_refund', compact('datareturnd','data1','student','Card'));
    }


    public function store(Request $request)
    {
        $depart_id = Session::get('depart_id');
        SeminarBookRefund::updateOrCreate([
            'id' => $request->id ],
        [
            
            'depart_id' => $depart_id,
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
            return redirect('seminar-book-refund')->with('message', 'Updated successfully!!!');

        }
    else{
        return redirect('seminar-book-refund')->with('message', 'Book Return Successfully!!!');
    }
    }

 
    public function edit($id)
    {
        $data = SeminarBookRefund::find($id);
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
         SeminarBookRefund::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
    public function seminarBookDetails($id){
        $bookinfo = DB::table('seminar_book_issues')
                        ->join('seminar_book_stocks', 'seminar_book_issues.book_id', '=', 'seminar_book_stocks.id')
                        ->where('seminar_book_issues.card_no','=', $id)
                        ->select('seminar_book_stocks.*','seminar_book_issues.*')
                        ->orderBy('book_name', 'asc')
                        ->get();
                    
       return json_encode($bookinfo);
    }
    
    public function seminarBookRefundPdf()
    {    
        $depart_name  = Session::get('depart_name');
        $depart_id = Session::get('depart_id');
        $data = SeminarBookRefund::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('backend.seminar_book_refund_pdf', compact('data','depart_name'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('seminarbookrefund.pdf');
    }
    
}
