<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        $product= DB::table('products')
                  ->join('categories', 'categories.id','=','products.category_id')
                  ->join('suppliers', 'suppliers.id','=', 'products.supplier_id')
                  ->select('categories.category_name','suppliers.name','products.*')
                  ->orderBy('products.id', 'DESC')
                  ->get();

        return response()->json($product);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_code' => 'required|unique:products|max:255',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required'
        ]);

        $photo = $request->image;

        if ($photo) {
            //php strpos(string,starting point of remove) returns length
            $position= strpos($photo, ';');  
            //php substr(string,start,length) returns string
            $sub = substr($photo, 0, $position); 
            //php explode(separator,string,limit) return a number of array elements
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($photo)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product = new product;
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->root = $request->root;
            $product->product_quantity = $request->product_quantity;
            $product->image = $image_url;
            $product->save();
            
        }else {
            $product = new product;
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_code = $request->product_code;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->root = $request->root;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->save();

        }


    }


    public function show($id)
    {
        $product = DB::table('products')
                  ->where('products.id',$id)
                  ->join('categories', 'categories.id','=','products.category_id')
                  ->join('suppliers', 'suppliers.id','=', 'products.supplier_id')
                  ->select('categories.category_name','suppliers.name','products.*')
                  ->orderBy('products.id', 'DESC')
                  ->first();

        return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        
        $data = array();
            $data['product_name'] = $request->product_name;
            $data['category_id'] = $request->category_id;
            $data['supplier_id'] = $request->supplier_id;
            $data['product_code'] = $request->product_code;
            $data['buying_price'] = $request->buying_price;
            $data['selling_price'] = $request->selling_price;
            $data['buying_date'] = $request->buying_date;
            $data['root'] = $request->root;
            $data['product_quantity'] = $request->product_quantity;

            $image = $request->newimage;

        if ($image) {
            //php strpos(string,starting point of remove) returns length
            $position= strpos($image, ';');  
            //php substr(string,start,length) returns string
            $sub = substr($image, 0, $position); 
            //php explode(separator,string,limit) return a number of array elements
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success= $img->save($image_url);
            if ($success) {
                $data['image'] = $image_url;
                $img_old = DB::table('products')->where('id',$id)->first();
                $img_old_path = $img_old->image;
                
                if ($img_old_path) {
                    $delete_photo = unlink($img_old_path);
                }

                DB::table('products')->where('id',$id)->update($data);
            }

        }else {
            $old_image = $request->image;
            $data['image'] = $old_image;
            DB::table('products')->where('id',$id)->update($data);

        }
    }

    
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $image = $product->image;

        if ($image) {
            unlink($image);
            DB::table('products')->where('id', $id)->delete();
        }else {
            DB::table('products')->where('id', $id)->delete();
        }
        
    }
}
