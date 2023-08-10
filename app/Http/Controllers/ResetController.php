<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use DB;

class ResetController extends Controller
{
    public function forget(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required'
        ]);

        $user = DB::table('users')->where('email',$request->email)->first();
        $user_email = $user->email;

        if ($user_email == $request->email) {
           
            return $user;
        }else {
            return response()->json(['message' => 'Email not found!']);
        }

    }


    public function newpassword(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $data = array();
        $data['password'] = Hash::make($request->password);
        DB::table('users')->update($data);

        return response()->json(['message' => 'Password Updated!']);
    }

}
