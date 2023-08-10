<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StocksController extends Controller
{
    public function update_stocks(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_quantity' => 'required',
        
        ]);
        
        $data = array();
        $data['product_quantity'] = $request->product_quantity;

        DB::table('products')->where('id',$id)->update($data);

    }
}
