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
    Route::get('/categories/toggle/{cat}', [\App\Http\Controllers\Admin\AdminCatController::class, 'toggle']);


    Route::get('/skills', [\App\Http\Controllers\Admin\AdminSkillController::class, 'index']);
    Route::post('/skills/store', [\App\Http\Controllers\Admin\AdminSkillController::class, 'store']);
    Route::get('/skills/delete/{skill}', [\App\Http\Controllers\Admin\AdminSkillController::class, 'delete']);
    Route::post('/skills/update', [\App\Http\Controllers\Admin\AdminSkillController::class, 'update']);
    Route::get('/skills/toggle/{skill}', [\App\Http\Controllers\Admin\AdminSkillController::class, 'toggle']);


    Route::get('/exams', [\App\Http\Controllers\Admin\AdminExamController::class, 'index']);
    Route::get('/exams/show/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'show']);
    Route::get('/exams/show-questions/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'showQuestions']);
    Route::get('/exams/create', [\App\Http\Controllers\Admin\AdminExamController::class, 'create']);
    Route::post('/exams/store', [\App\Http\Controllers\Admin\AdminExamController::class, 'store']);
    Route::get('/exams/create-questions/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'storeQuestions']);
    Route::get('/exams/edit/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'edit']);

    Route::post('/exams/update/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'update']);

    Route::get('/exams/edit-questions/{exam}/{question}', [\App\Http\Controllers\Admin\AdminExamController::class, 'editQuestions']);
    Route::post('/exams/update-questions/{exam}/{question}', [\App\Http\Controllers\Admin\AdminExamController::class, 'updateQuestions']);


    Route::get('/exams/delete/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'delete']);
    Route::post('/exams/update', [\App\Http\Controllers\Admin\AdminExamController::class, 'update']);
    Route::get('/exams/toggle/{exam}', [\App\Http\Controllers\Admin\AdminExamController::class, 'toggle']);

    Route::get('/students', [\App\Http\Controllers\Admin\AdminStudentController::class, 'index']);
    Route::get('/students/show-scores/{id}', [\App\Http\Controllers\Admin\AdminStudentController::class, 'showScores']);

    Route::get('/students/open-exam/{studentId}/{examId}', [\App\Http\Controllers\Admin\AdminStudentController::class, 'openExam']);
    Route::get('/students/close-exam/{studentId}/{examId}', [\App\Http\Controllers\Admin\AdminStudentController::class, 'closeExam']);


    Route::middleware('superadmin')->group(function () {
        Route::get('/admins', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
        Route::get('/admins/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
        Route::post('/admins/store', [\App\Http\Controllers\Admin\AdminController::class, 'store']);
        Route::get('/admins/promote/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'promote']);
        Route::get('/admins/demote/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'demote']);
        Route::get('/admins/delete/{user}', [\App\Http\Controllers\Admin\AdminController::class, 'delete']);

    });

    Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index']);
    Route::get('/messages/show/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'show']);
    Route::post('/messages/response/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'response']);




});

