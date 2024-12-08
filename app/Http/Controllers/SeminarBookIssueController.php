<?php

namespace App\Http\Controllers;
use App\Models\SeminarBookIssue;
use App\Models\SeminarBookStock;
use App\Models\SeminarLibraryCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class SeminarBookIssueController extends Controller
{
    public function index()
    {
        $depart_id = Session::get('depart_id');
        $data = SeminarBookIssue::where('depart_id',$depart_id)->orderBy('author', 'desc')->get();
        $data1 =SeminarBookStock::where('depart_id',$depart_id)->where('status',0)->orderBy('book_name', 'asc')->get();
        $Card = SeminarLibraryCard::where('department_id',$depart_id)->orderBy('card_no', 'desc')->get();
        return view('backend.seminar_book_issue', compact('data','Card','data1'));
    }

 
    // public function store(Request $request)
    // {
    //   $depart_id = Session::get('depart_id');
    //   SeminarBookIssue::updateOrCreate([
    //         'id' => $request->id ],
    //     [
            
    //         'depart_id' => $depart_id,
    //         'card_no' => $request->card_no,
    //         'book_id' => $request->book_name,
    //         'number_of_book' => $request->number_of_book,
    //         'number_of_remaining_book' => $request->number_of_remaining_book,
    //         'author' => $request->author,
    //         'date_of_issue_book' => $request->date_of_issue_book,
    //         'date_of_return_book' => $request->date_of_return_book,
    //     ]);
    //     if($request->id!=0){
    //         return redirect('seminar-book-issue')->with('massage', 'Updated successfully!!!');

    //     }
    // else{
    //     return redirect('seminar-book-issue')->with('massage', 'Inserted successfully!!!');
    // }
    // }
    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required', 
            'card_no' => 'required', 
            'author' => 'required', 
        ]);
        // try {   
            $depart_id = Session::get('depart_id');
            SeminarBookIssue::updateOrCreate([
                'id' => $request->id
            ], [

            'depart_id' => $depart_id,
            'card_no' => $request->card_no,
            'book_id' => $request->book_name,
            'number_of_book' => $request->number_of_book,
            // 'number_of_remaining_book' => $request->number_of_remaining_book,
            'author' => $request->author,
            'date_of_issue_book' => $request->date_of_issue_book,
            'date_of_return_book' => $request->date_of_return_book,
            ]);
          
            if ($request->id != 0) {
                return redirect('seminar-book-issue')->with('message', 'Updated successfully!!!');
            } else {
                return redirect('seminar-book-issue')->with('message', 'Inserted successfully!!!');
            }
        // } catch (\Exception $e) {
        //     return redirect('seminar-book-issue')->with('error', 'The form was not filled up completely!!!');
    
        // }
    }
   
    public function edit($id)
    {
        $data = SeminarBookIssue::find($id);
        return response()->json($data);
    }

    
    public function destroy($id)
    {
        SeminarBookIssue::find($id)->delete();

        return response()->json(['success'=>' Successfully deleted this.']);
    }
    public function seminarbookName($id){
        $author = DB::table('seminar_book_stocks')
                        ->select('author','number_of_copies')
                        ->where('id','=', $id)
                        ->orderBy('author', 'asc')
                        ->distinct()
                        ->get();
      
       return json_encode($author);
    }
    
    public function seminarBookIssuePdf()
    {    
        $depart_id = Session::get('depart_id');
        $depart_name  = Session::get('depart_name');
        $data = SeminarBookIssue::where('depart_id',$depart_id)->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('backend.seminar_book_issue_pdf', compact('data','depart_name'));
        
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('seminarbookissue.pdf');
    }
}
