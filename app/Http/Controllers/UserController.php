<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
   function AddUser(Request $request)
   {
       $fullname = $request->input('fullname');
       $username = $request->input('username');
       $roll = $request->input('roll');
       $lastActivity = $request->input('lastactivity');
       $password = $request->input('password');

       $get_user_number = UserModel::where('username',$username)->count();

       if($get_user_number>0)
       {
           return "User is Exists";
       }
       else{
            $result = UserModel::insert([
                'fullname'=>$fullname,
                'username'=>$username,
                'roll'=>$roll,
                'lastactivity'=>$lastActivity,
                'password'=>$password
            ]);

            if($result==true)
            {
                return $result;
            }
            else{
                return '0';
            }
       }
   }

   function SelectUser()
   {
       $result = UserModel::all();
       return $result;
   }

   function DeleteUser(Request $request)
   {
       $id = $request->id;
       $result = UserModel::where('id',$id)->delete();
       return $result;
   }

   function UpdateUser(Request $request)
   {
       $id = $request->id;
       $fullname = $request->input('fullname');
       $username = $request->input('username');
       $roll = $request->input('roll');
       $password = $request->input('password');
       $count_user = UserModel::where('username',$username)->count();
       $result = UserModel::where('id',$id)->update([
           'fullname'=>$fullname,
           'username'=>$username,
           'roll'=>$roll,
           'lastactivity'=>'No Activity',
           'password'=>$password
       ]);

       return $result;
   }

   function SelectUserById(Request $request)
   {
       $id = $request->id;
       $result = UserModel::where('id',$id)->get();
       return $result;
   }
}
