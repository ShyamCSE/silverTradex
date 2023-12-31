<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\purchase;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    Public function index(){
        $supplier = supplier::latest()->get();
        $category = Category::latest()->get();
       return view('pages.purchase.index' , compact('supplier','category'));
    }

    Public function create(){
        $purchase = purchase::latest()->get();
      
        $data = $purchase->map(function ($item, $key) {
            return [
                'sno' => $key + 1,
                'category' => $item->category->name ?? '',
                'supplier' => $item->supplier->name ?? '',
                'quality' => $item->quality,
                'quantity' => $item->quantity,
                'current_quantity' => $item->current_quantity,
                'rate'  => getPrice($item->rate),
                'date'  =>  Carbon::parse($item->date)->format('d M y , D'),
                'photo' => $item->photo ? '<img  src="' . asset( $item->photo) . '" class="purchaseImg">' : null,
                'receipt' => $item->receipt ? '<a target="_blank" href="' . asset($item->receipt) . '"> Open </a>' : null,
                'options' => '<button class="btn btn-primary purchase_view" data-purchase="' . htmlspecialchars(json_encode($item)) . '"> View </button> <button class="btn btn-danger  purchase_delete" data-purchase="'. $item->id .'"> Delete </button>'
            ];
        });

        return response()->json( $data);
    }


  
    public function store(Request $request) {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'category' => 'required|integer', 
            'supplier' => 'required|integer',
            'quality' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
            'quantity' => 'required|numeric', 
            'rate' => 'required|numeric', 
            'date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'receipt' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response(['status' => 422, 'message' => $validator->errors()]);
        }
        
    if(isset($request->perchasing_id) && $request->perchasing_id != null){
        $purchase = purchase::findorfail($request->perchasing_id);
    }else{
        $purchase = new purchase;
    }
      
        $purchase->category_id = $request->category;
        $purchase->supplier_id = $request->supplier;
        $purchase->quality = $request->quality;
        $purchase->quantity = $request->quantity;
        $purchase->current_quantity = $request->quantity;
        $purchase->rate = $request->rate;
        $purchase->date = $request->date;
        $purchase->total_price = $request->rate * $request->quantity;
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $uniqueFileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $photoPath = $uploadedFile->move('files', $uniqueFileName );
            $purchase->photo =  $photoPath;
        }
        
        if ($request->hasFile('receipt')) {
            $uploadedReceipt = $request->file('receipt');
            $uniqueReceiptName = time() . '_' . uniqid() . '.' . $uploadedReceipt->getClientOriginalExtension();
            $receiptPath = $uploadedReceipt->move('files', $uniqueReceiptName);
            $purchase->receipt = $receiptPath;
        }
    
        $purchase->save();
    
        return response()->json(['status' => 200, 'data' => $purchase, 'message' => 'Purchase completed successfully']);

    }

    
    public function destroy(string $id)
    {
       $purchase =  purchase::findorfail($id);
       $purchase->delete();
       return response()->json(['success' => true, 'message' => ' purchase delete successfully']);
    }
   
    
}
