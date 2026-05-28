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
        ->with(['users', 'tasks'])  // ← загружаем и задачи
        ->firstOrFail();

    $isMember = $projects->users()->where('user_id', auth()->id())->exists();

    if (!$isMember) {
        return redirect()->route('dashboard')->with('error', 'У вас нет доступа к этому проекту');
    }

    return view('projectboard', compact('projects'));
}
}
