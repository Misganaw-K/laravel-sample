<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/register',[Authcontroller::class,'register']);
    Route::post('/login',[Authcontroller::class,'login']);
    Route::get('/user', [Authcontroller::class, 'user']);
    Route::post('/refresh', [uthcontroller::class, 'refresh']);
    Route::post('/logout', [Authcontroller::class, 'logout']);

});

Route::post('/article',[ArticleController::class,'store']);
Route::get('/article/{article}',[ArticleController::class,'show']);
Route::get('/article/{article}/comments',[ArticleController::class,'show_comments']);
Route::get('/article/{article}/best-comment',[ArticleController::class,'show_best_comment']);
Route::get('/articles',[ArticleController::class,'index']);
Route::delete('article/{article}','ArticleController@destroy');

Route::post('//article/{article}/comment',[CommentController::class,'store']);
Route::post('comment/{comment}/best-comment',[CommentController::class,'best_comment']);
Route::get('comments',[CommentController::class,'index']);
Route::get('comment/{comment}', [CommentController::class,'show']);
Route::delete('comment/{comment}',[CommentController::class,'destroy']);