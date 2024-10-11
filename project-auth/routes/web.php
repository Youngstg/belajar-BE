<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingsController;

Route::get('/home', function () {
    return 'Welcome to your dashboard!';
})->name('home')->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/questions/create', [QuestionController::class, 'create'])->middleware('auth')->name('questions.create');
Route::post('/questions', [QuestionController::class, 'store'])->middleware('auth')->name('questions.store');

Route::get('/questions/{id}', [QuestionController::class, 'show'])->middleware('auth')->name('questions.show');
Route::post('/questions/{id}/answers', [AnswerController::class, 'store'])->middleware('auth')->name('answers.store');

Route::get('/settings', [SettingsController::class, 'index'])->middleware('auth')->name('settings.index');
Route::post('/settings', [SettingsController::class, 'update'])->middleware('auth')->name('settings.update');

Route::get('/questions', [QuestionController::class, 'index'])->middleware('auth')->name('questions.index');

Route::post('/answers/{answer}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::post('/answers/{answer}/like', [LikeController::class, 'toggleLike'])->middleware('auth')->name('answers.like');

