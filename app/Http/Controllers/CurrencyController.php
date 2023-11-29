<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
       
        $data = Currency::where('status', 1)->get();
        return response()->json(compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
        $selectedCurrencies = Currency::where('selected', 1)->get();
    
        foreach ($selectedCurrencies as $selectedCurrency) {
            $selectedCurrency->selected = 0;
            $selectedCurrency->save();
        }

        $currency = Currency::findOrFail($id);
        $currency->selected = 1;
        $currency->save();
        return response()->json(['status' => true ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
