<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{

    public function today_sell()
    {
        $date = date('d-m-Y');
        $sell = DB::table('orders')->where('order_date',$date)->sum('total');

        return response()->json($sell);

    }


    public function today_orders()
    {
        $date = date('d-m-Y');
        $orders = DB::table('orders')->where('order_date',$date)->count();

        return response()->json($orders);
        
    }

    public function today_expense()
    {
        $date = date('d/m/Y');
        $expense = DB::table('expenses')->where('expense_date',$date)->sum('expense_amount');

        return response()->json($expense);

        
    }

    public function today_stockin()
    {

        $date = date('Y-m-d');
        
        $stockin = DB::table('products')->where('buying_date',$date)->count();

        return response()->json($stockin);
    }



    public function stockout()
    {
        
        $stockout = DB::table('products')->where('product_quantity','<','1')->get();

        return response()->json($stockout);
    }

    
}
