<?php

namespace App\Http\Controllers;

use toastr;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    Public function index(){
        $category = Category::with('purchase')->latest()->get();
      
        return view('pages.category' , compact('category'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
    
        try {
            $category = Category::create(['name' => $request->name]);
           return redirect()->back()->with('success', 'Category has been created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    Public function edit(Request $request){
     $category  =  Category::findorfail($request->id);
     $category->name = $request->name;
     $category->save();
    
       return redirect()->back()->with('success', 'Category has been updated');
    }


    Public function delete(Request $request){
        $category  =  Category::findorfail($request->id);
        $category->delete();
        return redirect()->back()->with('success', 'Category delete successfully');
    }

    Public function getall(){
        $category = Category::latest()->get();
        $data = $category->map( function($value){
          return [
            'id' => $value->id,
            'name' => $value->name,
          ];
        });
        return response()->json($data);
    }
    
}
