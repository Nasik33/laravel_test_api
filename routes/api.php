<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\ProductsController;

/*
|--------------------------------------------------------------------------
| API ரவுட்கள் (Routes)
|--------------------------------------------------------------------------
|
| இவை API endpoint களுக்கான வழிகளை விவரிக்கின்றன. இங்கு நீங்கள்
| controllers மற்றும் மூலவள (resources) களை எளிதாக நிர்வகிக்கலாம்.
|
*/

// 'products' API resource வழியாக கீழ்க்கண்ட method களை தானாக உருவாக்கும்:
// index, store, show, update, destroy
Route::apiResource('products', ProductsController::class);

// 'books' API resource வழியாக கீழ்கண்ட method களை தானாக உருவாக்கும்:
// index, store, show, update, destroy
Route::apiResource('books', BookController::class);

Route::apiResource('phones',PhoneController::class);

Route::get('/user', function (Request $request){
return $request->user();
})->middleware('auth:sanctum');
