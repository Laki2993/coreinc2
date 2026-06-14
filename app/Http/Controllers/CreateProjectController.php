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

public function editProject(Request $request, $id)
{
    $request->validate([
        'project_edit_description' => 'required|string|max:255',
    ]);

    $project = Project::findOrFail($id);

    $isAdmin = $project->users()
        ->where('user_id', auth()->id())
        ->where('role', 'admin')
        ->exists();

    if (!$isAdmin) {
        return back()->with('error', 'No editing rights');
    }

    $project->update([
        'description' => $request->project_edit_description,
    ]);

    return back()->with('success', 'Project description updated');
}


public function updateRole(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|integer|exists:users,id',
        'choose_role' => 'required|in:admin,member',
    ]);

    $project = Project::findOrFail($id);

    $isAdmin = $project->users()
        ->where('user_id', auth()->id())
        ->where('role', 'admin')
        ->exists();

    if (!$isAdmin) {
        return back()->with('error', 'No rights');
    }

    if ( $project->user_id == $request->user_id ) {
        return back()->with('error', 'The owners role cannot be changed');
    }
        $project->users()->updateExistingPivot($request->user_id, [
            'role' => $request->choose_role
        ]);
    
        return back()->with('success', 'The role has been updated');
}
}
