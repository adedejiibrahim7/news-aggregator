<?php

use App\Http\Controllers\FilterNewsController;
use App\Http\Controllers\NewsByPrefrencesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchNewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function (){
   Route::get('get', [NewsController::class, 'show']);

   Route::prefix('news')->name('news')->group(function (){
       Route::get('search', SearchNewsController::class);
       Route::get('filter', FilterNewsController::class);
       Route::get('preferences', NewsByPrefrencesController::class);

   });
});
