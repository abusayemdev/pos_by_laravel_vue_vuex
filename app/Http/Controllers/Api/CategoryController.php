<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category= Category::all();
        return response()->json($category);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
    }


    public function show($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
        return response()->json($category);
    }


    public function update(Request $request, $id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;

        DB::table('categories')->where('id',$id)->update($data);

    }

    
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
    }
    
}
