<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function AddProduct(Request $request)
    {
        $product_name = $request->input('product_name');
        $product_code = time();
        $imagePath = $request->file('image')->store('public');
        $product_price = $request->input('product_price');
        $product_category = $request->input('product_category');
        $product_remark = $request->input('product_remark');

        $myImage = explode("/",$imagePath);

        $result = ProductModel::insert([
            'product_name'=>$product_name,
            'product_code'=>$product_code,
            'product_icon'=>"http://".$_SERVER['HTTP_HOST']."/storage/".$myImage[1],
            'product_price'=>$product_price,
            'product_category'=>$product_category,
            'product_remark'=>$product_remark
        ]);

        return $result;
    }

    function SelectProduct()
    {
        $result = ProductModel::all();
        return $result;
    }

    function SelectProductById(Request $request)
    {
        $id = $request->id;
        $result = ProductModel::where('id',$id)->get();
        return $result;
    }

    function DeleteProduct(Request $request)
    {
        $id = $request->id;
        $productIconColumn = ProductModel::where('id',$id)->get('product_icon');
        $productIcon = $productIconColumn[0]['product_icon'];
        Storage::delete($productIcon);
        $result = ProductModel::where('id',$id)->delete();
        return $result;
    }

    function UpdateProductWithoutImage(Request $request)
    {
        $id = $request->id;
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $product_category = $request->input('product_category');
        $product_remark = $request->input('product_remark');

        $result = ProductModel::where('id',$id)->update([
            'product_name'=>$product_name,
            'product_price'=>$product_price,
            'product_category'=>$product_category,
            'product_remark'=>$product_remark
        ]);

        return $result;
    }

    function UpdateProductWithImage(Request $request)
    {
        $id = $request->id;
        $product_name = $request->input('product_name');
        $productColumn = ProductModel::where('id',$id)->get('product_icon');
        $productIcon = $productColumn[0]['product_icon'];
        Storage::delete($productIcon);
        $imagePath = $request->file('image')->store('public');
        $myImage = explode("/",$imagePath);
        $product_price = $request->input('product_price');
        $product_category = $request->input('product_category');
        $product_remark = $request->input('product_remark');
        $result = ProductModel::where('id',$id)->update([
            'product_name'=>$product_name,
            'product_icon'=>"http://".$_SERVER['HTTP_HOST']."/storage/".$myImage[1],
            'product_price'=>$product_price,
            'product_category'=>$product_category,
            'product_remark'=>$product_remark
        ]);

        return $result;
    }

    function ProductSelectByCategory(Request $request)
    {
        $category = $request->category;
        $result = ProductModel::where('product_category',$category)->get();
        return $result;
    }

    function SelectProductByCode(Request $request)
    {
        $code = $request->code;
        $result = ProductModel::where('product_code',$code)->get();
        return $result;
    }
}
