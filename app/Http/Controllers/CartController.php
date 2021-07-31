<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function AddToCart(Request $request)
    {
        $invoice_no = $request->input('invoice_no');
        $invoice_date = $request->input('invoice_date');
        $product_name = $request->input('product_name');
        $product_quantity = $request->input('product_quantity');
        $unit_price = $request->input('unit_price');
        $total_price = $request->input('total_price');
        $seller_name = $request->input('seller_name');
        $product_icon = $request->input('product_icon');

        $result = CartModel::insert([
            'invoice_no'=>$invoice_no,
            'invoice_date'=>$invoice_date,
            'product_name'=>$product_name,
            'product_quantity'=>$product_quantity,
            'unit_price'=>$unit_price,
            'total_price'=>$total_price,
            'seller_name'=>$seller_name,
            'product_icon'=>$product_icon
        ]);

        return $result;
    }


    function CartList(Request $request)
    {
        $invoice = $request->invoice;
        $result = CartModel::where('invoice_no',$invoice)->get();
        return $result;
    }
}
