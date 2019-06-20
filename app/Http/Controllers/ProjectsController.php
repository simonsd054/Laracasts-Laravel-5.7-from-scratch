<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreated;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

use \App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('can')->except(['index', 'create']);
//        abort_if(\Illuminate\Support\Facades\Gate::denies('update', $project), 403);
    }

    public function index()
    {
        return view('projects.index',[
            'projects' => auth()->user()->projects
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);
//        dd($project->owner_id);
//        dd('hello');
//        abort_unless(\Illuminate\Support\Facades\Gate::allows('update', $project), 403);
        return view('projects.show', compact('project'));
    }

    public function store()
    {
//        $this->authorize('update', $project);
        $attributes = request()->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $attributes['owner_id'] = auth()->id();
        Project::create($attributes);
        return redirect('/projects');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);
        $attributes = \request()->validate([
           'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);
//        dd('hello');
        $project->update($attributes);
        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);
        $project->delete();
        return redirect('/projects');
    }

}
