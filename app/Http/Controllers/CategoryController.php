<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    function AddCategory(Request $request)
    {
        $cat_name = $request->input('cat_name');
        $cat_code = time();
        $imagePath = $request->file('image')->store('public');
        $myImage = explode("/",$imagePath);
        $result = CategoryModel::insert([
            'cat_name'=>$cat_name,
            'cat_code'=>$cat_code,
            'cat_icon'=>"http://".$_SERVER['HTTP_HOST']."/storage/".$myImage[1]
        ]);

        return $result;
    }

    function SelectCategory()
    {
        $result = CategoryModel::all();
        return $result;
    }

    function SelectCategoryById(Request $request)
    {
        $id = $request->id;
        $result = CategoryModel::where('id',$id)->get();
        return $result;
    }

    function DeleteCategory(Request $request)
    {
        $id = $request->id;
        $iconColumn = CategoryModel::where('id',$id)->get('cat_icon');
        $iconPath = $iconColumn[0]['cat_icon'];
        Storage::delete($iconPath);
        $result = CategoryModel::where('id',$id)->delete();
        return $result;
    }

    function UpdateCategoryWithOutImage(Request $request)
    {
        $id = $request->id;
        $cat_name = $request->input('cat_name');
        $result = CategoryModel::where('id',$id)->update([
            'cat_name'=>$cat_name
        ]);
        return $result;
    }

    function UpdateCategoryWithImage(Request $request)
    {
        $id = $request->id;
        $cat_name = $request->input('cat_name');
        //previous Image
        $iconColumn = CategoryModel::where('id',$id)->get('cat_icon');
        $iconPath = $iconColumn[0]['cat_icon'];
        Storage::delete($iconPath);
        //new Image
        $imagePath = $request->file('image')->store('public');
        $newImage = explode("/",$imagePath);
        $result = CategoryModel::where('id',$id)->update([
            'cat_name'=>$cat_name,
            'cat_icon'=>"http://".$_SERVER['HTTP_HOST']."/storage/".$newImage[1]
        ]);

        return $iconPath;
    }
}
