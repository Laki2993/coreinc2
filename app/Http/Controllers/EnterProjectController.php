<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class EnterProjectController extends Controller
{
public function enterProject($unique_id)
{
    $projects = Project::where('unique_id', $unique_id)
        ->with(['users', 'tasks'])  
        ->firstOrFail();

    $isMember = $projects->users()->where('user_id', auth()->id())->exists();

    if (!$isMember) {
        return redirect()->route('dashboard')->with('error', 'You dont have access to this project.');
    }

    return view('projectboard', compact('projects'));
}
}
