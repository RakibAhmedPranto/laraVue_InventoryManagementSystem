<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Image;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // exit;
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if($request->photo){
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $target = new Supplier;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->shop_name = $request->shop_name;
            $target->photo = $image_url;
            $target->save();
        }
        else{
            $target = new Supplier;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->shop_name = $request->shop_name;
            $target->save();
        }
    }

    public function show($id)
    {
        $target = Supplier::where('id',$id)->first();
        return response()->json($target);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shop_name'] = $request->shop_name;
        $image = $request->newphoto;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/supplier/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);

         if ($success) {
            $data['photo'] = $image_url;
            $img = DB::table('suppliers')->where('id',$id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user  = DB::table('suppliers')->where('id',$id)->update($data);
         }

        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('suppliers')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Supplier::find($id);
        if(!empty($target)){
            $photo = $target->photo;
        if($photo){
            unlink($photo);
        }
        $target->delete();
        }
    }
}
