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
                'status' => '<button class="lot-action btn btn-primary" data-id="'.$value->id .'" > '. $value->status .' </button>',
                'options' => '<button class="btn btn-primary btn-sm"> Edit</button> <button class="btn btn-sm btn-danger"> Delete</button>'
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
          $lot = lot::findorfail( $request->id);
            $data = [
                'category' => $lot->category->name,
                'quantity' => $lot->quantity,
                'amount' => $lot->amount,
                'photo'  =>'<img src="'. asset($lot->photo) .'" class="purchaseImg" >',
                'making_charges' => $lot->making_charges,
                'status' => $lot->status,
            ];
          return response()->json($data);
    }
}
