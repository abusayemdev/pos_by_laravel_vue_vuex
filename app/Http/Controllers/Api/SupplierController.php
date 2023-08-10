<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;
use Image;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier= Supplier::all();
        return response()->json($supplier);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|unique:suppliers|max:255'
        ]);

        $image = $request->photo;

        if ($image) {
            //php strpos(string,starting point of remove) returns length
            $position= strpos($image, ';');  
            //php substr(string,start,length) returns string
            $sub = substr($image, 0, $position); 
            //php explode(separator,string,limit) return a number of array elements
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $supplier = new supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->photo = $image_url;
            $supplier->save();
            
        }else {
            $supplier = new supplier;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->save();
        }
    }


    public function show($id)
    {
        $supplier = DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
    }


    public function update(Request $request, $id)
    {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['phone'] = $request->phone;
            $data['shopname'] = $request->shopname;

            $image = $request->newphoto;

        if ($image) {
            //php strpos(string,starting point of remove) returns length
            $position= strpos($image, ';');  
            //php substr(string,start,length) returns string
            $sub = substr($image, 0, $position); 
            //php explode(separator,string,limit) return a number of array elements
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $success= $img->save($image_url);
            if ($success) {
                $data['photo'] = $image_url;
                $img_old = DB::table('suppliers')->where('id',$id)->first();
                $img_old_path = $img_old->photo;
                $delete_photo = unlink($img_old_path);
                DB::table('suppliers')->where('id',$id)->update($data);
            }

        }else {
            $old_image = $request->photo;
            $data['photo'] = $old_image;
            DB::table('suppliers')->where('id',$id)->update($data);

        }
    }

    
    public function destroy($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $photo = $supplier->photo;

        if ($photo) {
            unlink($photo);
            DB::table('suppliers')->where('id', $id)->delete();
        }else {
            DB::table('suppliers')->where('id', $id)->delete();
        }
    }

}
