<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\purchase;
use App\Models\supplier;
use App\Models\Investment;
use App\Models\lot;

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

            return response()->json(['stock' => $stock , 'balanceAmount' => $balanceAmount  , 'lot' => $lot ]);
        }
        
        

        return view('dashboard');
     
    }
}
