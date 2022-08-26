<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('lang')->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [\App\Http\Controllers\Web\CatController::class, 'show']);
    Route::get('/skills/show/{id}', [\App\Http\Controllers\Web\SkillController::class, 'show']);
    Route::get('/exams/show/{id}', [\App\Http\Controllers\Web\ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [\App\Http\Controllers\Web\ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::get('/contact', [\App\Http\Controllers\Web\ContactController::class, 'index']);

    Route::get('/profile', [\App\Http\Controllers\Web\ProfileController::class, 'index'])->middleware(['auth', 'verified', 'student']);


});


Route::post('/contact/message/send', [\App\Http\Controllers\Web\ContactController::class, 'send']);
Route::get('/lang/set/{lang}', [\App\Http\Controllers\Web\LangController::class, 'set']);

Route::post('/exams/start/{id}', [\App\Http\Controllers\Web\ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can-enter-exam']);
Route::post('/exams/submit/{id}', [\App\Http\Controllers\Web\ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);

Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function () {

    Route::get('/', [\App\Http\Controllers\Admin\AdminHomeController::class, 'index']);
    Route::get('/categories', [\App\Http\Controllers\Admin\AdminCatController::class, 'index']);
    Route::post('/categories/store', [\App\Http\Controllers\Admin\AdminCatController::class, 'store']);
    Route::get('/categories/delete/{cat}', [\App\Http\Controllers\Admin\AdminCatController::class, 'delete']);
    Route::post('/categories/update', [\App\Http\Controllers\Admin\AdminCatController::class, 'update']);

});

