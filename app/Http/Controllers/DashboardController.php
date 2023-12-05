<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\purchase;
use App\Models\supplier;
use App\Models\Investment;
use App\Models\lot;
use Illuminate\Support\Carbon;
use DateTime;

class DashboardController extends Controller
{
    Public function index(Request $request){

        if ($request->ajax()) {
            $category = Category::with('purchase')->latest()->get();
            $stock = [];
           
        
            foreach ($category as $item) {
                $stock[] = [
                    'name' => $item->name,
                    'quantity' => $item->purchase->sum('current_quantity') ?? 0,
                ];
        
             
            }
            $investment = Investment::sum('amount');
            $purchase = (int) Purchase::sum('total_price');
            
            if ($investment && $purchase) {
                $balanceAmount = $investment - $purchase;
            } else {
                $balanceAmount = "Invalid ";
            }
            $lot = lot::count();


            $purchase_charge = 0;
            $otherCharges    = 0;
            $sell = 0;
             $lot_net_profit = lot::get();
                foreach($lot_net_profit as $value){

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

                  $purchase_charge += $value->quantity * $value->amount;
                  $otherCharges +=  $total_charges;
                  $sell = $value->quantity_after_refinery + $value->sell_rate;
                 
                }
              $net_profit = $sell - ( $purchase_charge + $otherCharges);




              // Payment Activity



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

              $expense = [];
              $expense[] = [
                'making_charges' => $lot_net_profit->sum('making_charges'),
                'courier_charges' =>  $lot_net_profit->sum('courier_charges'),
                'packaging_additional_charges'=>  $lot_net_profit->sum('packaging_additional_charges'),
                'shipping_charges'=>  $lot_net_profit->sum('shipping_charges'),
                'insurance_charges'=>  $lot_net_profit->sum('insurance_charges'),
                'additional_charges'=>  $lot_net_profit->sum('additional_charges'),
                'clearance_charges'=>  $lot_net_profit->sum('clearance_charges'),
                'shippment_additional_charges'=>  $lot_net_profit->sum('shippment_additional_charges'),
                'refinary_charges' =>  $lot_net_profit->sum('refinary_charges'),
              ];
             
              $expense_payment_overview = purchase::select('date', 'total_price as value')->get();
              $investment_payment_overview = Investment::select('invest_date as date', 'amount as value')->get();
              
              $combined_data = $expense_payment_overview->merge($investment_payment_overview);
              
              $monthly_data = [];
              
    
              $start_date = new DateTime('first day of January 2023');
              $end_date = new DateTime('last day of December 2023');
              
              while ($start_date <= $end_date) {
            
                  $month_year = $start_date->format('F Y');
              
                  $monthly_data[$month_year] = ['credit' => 0, 'debit' => 0];
                  $start_date->modify('+1 month');
              }
              
              foreach ($combined_data as $record) {
                  $month_year = date('F Y', strtotime($record->date));
                  $category = $record instanceof purchase ? 'debit' : 'credit';
                  $monthly_data[$month_year][$category] += $record->value;
              }

            return response()->json(['stock' => $stock , 'balanceAmount' => $balanceAmount  , 'lot' => $lot , 'net_profit' => $net_profit ,
             'payment_activity' => $overAll , 'expense' => $monthly_data ]);
        }
        
        

        return view('dashboard');
     
    }
}
