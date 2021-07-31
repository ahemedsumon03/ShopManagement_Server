<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function TotalCategory()
    {
       $result= CategoryModel::count();
       return $result;
    }

    function TotalProduct()
    {
        $result = ProductModel::count();
        return $result;
    }

    function TotalTransaction(Request $request)
    {
        $seller_name = $request->seller_name;
        $result = TransactionModel::where('seller_name',$seller_name)->count();
        return $result;
    }

    function TotalIncome(Request $request)
    {
        $seller_name = $request->seller_name;
        $transaction = TransactionModel::where('seller_name',$seller_name)->get();
        $totalIncome = 0;
        foreach ($transaction as $transactionList)
        {
            $totalIncome = $totalIncome + $transactionList['total_price'];
        }
        return $totalIncome;
    }

    function IncomeLast7Days(Request $request)
    {
         $seller_name = $request->seller_name;
         $today_date = date_default_timezone_set('Asia/Dhaka');
         $date1 = date('d-m-Y');
         $Transaction1 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date1)->get();
         $TotalPrice1 = 0;
         foreach ($Transaction1 as $TransactionList)
         {
             $TotalPrice1 = $TotalPrice1+$TransactionList['total_price'];
         }

        $date2 = date('d-m-Y',strtotime("-1 day"));
        $Transaction2 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date2)->get();
        $TotalPrice2 = 0;
        foreach ($Transaction2 as $TransactionList1)
        {
            $TotalPrice2 = $TotalPrice2+$TransactionList1['total_price'];
        }

        $date3 = date('d-m-Y',strtotime("-2 day"));
        $Transaction3 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date3)->get();
        $TotalPrice3 = 0;
        foreach ($Transaction3 as $TransactionList2)
        {
            $TotalPrice3 = $TotalPrice3+$TransactionList2['total_price'];
        }

        $date4 = date('d-m-Y',strtotime("-3 day"));
        $Transaction4 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date4)->get();
        $TotalPrice4 = 0;
        foreach ($Transaction4 as $TransactionList3)
        {
            $TotalPrice4 = $TotalPrice4+$TransactionList3['total_price'];
        }

        $date5 = date('d-m-Y',strtotime("-4 day"));
        $Transaction5 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date5)->get();
        $TotalPrice5 = 0;
        foreach ($Transaction5 as $TransactionList4)
        {
            $TotalPrice5 = $TotalPrice5+$TransactionList4['total_price'];
        }

        $date6 = date('d-m-Y',strtotime("-5 day"));
        $Transaction6 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date6)->get();
        $TotalPrice6 = 0;
        foreach ($Transaction6 as $TransactionList5)
        {
            $TotalPrice6 = $TotalPrice6+$TransactionList5['total_price'];
        }

        $date7 = date('d-m-Y',strtotime("-6 day"));
        $Transaction7 = TransactionModel::where('seller_name',$seller_name)->where('invoice_date',$date7)->get();
        $TotalPrice7 = 0;
        foreach ($Transaction7 as $TransactionList6)
        {
            $TotalPrice7 = $TotalPrice7+$TransactionList6['total_price'];
        }

        $array = array(
            array(
                't_date'=>$date1,
                'income'=>$TotalPrice1
            ),
            array(
                't_date'=>$date2,
                'income'=>$TotalPrice2
            ),
            array(
                't_date'=>$date3,
                'income'=>$TotalPrice3
            ),
            array(
                't_date'=>$date4,
                'income'=>$TotalPrice4
            ),
            array(
                't_date'=>$date5,
                'income'=>$TotalPrice5
            ),
            array(
                't_date'=>$date6,
                'income'=>$TotalPrice6
            ),
            array(
                't_date'=>$date7,
                'income'=>$TotalPrice7
            )
        );

        return $array;
    }

    function RecentTransaction(Request $request)
    {
        $seller_name = $request->seller_name;
        $result = TransactionModel::where('seller_name',$seller_name)->OrderBy('id','desc')->limit(15)->get();
        return $result;
    }
}
