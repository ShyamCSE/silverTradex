<?php

namespace App\Http\Controllers;

use App\Models\lot;
use App\Models\purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LotController extends Controller
{

    Public function index(Request $request){
     return view('pages.lot.index');
    }

    Public function getAll(){
        $lot = lot::latest()->get();
        $data = $lot->map(function ($value, $key) {
            return [
                'sno' => $key + 1,
                'photo' => '<img src="' . asset($value->photo) . '" alt="" class="purchaseImg"  />',
                'category' => $value->category->name ?? '',
                'quantity' => $value->quantity,
                'amount' => $value->amount,
                'status' => '<button class="lot-action btn ' . ($value->status == 7 ? 'btn-primary ' : 'btn-success ') . ' btn-sm" data-id="'.$value->id .'" > <i class="fas fa-status" > </i>'. status($value->status) .' </button>',
                'options' => '<button class="btn btn-sm btn-danger"> <i class="fas fa-trash" > </i> Delete</button>'
            ];
        });
       return response()->json($data);
    }

 
    

    public function creare(Request $request)
    {
      $purchase_avl = purchase::whereIn('status', [1,2])
      ->where('category_id' , $request->lotCategory)
      ->sum('current_quantity');
        $validator = Validator::make($request->all(), [
            'lotCategory' => 'required',
            'lotAmount' => 'required',
            'lotQuantity' => "required|integer|max:$purchase_avl",
            'lotPhoto' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response(['status' => 422, 'message' => $validator->errors()]);
        }
        $lot = new lot;
        $lot->category_id = $request->lotCategory;
        $lot->quantity = $request->lotQuantity;
        $lot->amount = $request->lotAmount ?? '';

        if ($request->hasFile('lotPhoto')) {
            $uploadedFile = $request->file('lotPhoto');
            $uniqueFileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $photoPath = $uploadedFile->move('files', $uniqueFileName);
            $lot->photo = $photoPath;
        }
       

        $desiredQuantity = $request->lotQuantity;
        $currentQuantity = 0;
        $selectedProducts = [];
        $averageRate = 0;
        
        $products = purchase::whereIn('status' , [1,2])
            ->where('category_id' , $request->lotCategory)
            ->orderBy('created_at', 'asc')
            ->get();
        
        foreach ($products as $product) {
            $remainingQuantity = $desiredQuantity - $currentQuantity;
        
            if ($product->current_quantity <= $remainingQuantity) {
                $selectedProducts[] = [
                    'category_id' => $product->id,
                    'quantity' => $product->current_quantity,
                    'rate' => $product->rate,
                ];
                $currentQuantity += $product->current_quantity;
                
             
                $product->update([
                    'status' => 0,
                    'current_quantity' => 0,
                ]);
            } else {
                $selectedProducts[] = [
                    'category_id' => $product->id,
                    'quantity' => $remainingQuantity,
                    'rate' => $product->rate,
                ];
                $currentQuantity += $remainingQuantity;
                
              
                $product->update([
                    'status' => 2,
                    'current_quantity' => $product->current_quantity - $remainingQuantity,
                ]);
                
                // Exit the loop as the desired quantity is fulfilled
                break;
            }
        }
        
        // Calculate the average rate based on the selected products
        $totalRate = array_sum(array_column($selectedProducts, 'rate'));
        $averageRate = count($selectedProducts) > 0 ? $totalRate / count($selectedProducts) : 0;
        
        $lot->amount = $averageRate ?? 0;
        $lot->save();

        return response()->json(['status' => 200, 'message' => 'Lot Creation Success']);
    }


    public function getAmount(Request $request)
    {
    
        $desiredQuantity = $request->quantity;
        $currentQuantity = 0;
        $selectedProducts = [];
        $averageRate = 0; 

        $products = purchase::whereIn('status' ,[1,2])
            ->where('category_id' , $request->category)
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($products as $product) {
            $remainingQuantity = $desiredQuantity - $currentQuantity;

            if ($product->current_quantity <= $remainingQuantity) {
                $selectedProducts[] = [
                    'category_id' => $product->id,
                    'quantity' => $product->current_quantity,
                    'rate' => $product->rate,
                ];
                $currentQuantity += $product->current_quantity;
               
            } else {
                $selectedProducts[] = [
                    'category_id' => $product->id,
                    'quantity' => $remainingQuantity,
                    'rate' => $product->rate,
                ];
                $currentQuantity += $remainingQuantity;
                break;
            }
        }

        // Calculate the average rate
        $totalRate = array_sum(array_column($selectedProducts, 'rate'));
        $averageRate = count($selectedProducts) > 0 ? $totalRate / count($selectedProducts) : 0;

        // return [
        //     'selectedProduct' => $selectedProducts,
        //     'averageRate' => $averageRate,
        // ];

        return $averageRate;
    }


    Public function getQuantity( Request $request){
      
        return Purchase::whereIn('status',[1,2])
        ->where('category_id', $request->category_id)
        ->sum('current_quantity');
    
    }

    Public function getById(Request $request){

          $lot = lot::findorfail($request->id);
          return view('pages.lot.lot_model_data' , compact('lot'));
    }

    Public function process(Request $request){
        // return $request->all();
        if($request->status == 2){
            $validator = Validator::make($request->all(), [
                'item_name' => 'required',
                'made_by'   => 'required',
                'making_charges' => 'required|integer',
            ]);
        }
        if($request->status == 3){
            $validator = Validator::make($request->all(), [
            'agent_name'  => 'required',
            'agent_mobile'  => 'required',
            'packed_by'   =>  'required',
            'no_of_packages' => 'required|integer',
            'net_weight'    => 'required|integer',
            'gross_weight'  => 'required|integer',
            'dimension'     =>  'required',
            'courier_charges'  => 'required|integer',
            'packaging_additional_charges' => 'required|integer',
            'packaging_remarks' => 'nullable|min:4',
            ]);
        }
           
           if($request->status == 4){
            $validator = Validator::make($request->all(), [
            'date_of_shipping'   => 'required|date',
            'port_of_loading'    => 'required',
            'shipping_charges'   => 'required|integer',
            'insurance_charges'  => 'required|integer',
            'additional_charges'  => 'required|integer',
            'shipping_remarks'   => 'nullable|min:4',
            ]);
           }

           if($request->status == 5){
            $validator = Validator::make($request->all(), [
            'received_date'      => 'required|date',
            'receipt_no'         => 'required|integer',
            'clearance_charges'  => 'required|integer', 
            'shippment_additional_charges'  => 'required|integer',
            'shippment_remarks' =>  'nullable|min:4',
            ]);
           }
          
          if($request->status == 6){
            $validator = Validator::make($request->all(), [
            'quantity_after_refinery'  =>  'required|integer',
            'refinary_charges'    =>    'required|integer',
            'refinery_report'     => 'required',
           ]);
          }

          if($request->status == 7){
            $validator = Validator::make($request->all(), [
            'sell_rate'  =>  'required|integer',
            'sell_amount'    =>    'required|integer',
            'sell_remarks'     => 'required',
           ]);
          }
        
        if ($validator->fails()) {
            return response(['status' => 422, 'message' => $validator->errors()]);
        }

        $lot = Lot::findOrFail($request->id);

        if($request->status == 2){
            $lot->item_name = $request->item_name;
            $lot->made_by = $request->made_by;
            $lot->making_charges = $request->making_charges;
        }
        
        if($request->status == 3){
            $lot->agent_name = $request->agent_name;
            $lot->agent_mobile = $request->agent_mobile;
            $lot->courier_charges = $request->courier_charges;
            $lot->dimension = $request->dimension;
            $lot->gross_weight = $request->gross_weight;
            $lot->net_weight   = $request->net_weight;
            $lot->no_of_packages = $request->no_of_packages;
            $lot->packaging_additional_charges = $request->packaging_additional_charges;
            $lot->packaging_remarks  = $request->packaging_remarks;
            $lot->packed_by   = $request->packed_by;
         
        }

        if($request->status == 4){
            $lot->date_of_shipping = $request->date_of_shipping;
            $lot->port_of_loading = $request->port_of_loading;
            $lot->shipping_charges = $request->shipping_charges;
            $lot->insurance_charges = $request->insurance_charges;
            $lot->additional_charges = $request->additional_charges;
            $lot->shipping_remarks = $request->shipping_remarks;
        }

        if( $request->status == 5){
            $lot->received_date = $request->received_date;
            $lot->receipt_no = $request->receipt_no;
            $lot->clearance_charges = $request->clearance_charges;
            $lot->shippment_additional_charges = $request->shippment_additional_charges;
            $lot->shippment_remarks = $request->shippment_remarks;
        }
     
      
      if($request->status == 6){
        $lot->quantity_after_refinery = $request->quantity_after_refinery;
        $lot->refinary_charges = $request->refinary_charges;
        $lot->refinery_report = $request->refinery_report;
      }

      if($request->status == 7){
        $lot->sell_rate = $request->sell_rate;
        $lot->sell_amount = $request->sell_amount;
        $lot->sell_remarks = $request->sell_remarks;
      }
     
      if( $lot->status < $request->status ){
        $lot->status = $request->status;
      }
   
        $lot->save();
    
        return response(['status' => 200, 'message' => 'Lot updated successfully']);


    }
}
