<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\StocksController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\DashboardController;



Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
    
    ], function ($router) {
    
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});



//employee route
Route::apiResource('/employee', EmployeeController::class);

//supplier route
Route::apiResource('/supplier', SupplierController::class);

//category route
Route::apiResource('/category', CategoryController::class);

//product route
Route::apiResource('/product', ProductController::class);

//expense route
Route::apiResource('/expense', ExpenseController::class);

//customer route
Route::apiResource('/customer', CustomerController::class);

//salary route
Route::Post('/pay-salary/{id}', [SalaryController::class, 'pay_salary' ]);
Route::Get('/salary', [SalaryController::class, 'all_salaries' ]);
Route::Get('/show-salary/{id}', [SalaryController::class, 'show_salary' ]);
Route::Get('/edit-salary/{id}', [SalaryController::class, 'edit_salary' ]);

//stocks route
Route::Post('/update-stocks/{id}', [StocksController::class, 'update_stocks' ]);

//pos route
Route::Post('/add-to-cart/{id}', [PosController::class, 'add_to_cart' ]);
Route::Get('/cart-product', [PosController::class, 'cart_product' ]);
Route::Get('/remove-cart/{id}', [PosController::class, 'remove_cart' ]);
Route::Get('/increment-cart/{id}', [PosController::class, 'increment_cart' ]);
Route::Get('/decrement-cart/{id}', [PosController::class, 'decrement_cart' ]);
Route::Get('/vat', [PosController::class, 'vat' ]);
Route::Post('/order-done', [PosController::class, 'order_done' ]);

//order route
Route::Get('/all-order', [OrderController::class, 'all_order' ]);
Route::Get('/day-order/{id}', [OrderController::class, 'day_order' ]);
Route::Get('/order-details/{id}', [OrderController::class, 'order_details' ]);
Route::Get('/order-details-all/{id}', [OrderController::class, 'order_details_all' ]);
Route::Get('/shop-details', [OrderController::class, 'shop_details' ]);

//dashboard routes
Route::Get('/today-sell', [DashboardController::class, 'today_sell' ]);
Route::Get('/today-orders', [DashboardController::class, 'today_orders' ]);
Route::Get('/today-expense', [DashboardController::class, 'today_expense' ]);
Route::Get('/today-stockin', [DashboardController::class, 'today_stockin' ]);
Route::Get('/stockout', [DashboardController::class, 'stockout' ]);












