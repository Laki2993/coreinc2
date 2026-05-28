<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadImgController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateProjectController;
use App\Http\Controllers\GetProjectController;
use App\Http\Controllers\EnterProjectController;
use App\Http\Controllers\JoinProjectController;
use App\Http\Controllers\CreateTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/projectboard/join', [JoinProjectController::class, 'join'])
    ->middleware(['auth', 'verified'])
    ->name('projectboard.join');

    // Потом динамический роут (с параметром)
    Route::get('/projectboard/{unique_id}', [EnterProjectController::class, 'enterProject'])
        ->middleware(['auth', 'verified'])
        ->name('projectboard.enter');


// Сначала конкретный роут (без параметров)
Route::post('/projectboard/{unique_id}/tasks', [CreateTaskController::class, 'createTask'])
    ->middleware(['auth', 'verified'])
    ->name('projectboard.createtask');







Route::get('/dashboard',[GetProjectController::class,'getProject'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard',[CreateProjectController::class,'createProject'])->name('projectboard.create');

Route::patch('/profile/avatar',[UploadImgController::class,'upload'])->name('profile.update.avatar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
