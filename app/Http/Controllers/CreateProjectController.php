<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;

class CreateProjectController extends Controller
{

public function createProject(Request $request)
{
    $request->validate([
        'project_title' => 'required|string|max:55',
        'project_description' => 'required|string|max:255',
    ]);

    $project = Project::create([
        'user_id' => auth()->id(),
        'unique_id' => Str::random(10),
        'title' => $request->project_title,
        'description' => $request->project_description,
        'img' => rand(1, 4),
    ]);

    $project->users()->attach(auth()->id(), ['role' => 'admin']);

    return redirect()->route('projectboard.enter', $project->unique_id);
}

    public function destroyProject($id){
    $project = Project::findOrFail($id);
    
    $isAdmin = $project->users()
        ->where('user_id', auth()->id())
        ->where('role', 'admin')
        ->exists();
    
    if (auth()->id() !== $project->user_id && !$isAdmin) {
        return back()->with('error', 'Нет прав на удаление');
    }
    
    $project->delete();
    
    return back()->with('success', 'Project deleted');
    }
}
