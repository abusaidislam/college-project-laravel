<?php

namespace App\Http\Controllers;

use App\Models\Book_issue;
use App\Models\Book_refund;
use App\Models\bookstock;
use App\Models\library_card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use PDF;

class NoReturnBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
     $unmatchedData = DB::table('book_issues')
            ->leftJoin('book_refunds', 'book_issues.date_of_return_book', '=', 'book_refunds.date_of_return')
            ->whereNull('book_refunds.card_id')
            ->select('book_issues.*')
            ->orderBy('book_issues.date_of_return_book', 'desc')
            ->get();
        $data = Book_issue::orderBy('id', 'desc')->get();
        $return = Book_refund::orderBy('id', 'desc')->get();
        $data1 =bookstock::orderBy('book_name', 'asc')->get();
        $Card = library_card::orderBy('card_no', 'desc')->get();
        return view('backend.book_no_return', compact('unmatchedData','Card','data1','return'));
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
         Book_issue::find($id)->delete();
        return response()->json(['success'=>' Successfully deleted this.']);
    }
    
    public function bookNoReturnPdf()
{    
    $data = DB::table('book_issues')
            ->leftJoin('book_refunds', 'book_issues.date_of_return_book', '=', 'book_refunds.date_of_return')
            ->whereNull('book_refunds.card_id')
            ->select('book_issues.*')
            ->orderBy('book_issues.date_of_return_book', 'desc')
            ->get();
    $pdf = PDF::loadView('backend.book_no_return_pdf', compact('data'));
    
    $pdf->setPaper('A4', 'portrait');
    return $pdf->download('booknoreturn.pdf');
}
}
