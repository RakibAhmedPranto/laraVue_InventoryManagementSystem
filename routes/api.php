<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signUp', 'AuthController@signUp');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee','EmployeeController');
Route::apiResource('/supplier','SupplierController');
Route::apiResource('/category','CategoryController');
Route::apiResource('/product','ProductController');
Route::apiResource('/customer','CustomerController');
Route::apiResource('/expense','ExpenseController');

Route::Post('/salary/paid/{id}','SalaryController@paid');
Route::Get('/salary','SalaryController@allSalary');
Route::Get('/salary/view/{id}','SalaryController@viewSalary');


Route::Post('/product/updateStock/{id}','ProductController@updateStock');

Route::Get('/categoryWiseProduct/{id}','PosController@categoryWiseProduct');


Route::Get('/cart/addToCart/{id}','CartController@addToCart');
Route::Get('/cart/cartContent','CartController@cartContent');
Route::Get('/cart/remove/{id}','CartController@removeCartItem');
Route::Get('/cart/increment/{id}','CartController@incrementCartItem');
Route::Get('/cart/decrement/{id}','CartController@decrementCartItem');


Route::Post('/order/done','PosController@orderDone');


Route::Get('/order/allOrder','OrderController@allOrder');
Route::Get('/order/today','OrderController@today');
Route::Get('/order/details/{id}','OrderController@orderDetails');
Route::Get('/order/orderdetails/{id}','OrderController@orderDetailsAll');


// Admin Dashboard Route

Route::Get('/today/sell', 'PosController@TodaySell');
Route::Get('/today/income', 'PosController@TodayIncome');
Route::Get('/today/due', 'PosController@TodayDue');
Route::Get('/today/expense', 'PosController@TodayExpense');
Route::Get('/today/stockout', 'PosController@Stockout');
