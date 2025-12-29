<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//PUBLIC ROUTES

//users CRUD(register, login)
Route::post('/register', [AuthController::class , 'register']);
Route::post( '/login',  [AuthController::class, 'login']); 

//languages CRUD (index, show)
Route::get('/languages', [LanguageController::class, 'index']);
Route::get('/languages/{id}', [LanguageController::class, 'show']);
//translators CRUD (index, show)
Route::get('/translators', [TranslatorController::class, 'index']);
Route::get('/translators/{id}', [TranslatorController::class, 'show']);


//private routes - you have to be logged in for this route to work 

Route::middleware('auth:sanctum')->group(function(){

//users CRUD(register, logout)
Route::post('/logout', [AuthController::class, 'logout']);

//Languages CRUD (store, update, destory)
Route::post('/languages', [LanguageController::class ,'store']);
Route::put('/languages/{id}', [LanguageController::class ,'update']);
Route::delete('/languages/{id}', [LanguageController::class ,'destroy']);
//translators CRUD (store, update, destory)
Route::post('/translators', [TranslatorController::class ,'store']);
Route::put('/translators/{id}', [TranslatorController::class ,'update']);
Route::delete('/translators/{id}', [TranslatorController::class ,'destroy']);

});