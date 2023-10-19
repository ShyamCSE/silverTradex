<?php

namespace App\Http\Controllers;

use App\Models\lot;
use App\Models\purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LotController extends Controller
{
    Public function creare(Request $request){

        $validator = Validator::make($request->all(), [
            'lotCategory' => 'required',
            // 'lotAmount' => 'required|integer',
            'lotQuantity' => 'required|integer',
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
            $photoPath = $uploadedFile->storeAs('files', $uniqueFileName, 'public');
            $lot->photo = $photoPath;
        }
        $lot->save(); 
        return response()->json(['status' => 200 , 'message' => 'Lot Creation Success']);

    }


    Public function getAmount(Request $request){


$desiredQuantity = $request->quantity; 
$currentQuantity = 0; 
$selectedProducts = [];


$products = purchase::where(['status' => 1 , 'category_id' => $request->category_id ])->orderBy('created_at', 'asc')->get();

foreach ($products as $product) {
    $remainingQuantity = $desiredQuantity - $currentQuantity;

    if ($product->current_quantity <= $remainingQuantity) {
     
        $selectedProducts[] = [
            'category_id' => $product->id,
            'quantity' => $product->current_quantity,
            'rate'     => $product->rate
        ];

        $currentQuantity += $product->current_quantity;

        $product->update(['status' => 2 , 'current_quantity' => 0 ]);
    } else {
        $selectedProducts[] = [
            'category_id' => $product->id,
            'quantity' => $remainingQuantity,
            'rate' => $product->rate
        ];
        $currentQuantity += $remainingQuantity;
    
        // Update the product's remaining quantity and set its status to 3
        $product->update([
            'current_quantity' => $product->current_quantity - $remainingQuantity,
            'status' => 3
        ]);
    
        break;
    }
}


//  $data = array();
//  foreach ($selectedProducts as $list){
//       $data[]['totalQuantity'] += $list['quantity'];
//        $data[]['totalprice'] += $list['rate'];
//  }

return [ 'selectedProduct ' =>$selectedProducts];


    }

    
}
