<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportInvestment;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\purchase;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }


    public function balanceStatement(Request $request)
    {

        if ($request->ajax()) {

            $dateRange = get_date($request->filter);
            $startDate = $dateRange['start_date'];
            $endDate = $dateRange['end_date'];

            $investment = Investment::select('id', 'amount as credit_amount', 'invest_date as transaction_date', 'created_at')
                ->whereNotNull('invest_date')
                ->whereNull('deleted_at')
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->whereDate('invest_date', '>=', $startDate);
                })
                ->when($endDate, function ($query) use ($endDate) {
                    return $query->whereDate('invest_date', '<=', $endDate);
                })
                ->latest()->get();

            $purchase = Purchase::select('id', 'total_price as debit_amount', 'date as transaction_date', 'created_at')
                ->whereNull('deleted_at')
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->whereDate('date', '>=', $startDate);
                })
                ->when($endDate, function ($query) use ($endDate) {
                    return $query->whereDate('date', '<=', $endDate);
                })
                ->latest()->get();


            $mergedData = $investment->map(function ($inv) use ($purchase) {
                $matchedPurchase = $purchase->where('transaction_date', $inv->transaction_date)->first();

                return [
                    'transaction_date' => $inv->transaction_date ?  \Carbon\Carbon::parse($inv->transaction_date)->format('d M Y') : null,
                    'credit'           => $inv->credit_amount,
                    'debit'            => $matchedPurchase ? (int)$matchedPurchase->debit_amount : null,
                ];
            });


            $unmatchedPurchases = $purchase->whereNotIn('transaction_date', $investment->pluck('transaction_date')->toArray());

            $mergedData = $mergedData->merge(
                $unmatchedPurchases->map(function ($pur) {
                    return [
                        'transaction_date' => $pur->transaction_date ?  \Carbon\Carbon::parse($pur->transaction_date)->format('d M Y') : null,
                        'credit'           => null,
                        'debit'            => (int)$pur->debit_amount,
                    ];
                })
            );

            $overAll['credit'] = $mergedData->sum('credit');
            $overAll['debit'] = $mergedData->sum('debit');
            $overAll['current'] = $mergedData->sum('credit') - $mergedData->sum('debit');

            return response()->json(['all' => $mergedData, 'overall' => $overAll]);
        }


        return view('pages.reports.balanceSatement');
    }


    public function balanceStatementExport(){
        return Excel::download(new ExportInvestment(), 'balanceStatement.xlsx');
    }
}
