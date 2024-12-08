<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentuserController extends Controller
{
    public function index()
    {
        $data = User::where('faculty'!= 0)->get();

       
        return view('backend.usermanage', compact('data'));
    }
}
