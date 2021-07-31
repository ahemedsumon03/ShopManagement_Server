<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User Route
Route::post('/addUser',[UserController::class,'AddUser']);
Route::get('/getUserAll',[UserController::class,'SelectUser']);
Route::get('/SelectUserById/{id}',[UserController::class,'SelectUserById']);
Route::post('/deleteUser/{id}',[UserController::class,'DeleteUser']);
Route::post('/updateUser/{id}',[UserController::class,'UpdateUser']);

// Category Route
Route::post('/AddCategory',[CategoryController::class,'AddCategory']);
Route::get('/SelectCategory',[CategoryController::class,'SelectCategory']);
Route::get('/SelectCategoryById/{id}',[CategoryController::class,'SelectCategoryById']);
Route::post('/DeleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
Route::post('/UpdateCategoryWithOutImage/{id}',[CategoryController::class,'UpdateCategoryWithOutImage']);
Route::post('/UpdateCategoryWithImage/{id}',[CategoryController::class,'UpdateCategoryWithImage']);

//Product Route

Route::post('/AddProduct',[ProductController::class,'AddProduct']);
Route::get('/SelectProduct',[ProductController::class,'SelectProduct']);
Route::get('/SelectProductById/{id}',[ProductController::class,'SelectProductById']);
Route::post('/DeleteProduct/{id}',[ProductController::class,'DeleteProduct']);
Route::post('/UpdateProductWithoutImage/{id}',[ProductController::class,'UpdateProductWithoutImage']);
Route::post('/UpdateProductWithImage/{id}',[ProductController::class,'UpdateProductWithImage']);
Route::get('/ProductSelectByCategory/{category}',[ProductController::class,'ProductSelectByCategory']);
Route::get('/SelectProductByCode/{code}',[ProductController::class,'SelectProductByCode']);

//DashBoard Route

Route::get('/getCategory',[DashboardController::class,'TotalCategory']);
Route::get('/TotalProduct',[DashboardController::class,'TotalProduct']);
Route::get('/TotalTransaction/{seller_name}',[DashboardController::class,'TotalTransaction']);
Route::get('/TotalIncome/{seller_name}',[DashboardController::class,'TotalIncome']);
Route::get('/IncomeLast7Days/{seller_name}',[DashboardController::class,'IncomeLast7Days']);
Route::get('/RecentTransaction/{seller_name}',[DashboardController::class,'RecentTransaction']);

//Cart Route

Route::post('/AddToCart',[CartController::class,'AddToCart']);
Route::post('/CartList/{invoice}',[CartController::class,'CartList']);

//Report Route
Route::get('/ReportList/{seller_name}',[ReportController::class,'ReportList']);

//Transaction Route
Route::post('/CartSell/{seller_name}',[TransactionController::class,'CartSell']);

//Product Cart
Route::post('/ProductCart',[ProductCartController::class,'ProductCart']);
Route::get('/SelectAllCartProduct/{seller_name}',[ProductCartController::class,'SelectAllCartProduct']);
Route::get('/CartTotalPrice/{seller_name}',[ProductCartController::class,'CartTotalPrice']);
Route::post('/CartItemPlus/{product_code}/{quantity}/{price}',[ProductCartController::class,'CartItemPlus']);
Route::post('/CartItemMinus/{product_code}/{quantity}/{price}',[ProductCartController::class,'CartItemMinus']);
Route::post('/CartItemDelete/{product_code}',[ProductCartController::class,'CartItemDelete']);

//Admin Route
Route::post('/AddAdmin',[AdminController::class,'AddAdmin']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
