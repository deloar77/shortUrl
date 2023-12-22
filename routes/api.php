<?php

use App\Http\Controllers\API\V1\ShortenUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;

use App\Http\Controllers\API\V2\ShortenUrlController as ShortenUrlController2 ;
use App\Http\Controllers\API\V2\UserController as UserController2 ;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1')->group(function(){
   Route::post('/UserRegistration',[UserController::class,'UserRegistration']);
   Route::post('/UserLogin',[UserController::class,'UserLogin']);
   
   Route::group(['middleware'=>['auth:sanctum']],function(){
   Route::post('/shortenUrl',[ShortenUrlController::class,'shortenUrl']);
   Route::get('/listOfShortUrl',[ShortenUrlController::class,'listOfShortUrl']);

   });

  
});



Route::prefix('V2')->group(function(){
    Route::post('/UserRegistration',[UserController2::class,'UserRegistration']);
    Route::post('/UserLogin',[UserController2::class,'UserLogin']);
    
    Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/shortenUrl',[ShortenUrlController2::class,'shortenUrl']);
    Route::get('/listOfShortUrl',[ShortenUrlController2::class,'listOfShortUrl']);
 
    });
 
   
 });