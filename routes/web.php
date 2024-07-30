<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect() -> route('faculties.index');
});

Route::get('login', function(){
    return redirect() -> route('auth.create');
}) -> name('login');

Route::delete('logout', function(){
    return redirect() -> route('auth.destroy');
}) -> name('logout');

Route::get('signup', function(){
    return redirect() -> route('user.create');
}) -> name('signup');

Route::delete('auth', [AuthController::class, 'destroy']) -> name('auth.destroy');

Route::resource('faculties', FacultyController::class) -> except(['show']);
Route::resource('faculties.programs', ProgramController::class) -> except(['show']);
Route::resource('programs.tips', TipController::class);
Route::resource('auth', AuthController::class) -> only(['create', 'store']);
Route::resource('user', UserController::class);
Route::resource('tips.reply', ReplyController::class) -> only(['store', 'update', 'destroy']);
Route::resource('like', LikeController::class) -> only(['store', 'destroy']);
Route::resource('mark', MarkController::class) -> only(['index', 'store', 'show']);
