<?php

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\DriveApi;
use Illuminate\Support\Facades\Route;

Route::post('register' , [AuthApiController::class , 'register']);
Route::post('login' , [AuthApiController::class , 'login']);

Route::middleware("auth:sanctum")->group(function(){

    Route::get('Drive' , [DriveApi::class , 'index']);
    Route::post('Drive' , [DriveApi::class , 'store']);
    Route::post('Drive/{id}' , [DriveApi::class , 'update']);
    Route::delete('Drive/{id}' , [DriveApi::class , 'delete']);
    Route::get('logout' , [AuthApiController::class , 'logout']);
});
