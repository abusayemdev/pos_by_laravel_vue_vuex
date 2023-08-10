<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/{vue_capture?}', function(){
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');


Route::post('/api/forgetuser', [ResetController::class, 'forget']);
Route::post('/api/newpassword', [ResetController::class, 'newpassword']);
