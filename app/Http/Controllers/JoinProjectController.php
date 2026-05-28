<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class JoinProjectController extends Controller
{
    public function join(Request $request)
    {
        $request->validate([
            'project_id' => 'required|string|max:10',
        ]);

        $project = Project::where('unique_id', $request->project_id)->first();

        if (!$project) {
            return redirect()->back()->with('error', 'Проект с таким ID не найден');
        }

        $isMember = $project->users()->where('user_id', auth()->id())->exists();

        if ($isMember) {
            return redirect()->back()->with('error', 'Вы уже состоите в этом проекте');
        }

        $project->users()->attach(auth()->id(), ['role' => 'member']);

        return redirect()->route('projectboard.enter', $project->unique_id)
                         ->with('success', 'Вы успешно присоединились к проекту');
    }
}