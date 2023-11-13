<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('pages.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::latest()->get();
    
        $data = [];
        
        foreach ($suppliers as $key => $supplier) {
            $statusButton = $supplier->status == 1
            ? '<button class="btn btn-primary btn-sm suppplierStatus" data-supplier="'. $supplier->id . '">Active</button>'
            : '<button class="btn btn-danger btn-sm suppplierStatus" data-supplier="'. $supplier->id . '">Deactive</button>';

            $data[] = [
                'sno'  => $key + 1,
                'id' => $supplier->id,
                'name' => $supplier->name,
                'phone' => $supplier->phone,
                'email' => $supplier->email,
                'company_name' => $supplier->componey_name,
                'address' => $supplier->address,
                'status' => $statusButton,
                'order' => $supplier->order,
                'created_at' => $supplier->created_at,
                'updated_at' => $supplier->updated_at,
                'options' => '<button class="btn btn-success btn-sm supplierView" data-supplier="' . htmlspecialchars(json_encode($supplier)) . '"><i class="fas fa-eye"></i> View</button> <button class="btn btn-sm btn-danger supplierDelete" data-supplier="' . $supplier->id . '"><i class="fas fa-trash"></i> Delete</button>',

            ];
        }
    
        return response()->json($data);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        if(isset($request->supplier_id ) && $request->supplier_id != null){
            $Supplier =  Supplier::findorfail($request->supplier_id);
        }else{
            $Supplier = new Supplier;
        }
        $Supplier->name = $request->input('name');
        $Supplier->phone = $request->phone;
        $Supplier->email = $request->email;
        $Supplier->componey_name = $request->company_name;
        $Supplier->address = $request->supplier_address;
        $Supplier->order = $request->order ?? Supplier::max('order') + 1;
        $Supplier->save();

    return response()->json(['success' => true, 'message' => 'New supplier created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier =  Supplier::findorfail($id);
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
       $supplier =  Supplier::findorfail($id);
       $supplier->delete();
       return response()->json(['success' => true, 'message' => ' supplier delete successfully']);
    }
}
