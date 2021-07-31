<?php

namespace App\Http\Controllers;

use App\Models\ProductCartModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
  function CartSell(Request $request)
  {
      $seller_name = $request->seller_name;
      $CartList = ProductCartModel::where('seller_name',$seller_name)->get();

      $invoice_no = $request->input('invoice_no');
      date_default_timezone_set('Asia/Dhaka');
      $cartInsertDelete='';
      foreach ($CartList as $CartListItem)
      {
         $resultInsert= TransactionModel::insert([
              'invoice_no'=>$invoice_no,
              'invoice_date'=>date('d-m-Y'),
              'product_name'=>$CartListItem['product_name'],
              'product_quantity'=>$CartListItem['quantity'],
              'unit_price'=>$CartListItem['product_unit_price'],
              'total_price'=>$CartListItem['product_total_price'],
              'seller_name'=>$CartListItem['seller_name']
          ]);

         if($resultInsert == 1)
         {
             $resultDelete = ProductCartModel::where('id',$CartListItem['id'])->delete();
             if($resultDelete == 1)
             {
                 $cartInsertDelete = 1;
             }
             else{
                 $cartInsertDelete = 0;
             }
         }
      }

      return $cartInsertDelete;
  }
}
