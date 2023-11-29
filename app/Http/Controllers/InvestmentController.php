<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{
    public function index()
    {
        return view('pages.investment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Investments = Investment::latest()->get();
    
        $data = [];
        
        foreach ($Investments as $key => $Investment) {
          

            $data[] = [
                'sno'  => $key + 1,
                'id' => $Investment->id,
                'name' => $Investment->name,
                'phone' => $Investment->mobile,
                'email' => $Investment->email,
                'amount' => getPrice($Investment->amount),
                'invest_date' => $Investment->invest_date,
             
                'options' => '<button class="btn btn-success btn-sm InvesterView" data-invester="' . htmlspecialchars(json_encode($Investment)) . '"><i class="fas fa-eye"></i> View</button> <button class="btn btn-sm btn-danger investerDelete" data-invester="' . $Investment->id . '"><i class="fas fa-trash"></i> Delete</button>',

            ];
        }
    
        return response()->json($data);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        if(isset($request->invester_id ) && $request->invester_id != null){
            $Supplier =  Investment::findorfail($request->invester_id);
        }else{
            $Supplier = new Investment;
        }
        $Supplier->name = $request->input('name');
        $Supplier->mobile = $request->mobile;
        $Supplier->email = $request->email;
        $Supplier->amount = $request->amount;
        $Supplier->invest_date = $request->invest_date;
      
        $Supplier->save();

    return response()->json(['success' => true, 'message' => 'New Investment created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier =  Investment::findorfail($id);
        $supplier->status = $supplier->status == 1 ? 0 : 1;
        $supplier->save();
        return response()->json(['success' => true, 'message' => ' supplier status update successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
       $supplier =  Investment::findorfail($id);
       $supplier->delete();
       return response()->json(['success' => true, 'message' => ' supplier delete successfully']);
    }
}
