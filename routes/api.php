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