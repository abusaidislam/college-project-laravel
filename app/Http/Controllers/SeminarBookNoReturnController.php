<?php

namespace App\Http\Controllers;

use App\Models\SeminarBookIssue;
use App\Models\SeminarBookRefund;
use App\Models\SeminarBookStock;
use App\Models\SeminarLibraryCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class SeminarBookNoReturnController extends Controller
{
    
    public function index()
    {

        $depart_id = Session::get('depart_id');
        $unmatchedData = DB::table('seminar_book_issues')
                ->leftJoin('seminar_book_refunds', 'seminar_book_issues.date_of_return_book', '=', 'seminar_book_refunds.date_of_return')
                ->whereNull('seminar_book_refunds.card_id')
                ->where('seminar_book_issues.depart_id',$depart_id)
                ->select('seminar_book_issues.*')
                ->orderBy('seminar_book_issues.date_of_return_book', 'desc')
                ->get();
        return view('backend.seminar_book_no_return', compact('unmatchedData'));
    }


   
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
        //
    }
    
    public function seminarBookNoReturnPdf()
    {    
        $depart_name  = Session::get('depart_name');
        $depart_id = Session::get('depart_id');
        $data = DB::table('seminar_book_issues')
                ->leftJoin('seminar_book_refunds', 'seminar_book_issues.date_of_return_book', '=', 'seminar_book_refunds.date_of_return')
                ->whereNull('seminar_book_refunds.card_id')
                ->where('seminar_book_issues.depart_id',$depart_id)
                ->select('seminar_book_issues.*')
                ->orderBy('seminar_book_issues.date_of_return_book', 'desc')
                ->get();
        $pdf = PDF::loadView('backend.seminar_book_no_return_pdf', compact('data','depart_name'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('seminarbooknoreturn.pdf');
    }
}
