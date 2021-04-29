<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class PosController extends Controller
{
    public function categoryWiseProduct($id){
        $products = Product::where('category_id',$id)->get();
        return response()->json($products);
    }
}
