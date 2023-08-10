<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use DB;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee= Employee::all();
        return response()->json($employee);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|unique:employees|max:255'
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
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->joining_date = $request->joining_date;
            $employee->salary = $request->salary;
            $employee->photo = $image_url;
            $employee->save();
            
        }else {
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->joining_date = $request->joining_date;
            $employee->salary = $request->salary;
            $employee->save();

        }


    }


    public function show($id)
    {
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
    }


    public function update(Request $request, $id)
    {
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['phone'] = $request->phone;
            $data['joining_date'] = $request->joining_date;
            $data['salary'] = $request->salary;

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
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $success= $img->save($image_url);
            if ($success) {
                $data['photo'] = $image_url;
                $img_old = DB::table('employees')->where('id',$id)->first();
                $img_old_path = $img_old->photo;
                $delete_photo = unlink($img_old_path);
                DB::table('employees')->where('id',$id)->update($data);
            }

        }else {
            $old_image = $request->photo;
            $data['photo'] = $old_image;
            DB::table('employees')->where('id',$id)->update($data);

        }
    }

    
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;

        if ($photo) {
            unlink($photo);
            DB::table('employees')->where('id', $id)->delete();
        }else {
            DB::table('employees')->where('id', $id)->delete();
        }
        
    }
}
