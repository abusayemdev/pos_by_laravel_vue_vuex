<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function add_to_cart(Request $request, $id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        $check = DB::table('pos')->where('pro_id',$id)->first();

        if ($check) {
            DB::table('pos')->where('pro_id',$id)->increment('pro_quantity');

            $product = DB::table('pos')->where('pro_id',$id)->first();

            $subtotal =$product->pro_quantity * $product->pro_price;

            DB::table('pos')->where('pro_id',$id)->update(['sub_total' => $subtotal]);
        }else {
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['pro_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;

            DB::table('pos')->insert($data);
        }

        

        return response()->json('done');

    }

    public function cart_product()
    {
        $cart = DB::table('pos')->get();

        return response()->json($cart);
    }

    public function remove_cart($id)
    {
        DB::table('pos')->where('id',$id)->delete();
    }

    public function increment_cart($id)
    {
        DB::table('pos')->where('id',$id)->increment('pro_quantity');

        $product = DB::table('pos')->where('id',$id)->first();

        $subtotal =$product->pro_quantity * $product->pro_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

    }

    public function decrement_cart($id)
    {
        DB::table('pos')->where('id',$id)->decrement('pro_quantity');

        $product = DB::table('pos')->where('id',$id)->first();

        $subtotal =$product->pro_quantity * $product->pro_price;

        DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);

    }

    public function vat()
    {
        $vat = DB::table('extra')->first();

        return response()->json($vat);
    }

    public function order_done(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
        ]);

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['qty'] = $request->qty;
        $data['sub_total'] = $request->subtotal;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payby'] = $request->payby;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['order_date'] = date('d-m-Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');
        

        $order_id = DB::table('orders')->insertGetId($data);

        $contents = DB::table('pos')->get();

        $order_data = array();
        foreach ($contents as $content) {
            $order_data['order_id'] = $order_id;
            $order_data['product_id'] = $content->pro_id;
            $order_data['pro_quantity'] = $content->pro_quantity;
            $order_data['pro_price'] = $content->pro_price;
            $order_data['sub_total'] = $content->sub_total;

            DB::table('order_details')->insert($order_data);

            DB::table('products')
                    ->where('id', $content->pro_id)
                    ->update(['product_quantity' => DB::raw('product_quantity -'.$content->pro_quantity)]);
        }

        DB::table('pos')->delete();

    }



}
