<?php

namespace App\Http\Controllers;

use App\Models\ProductCartModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    function ProductCart(Request $request)
    {

        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');
        $seller_name = $request->input('seller_name');

        $product_item = ProductModel::where('product_code',$product_code)->get();

        $product_name = $product_item[0]['product_name'];
        $product_code = $product_item[0]['product_code'];
        $product_image = $product_item[0]['product_icon'];
        $product_unit_price = $product_item[0]['product_price'];
        $product_category = $product_item[0]['product_category'];

       $result= ProductCartModel::insert([
            "product_name"=>$product_name,
            "product_code"=>$product_code,
            "product_icon"=>$product_image,
            "quantity"=>$quantity,
            "product_unit_price"=>$product_unit_price,
            "product_total_price"=>$product_unit_price * $quantity,
            "product_category"=>$product_category,
            "seller_name"=>$seller_name
        ]);

       return $result;
    }

    function SelectAllCartProduct(Request $request)
    {
        $seller_name = $request->seller_name;
        $result = ProductCartModel::where('seller_name',$seller_name)->get();
        return $result;
    }

    function CartTotalPrice(Request $request)
    {
        $seller_name = $request->seller_name;
        $cartList = ProductCartModel::where('seller_name',$seller_name)->get();
        $totalPrice = 0;

        foreach ($cartList as $cartPrice)
        {
            $totalPrice = $totalPrice + $cartPrice['product_total_price'];
        }

        return $totalPrice;
    }

    function CartItemPlus(Request $request)
    {
        $code = $request->product_code;
        $quantity = $request->quantity;
        $price = $request->price;

        $newQuantity = $quantity+1;
        $total_price = $newQuantity*$price;

        $result = ProductCartModel::where('product_code',$code)->update([
            'quantity'=>$newQuantity,
            'product_total_price'=>$total_price
        ]);

        return $result;
    }

    function CartItemMinus(Request $request)
    {
        $code = $request->product_code;
        $quantity = $request->quantity;
        $price = $request->price;

        $newQuantity = $quantity-1;
        $total_price = $newQuantity*$price;
        $result = ProductCartModel::where('product_code',$code)->update([
            'quantity'=>$newQuantity,
            'product_total_price'=>$total_price
        ]);
        return $result;
    }

    function CartItemDelete(Request $request)
    {
        $code = $request->product_code;
        $result = ProductCartModel::where('product_code',$code)->delete();
        return $result;
    }
}
