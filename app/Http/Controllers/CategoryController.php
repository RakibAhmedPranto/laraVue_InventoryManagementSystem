<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // exit;
        $validate = $request->validate([
            'name' => 'required',
        ]);

        $target = new Category;
        $target->name = $request->name;
        $target->save();
    }

    public function show($id)
    {
        $target = Category::where('id',$id)->first();
        return response()->json($target);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        DB::table('categories')->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        $target = Category::find($id);
        if(!empty($target)){
            $target->delete();
        }
    }
}
