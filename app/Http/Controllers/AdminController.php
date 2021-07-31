<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   function AddAdmin(Request $request)
   {
      $name = $request->input('name');
      $email = $request->input('email');
      $password = $request->input('password');

      $count = AdminModel::where('name',$name)->where('email',$email)->where('password',$password)->count();

      if($count>0)
      {
          return 1;
      }
      else{
          return 0;
      }
   }
}
