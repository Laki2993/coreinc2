<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class CreateTaskController extends Controller
{
    public function createTask(Request $request, $unique_id)  
{
    $request->validate([
        'task_title' => 'required|string|max:50',
        'task_description' => 'nullable|string|max:255',  
    ]);

    $project = Project::where('unique_id', $unique_id)->firstOrFail();

    $isAdmin = $project->users()->where('user_id',auth()->id())->where('role', 'admin')->exists();

    if($isAdmin){
        $task = Task::create([
            'title' => $request->task_title,
            'description' => $request->task_description,
            'project_id' => $project->id,  
            'user_id' => auth()->id(),
            'status' => 'todo',
        ]);
        return redirect()->route('projectboard.enter', $project->unique_id)->with('success', 'task added');
    }
    return back()->with('error', 'you dont have enough rights');
    }



}


