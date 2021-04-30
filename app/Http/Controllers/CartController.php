<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;

use Session;

class CartController extends Controller
{
    public function addToCart($id) {
        
            $check = Cart::where('pro_id',$id)->first();
            if ($check) {
                    Cart::where('pro_id',$id)->increment('pro_quantity');
                    $product = Cart::where('pro_id',$id)->first();
                    $subtotal = $product->pro_quantity * $product->product_price;
                    $product->sub_total = $subtotal;
                    $product->save();
                }else{
                $target = Product::where('id', $id)->first();
                if ($target){
                    $data = new Cart;
                    $data->pro_id = $id;
                    $data->pro_name = $target->product_name;
                    $data->pro_quantity = 1;
                    $data->product_price = $target->selling_price;
                    $data->sub_total = $target->selling_price;
                    $data->save();
                }
                }
    }

    public function cartContent() {
        $cartContents = Cart::all();
        return response()->json($cartContents);
    }

    public function removeCartItem($id){
        Cart::where('id',$id)->delete();
        return response('Done');
   
    }
    public function incrementCartItem($id){
        Cart::where('pro_id',$id)->increment('pro_quantity');
        $product = Cart::where('pro_id',$id)->first();
        $subtotal = $product->pro_quantity * $product->product_price;
        $product->sub_total = $subtotal;
        $product->save();
        return response('Done');
   
    }
    public function decrementCartItem($id){
        Cart::where('pro_id',$id)->decrement('pro_quantity');
        $product = Cart::where('pro_id',$id)->first();
        $subtotal = $product->pro_quantity * $product->product_price;
        $product->sub_total = $subtotal;
        $product->save();
        return response('Done');
   
    }
}
