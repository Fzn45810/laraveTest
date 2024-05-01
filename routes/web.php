<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/savemeeting', [App\Http\Controllers\HomeController::class, 'save_meeting'])->name('savemeeting');

Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit_meeting'])->name('edit');

Route::post('/updatemeeting', [App\Http\Controllers\HomeController::class, 'update_meeting'])->name('updatemeeting');

Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete_meeting'])->name('delete');



