<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function all_order()
    {
        $orders = DB::table('orders')->select('order_date')->groupBy('order_date')->get();

        return response()->json($orders);

    }

    public function day_order($id)
    {
        
         $byday_orders = DB::table('orders')
                            ->join('customers','customers.id','=','orders.customer_id')
                            ->where('orders.order_date',$id)
                            ->select('customers.name','orders.*')
                            ->orderBy('orders.id','DESC')
                            ->get();

        return response()->json($byday_orders);
    }

    public function order_details($id)
    {
        $order = DB::table('orders')
                            ->join('customers','customers.id','=','orders.customer_id')
                            ->where('orders.id',$id)
                            ->select('customers.name','customers.phone','customers.address','orders.*')
                            ->first();
                    
        return response()->json($order);

    }

    public function order_details_all($id)
    {
        $order_details = DB::table('order_details')
                           ->join('products','products.id','order_details.product_id')
                           ->where('order_details.order_id',$id)
                           ->select('products.product_name','products.product_code','products.image','order_details.*')
                           ->get();
        
        return response()->json($order_details);
    }

    public function shop_details(){
        $shop_details = DB::table('extra')->first();
        
        return response()->json($shop_details);
    }


}
