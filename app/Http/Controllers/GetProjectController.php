<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class GetProjectController extends Controller
{
    public function getProject(){
    
    $projects = auth()->user()->projects;        
    return view('dashboard', compact('projects'));
    
    }
}
