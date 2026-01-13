<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\userController;

Route::get('/', [userController::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [userController::class, 'userQuiz']);
Route::View('/user-signup', 'user-signup');
Route::post('/user-signup', [userController::class, 'userSignup']);
Route::View('start-quiz', 'start-quiz');
Route::view('/admin-login', 'admin-login');
Route::post('/admin-login', [AdminController::class, 'login']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/categories', [AdminController::class, 'categories']);
Route::get('/admin-logout', [AdminController::class, 'logout']);
Route::post('add-category',[AdminController::class,'addCategory']);
Route::get('category/delete/{id}',[AdminController::class,'deleteCategory']);
Route::get('add-quiz',[AdminController::class,'addQuiz']);
Route::post('add-mcq',[AdminController::class,'storeQuiz']);
Route::get('end-quiz',[AdminController::class,'endQuiz']);
Route::get('show-quizzes/{id}/{quizName}',[AdminController::class,'showQuizzes']);
Route::get('quiz-list/{id}/{category}',[AdminController::class,'quizList']);
        