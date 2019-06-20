<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Task;

class ProjectTasksController extends Controller
{
    public function update(Task $task)
    {
        $task->complete(\request()->has('completed'));
        return back();
    }

    public function store(Project $project)
    {
        $attributes = request()->validate(['description' => 'required']);
        $project->addTask($attributes);
        return back();
    }
}
