<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadImgController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateProjectController;
use App\Http\Controllers\GetProjectController;
use App\Http\Controllers\EnterProjectController;
use App\Http\Controllers\JoinProjectController;
use App\Http\Controllers\CreateTaskController;
use App\Http\Controllers\TaskCrudController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/projectboard/join', [JoinProjectController::class, 'join'])
    ->middleware(['auth', 'verified'])
    ->name('projectboard.join');

    Route::get('/projectboard/{unique_id}', [EnterProjectController::class, 'enterProject'])
        ->middleware(['auth', 'verified'])
        ->name('projectboard.enter');


Route::post('/projectboard/{unique_id}/tasks', [CreateTaskController::class, 'createTask'])
    ->middleware(['auth', 'verified'])
    ->name('projectboard.createtask');

Route::delete('/tasks/{task}', [TaskCrudController::class, 'destroy'])->name('tasks.destroy');
Route::delete('/project/{project}', [CreateProjectController::class, 'destroyProject'])->name('project.destroy');

Route::put('/project/{project}/edit',[CreateProjectController::class,'editProject'])->name('projectDecript.edit');

Route::put('/project/{project}/update-role', [CreateProjectController::class, 'updateRole'])->name('update.role');


Route::get('/dashboard',[GetProjectController::class,'getProject'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard',[CreateProjectController::class,'createProject'])->name('projectboard.create');

Route::patch('/profile/avatar',[UploadImgController::class,'upload'])->name('profile.update.avatar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
