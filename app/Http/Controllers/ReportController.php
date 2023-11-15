<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportInvestment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    Public function index(){
        return view('pages.reports.index');
    }

    public function balanceStatement(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
  
        $filename = 'InvestmentStatement.xlsx';
        return Excel::download(new ExportInvestment($startDate, $endDate), $filename);
    }
}
