<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskCrudController extends Controller
{
    public function destroy($id)
{
    $task = Task::findOrFail($id);
    
    $isAdmin = $task->project->users()
        ->where('user_id', auth()->id())
        ->where('role', 'admin')
        ->exists();
    
    if (auth()->id() !== $task->user_id && !$isAdmin) {
        return back()->with('error', 'Нет прав на удаление');
    }
    
    $task->delete();
    
    return back()->with('success', 'Task deleted');
}
}
