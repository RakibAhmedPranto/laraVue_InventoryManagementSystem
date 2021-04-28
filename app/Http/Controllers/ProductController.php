<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Image;
use DB;

class ProductController extends Controller
{
 

    public function index()
    {
        
        $product = Product::join('categories','products.category_id','categories.id')
        ->join('suppliers','products.supplier_id','suppliers.id')
        ->select('categories.name as category_name','suppliers.name as supplier_name','products.*')
        ->orderBy('products.id','DESC')
        ->get();
        return response()->json($product);
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        //         echo '<pre>';
        // print_r($request->all());
        // exit;

        if($request->image){
            $position = strpos($request->image,';');
            $sub = substr($request->image, 0,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $target = new Product;
            $target->category_id = $request->category_id;
            $target->product_name = $request->product_name;
            $target->product_code = $request->product_code;
            $target->root = $request->root;
            $target->buying_price = $request->buying_price;
            $target->selling_price = $request->selling_price;
            $target->supplier_id = $request->supplier_id;
            $target->buying_date = $request->buying_date;
            $target->product_quantity = $request->product_quantity;
            $target->image = $image_url;
            $target->save();
        }
        else{
            $target = new Product;
            $target->category_id = $request->category_id;
            $target->product_name = $request->product_name;
            $target->product_code = $request->product_code;
            $target->root = $request->root;
            $target->buying_price = $request->buying_price;
            $target->selling_price = $request->selling_price;
            $target->supplier_id = $request->supplier_id;
            $target->buying_date = $request->buying_date;
            $target->product_quantity = $request->product_quantity;
            $target->save();
        }
    }


    public function show($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
       return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;
        $image = $request->newimage;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/product/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);
         
         if ($success) {
            $data['image'] = $image_url;
            $img = DB::table('products')->where('id',$id)->first();
            $image_path = $img->image;
            $done = unlink($image_path);
            $user  = DB::table('products')->where('id',$id)->update($data);
         }
          
        }else{
            $oldphoto = $request->image;
            $data['image'] = $oldphoto;
            $user = DB::table('products')->where('id',$id)->update($data);
        }
    }

    public function destroy($id)
    {
         $product = DB::table('products')->where('id',$id)->first();
       $photo = $product->image;
       if ($photo) {
         unlink($photo);
         DB::table('products')->where('id',$id)->delete();
       }else{
        DB::table('products')->where('id',$id)->delete();
       }
    }

    public function updateStock(Request $request, $id){
        $validate = $request->validate([
            'product_quantity' => 'required',
        ]);

        //                 echo '<pre>';
        // print_r($request->all());
        // exit;
        
        $target = Product::where('id',$id)->first();
        $target->product_quantity = $request->product_quantity;
        $target->save();
    }
}
