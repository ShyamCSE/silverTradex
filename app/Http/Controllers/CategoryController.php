<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    Public function index(){
        $category = Category::paginate(10);
        return view('pages.category' , compact('category'));
    }
}
