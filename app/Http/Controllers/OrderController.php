<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Product;

class OrderController extends Controller
{
    public function today(){
        $data = date('d/m/Y');
        $order = Order::join('customers','orders.customer_id','customers.id')
           ->where('order_date',$data)
           ->select('customers.name','orders.*')
           ->orderBy('orders.id','DESC')->get();
        return response()->json($order);
    }

    public function allOrder(){

        $data = date('d/m/Y');
        $order = Order::join('customers','orders.customer_id','customers.id')
           ->select('customers.name','orders.*')
           ->orderBy('orders.id','DESC')->get();
        return response()->json($order);
    }

    public function orderDetails($id){
        //return response()->json($id);
        $order = Order::join('customers','orders.customer_id','customers.id')
          ->where('orders.id',$id)
          ->select('customers.name','customers.phone','customers.address','orders.*')
          ->first();
        return response()->json($order);
    }


    public function orderDetailsAll($id){

        $details = OrderDetail::join('products','order_details.product_id','products.id')
            ->where('order_details.order_id',$id)
            ->select('products.product_name','products.product_code','products.image','order_details.*')
            ->get();
        return response()->json($details);
    }
}
