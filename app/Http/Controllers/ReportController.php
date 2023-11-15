<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    Public function index(){
        return view('pages.reports.index');
    }

    Public function balanceStatement(Request $request){
     
    }
}
