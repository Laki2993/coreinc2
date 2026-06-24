<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class MessageController extends Controller
{
public function createMessage(Request $request, $unique_id)  
{
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    $project = Project::where('unique_id', $unique_id)->firstOrFail();

        $message = Message::create([
            'message' => $request->message,
            'project_id' => $project->id,  
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('projectboard.enter', $project->unique_id);
    }
}
