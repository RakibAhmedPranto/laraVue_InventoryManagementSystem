<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\OrderDetail;
use App\Cart;
use App\Expense;
use DB;
use DateTime;

class PosController extends Controller
{
    public function categoryWiseProduct($id){
        $products = Product::where('category_id',$id)->get();
        return response()->json($products);
    }


    public function orderDone(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // exit;

        $validate = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
        ]);

        $data = new Order;
        $data->customer_id = $request->customer_id;
        $data->qty = $request->qty;
        $data->sub_total = $request->subtotal;
        $data->pay = $request->pay;
        $data->due = $request->due;
        $data->payby = $request->payby;
        $data->order_date = date('d/m/Y');
        $data->order_month = date('F');
        $data->order_year = date('Y');
        DB::beginTransaction();
        try {
            if ($data->save()) {
                $contents = Cart::get();
                foreach ($contents as $content) {
                    $odata = new OrderDetail;
                    $odata['order_id'] = $data->id;
                    $odata['product_id'] = $content->pro_id;
                    $odata['pro_quantity'] = $content->pro_quantity;
                    $odata['product_price'] = $content->product_price;
                    $odata['sub_total'] = $content->sub_total;
                    if($odata->save()){
                        DB::table('products')
                        ->where('id',$content->pro_id)
                        ->update(['product_quantity' => DB::raw('product_quantity -' .$content->pro_quantity)]);
                    }
                }
                DB::table('carts')->delete();
            }
            DB::commit();
            return response('Done');
        } catch (\Throwable $e) {
            DB::rollback();
            return response($e);
        }

    }

    public function TodaySell(){
        $date = date('d/m/Y');
        $sell = Order::where('order_date',$date)->sum('sub_total');
        return response()->json($sell);
      }

      public function TodayIncome(){
        $date = date('d/m/Y');
        $income = Order::where('order_date',$date)->sum('pay');
        return response()->json($income);
      }

       public function TodayDue(){
        $date = date('d/m/Y');
        $todaydue = Order::where('order_date',$date)->sum('due');
        return response()->json($todaydue);
      }


      public function TodayExpense(){
       $date = date('d/m/Y');
        $expense = Expense::where('expense_date',$date)->sum('amount');
        return response()->json($expense);
      }

    public function Stockout(){

     $product = Product::where('product_quantity','<','1')->get();
     return response()->json($product);

    }


}
