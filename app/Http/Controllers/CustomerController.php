<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Image;
use DB;

class CustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // exit;
        $validate = $request->validate([
            'name' => 'required|unique:customers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:customers',
        ]);

        if($request->photo){
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $target = new Customer;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->photo = $image_url;
            $target->save();
        }
        else{
            $target = new Customer;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->photo = $image_url;
            $target->save();
        }
    }


    public function show($id)
    {
        $target = Customer::where('id',$id)->first();
        return response()->json($target);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $image = $request->newphoto;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/customer/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);
         
         if ($success) {
            $data['photo'] = $image_url;
            $img = DB::table('customers')->where('id',$id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user  = DB::table('customers')->where('id',$id)->update($data);
         }
          
        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('customers')->where('id',$id)->update($data);
        }
    }


    public function destroy($id)
    {
        $target = Customer::find($id);
        if(!empty($target)){
            $photo = $target->photo;
        if($photo){
            unlink($photo);
        }
        $target->delete();
        }
    }
}
