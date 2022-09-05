<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('categories',[\App\Http\Controllers\Api\CatController::class,'index']);
Route::get('categories/show/{id}',[\App\Http\Controllers\Api\CatController::class,'show']);
Route::get('skills/show/{id}',[\App\Http\Controllers\Api\SkillController::class,'show']);
Route::get('exams/show/{id}',[\App\Http\Controllers\Api\ExamController::class,'show']);
Route::post('/register',[\App\Http\Controllers\Api\AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('exams/show-questions/{id}',[\App\Http\Controllers\Api\ExamController::class,'showQuestions']);
    Route::post('exams/start/{id}',[\App\Http\Controllers\Api\ExamController::class,'start']);
    Route::post('exams/submit/{id}',[\App\Http\Controllers\Api\ExamController::class,'submit']);


});
