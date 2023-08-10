<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use Image;

class CustomerController extends Controller
{
    public function index()
    {
        $customer= Customer::all();
        return response()->json($customer);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|unique:customers|max:255'
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
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->photo = $image_url;
            $customer->save();
            
        }else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;

            $customer->save();

        }


    }


    public function show($id)
    {
        $customer = DB::table('customers')->where('id',$id)->first();
        return response()->json($customer);
    }


    public function update(Request $request, $id)
    {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['phone'] = $request->phone;

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
            $upload_path = 'backend/customer/';
            $image_url = $upload_path.$name;
            $success= $img->save($image_url);
            if ($success) {
                $data['photo'] = $image_url;
                $img_old = DB::table('customers')->where('id',$id)->first();
                $img_old_path = $img_old->photo;
                $delete_photo = unlink($img_old_path);
                DB::table('customers')->where('id',$id)->update($data);
            }

        }else {
            $old_image = $request->photo;
            $data['photo'] = $old_image;
            DB::table('customers')->where('id',$id)->update($data);

        }
    }

    
    public function destroy($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        $photo = $customer->photo;

        if ($photo) {
            unlink($photo);
            DB::table('customers')->where('id', $id)->delete();
        }else {
            DB::table('customers')->where('id', $id)->delete();
        }
        
    }
}
