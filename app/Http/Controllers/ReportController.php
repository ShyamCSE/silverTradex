<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportInvestment;
use App\Exports\PurchaseExport;
use App\Exports\LotsExport;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\purchase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\lot;

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
                        'transaction_date' => $pur->transaction_date ?  Carbon::parse($pur->transaction_date)->format('d M Y') : null,
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


    Public function purchaseStatement(Request $request){
      
        if($request->ajax()){
           
            $dateRange = get_date($request->filter);
            $startDate = $dateRange['start_date'];
            $endDate = $dateRange['end_date'];

            $purchase = purchase::whereNull('deleted_at')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('date', '<=', $endDate);
            })
            ->latest();

            if(isset($request->category) && $request->category != null ){
                $purchase->where('category_id' , $request->category );
            }

            if(isset($request->supplier) && $request->supplier != null ){
                $purchase->where('supplier_id' , $request->supplier );
            }

            $data = $purchase->get()->map( function($value ){

                return [
                  'sno' => $value->index + 1,
                  'category' => $value->category?->name,
                  'supplier' => $value->supplier?->name,
                  'quantity' => $value->quantity,
                  'current_quantity' => $value->current_quantity,
                  'rate' => $value->rate,
                  'total_price' => $value->total_price,
                  'date'  => Carbon::parse($value->date)->format('d M y , D'),
                  'created_at' => Carbon::parse($value->created_at)->format('d M y , D'),
                ];
            });

            $overAll['credit'] = $purchase->sum('quantity');
            $overAll['debit'] = $purchase->where('status', [0, 2])->sum('quantity') - $purchase->where('status', [0, 2])->sum('current_quantity');
            $overAll['current'] = $overAll['credit'] - $overAll['debit'];            

            return response()->json(['all' => $data, 'overall' => $overAll]);

        };
        return view('pages.reports.purchase');
    }

    public function purchaseStatementExport(){
        return Excel::download(new PurchaseExport(), 'purchaseStatement.xlsx');
    }


    Public function lotStatement(Request $request){
       
        if($request->ajax()){
            $dateRange = get_date($request->filter);
            $startDate = $dateRange['start_date'];
            $endDate = $dateRange['end_date'];

            $lot = lot::when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->latest();

            if(isset($request->category) && $request->category != null ){
                $lot->where('category_id' , $request->category );
            }

            if(isset($request->status) && $request->status != null ){
                $lot->where('status' , $request->status );
            }

         

            $data = $lot->get()->map( function($value , $key){

                $charges = [
                    'making_charges',
                    'courier_charges',
                    'packaging_additional_charges',
                    'shipping_charges',
                    'insurance_charges',
                    'additional_charges',
                    'clearance_charges',
                    'shippment_additional_charges',
                    'refinary_charges'
                ];

                $total_charges = array_sum(array_map(function($charge) use ($value) {  return $value->$charge; }, $charges));

               
                return [
                   'sno' => $key + 1,
                  'category' => $value->category?->name,
                  'quantity' => $value->quantity,
                  'amount' => $value->amount,
                  'net_weight' => $value->net_weight,
                  'no_of_packages' => $value->no_of_packages,
                  'loss'   => (($value->quantity - $value->quantity_after_refinery) / $value->quantity) * 100 ?? '',
                  'total_charges' => $total_charges,
                  'sell'   => $value->quantity_after_refinery * $value->sell_rate ,
                  'cash_flow' => (($value->quantity * $value->amount) + $total_charges) - ($value->quantity_after_refinery * $value->sell_rate ),
                  'created_at' => Carbon::parse($value->created_at)->format('d M y , D'),
                  'status' => '<button class="btn ' . ($value->status == 7 ? 'btn-primary ' : 'btn-success ') . '">' . status($value->status) . '</button>',
                ];
            });


            $overall['total_lot'] = $lot->count();
            $overall['complete_lot'] = $lot->where('status' , 7)->count();

            return response()->json(['all' => $data , 'overall' => $overall ]);
        }
        return view('pages.reports.lot');

    }

    Public function lotStatementExport(Request $request){
       
        return Excel::download(new LotsExport(), 'lotStatement.xlsx');
    }

}
