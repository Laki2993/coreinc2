<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class CreateTaskController extends Controller
{
    public function createTask(Request $request, $unique_id)  // ← добавил $unique_id
{
    $request->validate([
        'task_title' => 'required|string|max:50',
        'task_description' => 'nullable|string|max:255',  // описание может быть пустым
    ]);

    // Находим проект по unique_id
    $project = Project::where('unique_id', $unique_id)->firstOrFail();

    $task = Task::create([
        'title' => $request->task_title,
        'description' => $request->task_description,
        'project_id' => $project->id,  // ← берём ID из найденного проекта
        'status' => 'todo',
    ]);

    return redirect()->route('projectboard.enter', $project->unique_id)
                     ->with('success', 'Задача создана');
}

}
