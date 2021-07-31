<?php

namespace App\Http\Controllers;

use App\Models\TransactionModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function ReportList(Request $request)
    {
        $seller_name= $request->seller_name;
        $result = TransactionModel::where('seller_name',$seller_name)->OrderBy('id','desc')->get();
        return $result;
    }
}
