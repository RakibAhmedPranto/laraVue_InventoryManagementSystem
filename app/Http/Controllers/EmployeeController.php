<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Image;
use DB;

class EmployeeController extends Controller
{

    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
            'sallery' => 'required',
            'joining_date' => 'required',
        ]);

        if($request->photo){
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $target = new Employee;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->sallery = $request->sallery;
            $target->joining_date = $request->joining_date;
            $target->nid = $request->nid;
            $target->photo = $image_url;
            $target->save();
        }
        else{
            $target = new Employee;
            $target->name = $request->name;
            $target->email = $request->email;
            $target->phone = $request->phone;
            $target->address = $request->address;
            $target->sallery = $request->sallery;
            $target->joining_date = $request->joining_date;
            $target->nid = $request->nid;
            $target->save();
        }
    }

    public function show($id)
    {
        $target = Employee::where('id',$id)->first();
        return response()->json($target);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['sallery'] = $request->sallery;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;
        $image = $request->newphoto;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/employee/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);
         
         if ($success) {
            $data['photo'] = $image_url;
            $img = DB::table('employees')->where('id',$id)->first();
            $image_path = $img->photo;
            $done = unlink($image_path);
            $user  = DB::table('employees')->where('id',$id)->update($data);
         }
          
        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('employees')->where('id',$id)->update($data);
        }
    }

    public function destroy($id)
    {
        $target = Employee::find($id);
        if(!empty($target)){
            $photo = $target->photo;
        if($photo){
            unlink($photo);
        }
        $target->delete();
        }
    }
}
